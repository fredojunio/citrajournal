<?php

namespace App\Http\Controllers;

use App\Models\Coa;
use App\Models\Coa_Transaction;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Transaction::where('category_id', 1)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->paginate(15);
        return view('user.sale.sale', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $contacts = Contact::where('umkm_id', Auth::user()->umkm->id)
            ->where('type', 'Pelanggan')
            ->orWhere('type', 'Lainnya')
            ->get();

        $products = Product::where('umkm_id', Auth::user()->umkm->id)
            ->whereHas('sale', function ($q) {
                $q->whereNotNull('id');
            })->get();

        return view('user.sale.create_sale', compact('contacts', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // sum total
            $total = 0;
            $subtotal = 0;
            $taxtotal = 0;
            for ($x = 0; $x < count($request->price); $x++) {
                $price = (float) preg_replace('/[^\d]/', '', $request->price[$x]);
                $subtotal += ($price * $request->quantity[$x]);
                $tax = $price * (($request->tax[$x] ?? 0) / 100);
                $taxtotal += ($tax * $request->quantity[$x]);

                $total += (($price + $tax) * $request->quantity[$x]);

                // check product stock
                $product = Product::findOrFail($request->product_id[$x]);
                if (!empty($product->stock)) {
                    if ($product->stock < $request->quantity[$x]) {
                        return redirect()->route('umkm.sale.create');
                    }
                }
            }

            // cut
            $cuts = 0;
            if (!empty($request->cut)) {
                $cuts = $subtotal * $request->cut / 100;
                $total -= $cuts;
            }

            // update kas
            $kas = Coa::where('umkm_id', Auth::user()->umkm->id)
                ->where('category_id', 1)
                ->get()
                ->first();

            // code for generate invoice
            $lastTransaction = Transaction::where('category_id', 1)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->get()
                ->last();
            if (!empty($lastTransaction)) {
                $pieces = explode(' ', $lastTransaction->invoice);
                $lastInvoiceCode = array_pop($pieces);

                $numbering = (int) str_replace('#', '', $lastInvoiceCode);
                $newInvoice = 'Faktur Penjualan #' . ($numbering + 1);
            } else {
                $newInvoice = 'Faktur Penjualan #10001';
            }

            // create transaction
            $transaction = Transaction::create([
                'contact_id' => $request->contact_id,
                'invoice' => $newInvoice,
                'status' => $request->status,
                'total' => $total,
                'cut' => $request->cut ?? 0,
                'remaining_bill' => $total,
                'date' => Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d'),
                'due_date' => Carbon::createFromFormat('d/m/Y', $request->due_date)->format('Y-m-d'),
                'category_id' => 1,
                'umkm_id' => Auth::user()->umkm->id,
                'taxtotal' => $taxtotal,
                'subtotal' => $subtotal,
                'cuttotal' => $cuts,
            ]);

            // create detail transaction
            for ($x = 0; $x < count($request->price); $x++) {
                $product = Product::findOrFail($request->product_id[$x]);
                $price = (float) preg_replace('/[^\d]/', '', $request->price[$x]);
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $request->product_id[$x],
                    'quantity' => $request->quantity[$x],
                    'description' => $request->description[$x],
                    'price' => $price,
                    'tax' => $request->tax[$x] ?? 0,
                ]);

                // update product stock
                if (!empty($product->stock)) {
                    $product->stock->update([
                        'stock' => $product->stock->stock - $request->quantity[$x]
                    ]);


                    // persediaan barang
                    $persediaan_barang = Coa::findOrFail($product->stock->coa_id);
                    $persediaan_barang->update(['balance' => $persediaan_barang->balance - ($product->purchase->price * $request->quantity[$x])]);

                    $coa_transaction = Coa_Transaction::where('coa_id', $persediaan_barang->id)
                        ->where('transaction_id', $transaction->id)
                        ->get()
                        ->last();
                    if (!empty($coa_transaction)) {
                        $coa_transaction->update([
                            'credit' => $coa_transaction->credit - ($product->purchase->price * $request->quantity[$x])
                        ]);
                    } else {
                        Coa_Transaction::create([
                            'transaction_id' => $transaction->id,
                            'coa_id' => $persediaan_barang->id,
                            'credit' => $product->purchase->price * $request->quantity[$x]
                        ]);
                    }

                    // beban pokok pendapatan
                    $beban_pokok_pendapatan = Coa::findOrFail($product->purchase->coa_id);
                    $beban_pokok_pendapatan->update(['balance' => $beban_pokok_pendapatan->balance + ($product->purchase->price * $request->quantity[$x])]);

                    $coa_transaction = Coa_Transaction::where('coa_id', $beban_pokok_pendapatan->id)
                        ->where('transaction_id', $transaction->id)
                        ->get()
                        ->last();
                    if (!empty($coa_transaction)) {
                        $coa_transaction->update([
                            'debit' => $coa_transaction->debit + ($product->purchase->price * $request->quantity[$x])
                        ]);
                    } else {
                        Coa_Transaction::create([
                            'transaction_id' => $transaction->id,
                            'coa_id' => $beban_pokok_pendapatan->id,
                            'debit' => $product->purchase->price * $request->quantity[$x]
                        ]);
                    }


                    // pendapatan
                    $pendapatan = Coa::findOrFail($product->sale->coa_id);
                    $pendapatan->update(['balance' => $pendapatan->balance + ($price * $request->quantity[$x])]);
                    $coa_transaction = Coa_Transaction::where('coa_id', $pendapatan->id)
                        ->where('transaction_id', $transaction->id)
                        ->get()
                        ->last();
                    if (!empty($coa_transaction)) {
                        $coa_transaction->update([
                            'credit' => $coa_transaction->credit + ($price * $request->quantity[$x])
                        ]);
                    } else {
                        Coa_Transaction::create([
                            'transaction_id' => $transaction->id,
                            'coa_id' => $pendapatan->id,
                            'credit' => $price * $request->quantity[$x]
                        ]);
                    }
                }
            }

            // update coa balance
            if ($cuts != 0) {
                // hutang pajak
                $hutang_pajak = Coa::where('umkm_id', Auth::user()->umkm->id)
                    ->where('code', '2-20504')
                    ->get()
                    ->last();
                $hutang_pajak->update(['balance' => $hutang_pajak->balance + $cuts]);
                Coa_Transaction::create([
                    'transaction_id' => $transaction->id,
                    'coa_id' => $hutang_pajak->id,
                    'credit' => $cuts
                ]);
            }

            if ($taxtotal != 0) {
                $ppn = Coa::where('umkm_id', Auth::user()->umkm->id)
                    ->where('code', '2-20500')
                    ->get()
                    ->last();

                $ppn->update(['balance' => $ppn->balance + $taxtotal]);

                Coa_Transaction::create([
                    'transaction_id' => $transaction->id,
                    'coa_id' => $ppn->id,
                    'credit' => $taxtotal
                ]);
            }

            // piutang usaha
            $piutang_usaha = Coa::where('umkm_id', Auth::user()->umkm->id)
                ->where('code', '1-10100')
                ->get()
                ->last();
            $piutang_usaha->update(['balance' => $piutang_usaha->balance + $total]);
            Coa_Transaction::create([
                'transaction_id' => $transaction->id,
                'coa_id' => $piutang_usaha->id,
                'debit' => $total
            ]);

            // create receive payment
            if ($request->status == 'paid') {
                $this->create_sale_payment($total, $kas->id, $request->date, $transaction->id);
            }

            return redirect()->route('umkm.sale.index');
        } catch (Exception $e) {
            return redirect()->route('umkm.sale.create')->with('alert', $e->getMessage());
        }
    }

    public function create_sale_payment($total, $kas_id, $date, $transaction_id): void
    {
        // update last transaction remaining bill
        $sale_transaction = Transaction::findOrFail($transaction_id);
        $sale_transaction->update(['remaining_bill' => $sale_transaction->remaining_bill - $total]);
        if ($sale_transaction->remaining_bill <= 0) {
            $sale_transaction->update(['status' => 'paid']);
        }


        // code for generate invoice
        $lastTransaction = Transaction::where('category_id', 7)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->get()
            ->last();
        if (!empty($lastTransaction)) {
            $pieces = explode(' ', $lastTransaction->invoice);
            $lastInvoiceCode = array_pop($pieces);

            $numbering = (int) str_replace('#', '', $lastInvoiceCode);
            $newInvoice = 'Receive Payment #' . ($numbering + 1);
        } else {
            $newInvoice = 'Receive Payment #10001';
        }

        // create transaction
        $transaction = Transaction::create([
            'invoice' => $newInvoice,
            'status' => 'paid',
            'total' => $total,
            'cut' => 0,
            'date' => Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'),
            'category_id' => 8,
            'umkm_id' => Auth::user()->umkm->id,
            'taxtotal' => 0,
            'subtotal' => $total,
            'cuttotal' => 0
        ]);

        TransactionDetail::create([
            'transaction_id' => $transaction->id,
            'paid_id' => $transaction_id,
            'price' => $total,
            'tax' => 0,
        ]);

        $piutang_usaha = Coa::where('umkm_id', Auth::user()->umkm->id)
            ->where('code', '1-10100')
            ->get()
            ->last();
        $piutang_usaha->update(['balance' => $piutang_usaha->balance - $total]);
        Coa_Transaction::create([
            'transaction_id' => $transaction->id,
            'coa_id' => $piutang_usaha->id,
            'credit' => $total,
        ]);

        $kas = Coa::findOrFail($kas_id);
        $kas->update([
            'balance' => $kas->balance + $total
        ]);
        Coa_Transaction::create([
            'transaction_id' => $transaction->id,
            'coa_id' => $kas->id,
            'debit' => $total,
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
