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

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchaseMonth = Transaction::where('category_id', 2)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->whereBetween('date', [Carbon::now()->subDays(30), Carbon::now()])
            ->get();

        $purchases = Transaction::where('category_id', 2)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->paginate(15);
        return view('user.purchase.purchase', compact(
            'purchases',
            'purchaseMonth'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $contacts = Contact::where('umkm_id', Auth::user()->umkm->id)
            ->where('type', 'Supplier')
            ->orWhere('type', 'Lainnya')
            ->get();

        $products = Product::where('umkm_id', Auth::user()->umkm->id)
            ->whereHas('purchase', function ($q) {
                $q->whereNotNull('id');
            })->get();

        $products_json = Product::where('umkm_id', Auth::user()->umkm->id)
            ->whereHas('purchase', function ($q) {
                $q->whereNotNull('id');
            })->with('purchase')
            ->get()->toJson();

        $coas = Coa::where('umkm_id', Auth::user()->umkm->id)->get();

        return view('user.purchase.create_purchase', compact(
            'contacts',
            'products',
            'products_json',
            'coas',
        ));
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
            }

            // cut
            $cuts = 0;
            if (!empty($request->cut)) {
                $cuts = $subtotal * $request->cut / 100;
                $total -= $cuts;
            }

            // check kas balance
            $kas = Coa::where('umkm_id', Auth::user()->umkm->id)
                ->where('category_id', 1)
                ->get()
                ->first();
            if ($request->status == 'paid') {
                if ($kas->balance() < $total) {
                    return redirect()->route('umkm.purchase.create')->with('alert', 'Saldo kas tidak mencukupi.');
                }
            }

            // code for generate invoice
            $lastTransaction = Transaction::where('category_id', 2)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->get()
                ->last();
            if (!empty($lastTransaction)) {
                $pieces = explode(' ', $lastTransaction->invoice);
                $lastInvoiceCode = array_pop($pieces);

                $numbering = (int) str_replace('#', '', $lastInvoiceCode);
                $newInvoice = 'Faktur Pembelian #' . ($numbering + 1);
            } else {
                $newInvoice = 'Faktur Pembelian #10001';
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
                'category_id' => 2,
                'umkm_id' => Auth::user()->umkm->id,
                'taxtotal' => $taxtotal,
                'subtotal' => $subtotal,
                'cuttotal' => $cuts
            ]);

            // create detail transaction
            for ($x = 0; $x < count($request->price); $x++) {
                $product = Product::findOrFail($request->product_id[$x]);

                $price = (float) preg_replace('/[^\d]/', '', $request->price[$x]);
                $product->purchase->update([
                    'price' => $price
                ]);

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
                        'stock' => $product->stock->stock + $request->quantity[$x]
                    ]);

                    // persediaan barang
                    $persediaan_barang = Coa::findOrFail($product->stock->coa_id);

                    $coa_transaction = Coa_Transaction::where('coa_id', $persediaan_barang->id)
                        ->where('transaction_id', $transaction->id)
                        ->get()
                        ->last();
                    if (!empty($coa_transaction)) {
                        $coa_transaction->update([
                            'debit' => $coa_transaction->debit + ($price * $request->quantity[$x])
                        ]);
                    } else {
                        Coa_Transaction::create([
                            'transaction_id' => $transaction->id,
                            'coa_id' => $persediaan_barang->id,
                            'debit' => $price * $request->quantity[$x]
                        ]);
                    }
                }

                // update if aset produk
                if ($product->purchase->coa->category_id == 5) {
                    $aktiva_tetap = Coa::findOrFail($product->purchase->coa_id);

                    $coa_transaction = Coa_Transaction::where('coa_id', $aktiva_tetap->id)
                        ->where('transaction_id', $transaction->id)
                        ->get()
                        ->last();
                    if (!empty($coa_transaction)) {
                        $coa_transaction->update([
                            'debit' => $coa_transaction->debit + ($price * $request->quantity[$x])
                        ]);
                    } else {
                        Coa_Transaction::create([
                            'transaction_id' => $transaction->id,
                            'coa_id' => $aktiva_tetap->id,
                            'debit' => $price * $request->quantity[$x]
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
                Coa_Transaction::create([
                    'transaction_id' => $transaction->id,
                    'coa_id' => $hutang_pajak->id,
                    'credit' => $cuts
                ]);
            }

            if ($taxtotal != 0) {
                $ppn = Coa::where('umkm_id', Auth::user()->umkm->id)
                    ->where('code', '1-10500')
                    ->get()
                    ->last();

                Coa_Transaction::create([
                    'transaction_id' => $transaction->id,
                    'coa_id' => $ppn->id,
                    'debit' => $taxtotal
                ]);
            }

            // hutang usaha
            $hutang_usaha = Coa::where('umkm_id', Auth::user()->umkm->id)
                ->where('code', '2-20100')
                ->get()
                ->last();
            Coa_Transaction::create([
                'transaction_id' => $transaction->id,
                'coa_id' => $hutang_usaha->id,
                'credit' => $total
            ]);

            // create receive payment
            if ($request->status == 'paid') {
                $this->create_purchase_payment($total, $kas->id, $request->date, $transaction->id);
            }

            return redirect()->route('umkm.purchase.index');
        } catch (Exception $e) {
            return redirect()->route('umkm.purchase.create')->with('alert', $e->getMessage());
        }
    }

    public function partial_payment(Request $request)
    {
        $kas = Coa::where('umkm_id', Auth::user()->umkm->id)
            ->where('category_id', 2)
            ->get()
            ->first();
        $this->create_purchase_payment($request->total, $kas->id, $request->date, $request->transaction_id);
        return redirect()->route('umkm.purchase.index');
    }

    public function create_purchase_payment($total, $kas_id, $date, $transaction_id): void
    {
        // update last transaction remaining bill
        $purchase_transaction = Transaction::findOrFail($transaction_id);
        $purchase_transaction->update(['remaining_bill' => $purchase_transaction->remaining_bill - $total]);
        if ($purchase_transaction->remaining_bill <= 0) {
            $purchase_transaction->update(['status' => 'paid']);
        }

        // code for generate invoice
        $lastTransaction = Transaction::where('category_id', 8)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->get()
            ->last();
        if (!empty($lastTransaction)) {
            $pieces = explode(' ', $lastTransaction->invoice);
            $lastInvoiceCode = array_pop($pieces);

            $numbering = (int) str_replace('#', '', $lastInvoiceCode);
            $newInvoice = 'Purchase Payment #' . ($numbering + 1);
        } else {
            $newInvoice = 'Purchase Payment #10001';
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
            'cuttotal' => 0,
            'paid_id' => $transaction_id,
        ]);

        TransactionDetail::create([
            'transaction_id' => $transaction->id,
            'price' => $total,
            'tax' => 0,
        ]);

        $hutang_usaha = Coa::where('umkm_id', Auth::user()->umkm->id)
            ->where('code', '2-20100')
            ->get()
            ->last();
        Coa_Transaction::create([
            'transaction_id' => $transaction->id,
            'coa_id' => $hutang_usaha->id,
            'debit' => $total,
        ]);

        $kas = Coa::findOrFail($kas_id);
        Coa_Transaction::create([
            'transaction_id' => $transaction->id,
            'coa_id' => $kas->id,
            'credit' => $total,
        ]);
    }

    public function update_purchase_payment($total, $kas_id, $date, $transaction_id): void
    {
        // update last transaction remaining bill
        $purchase_transaction = Transaction::findOrFail($transaction_id);
        $purchase_transaction->update(['remaining_bill' => $purchase_transaction->remaining_bill - $total]);
        if ($purchase_transaction->remaining_bill <= 0) {
            $purchase_transaction->update(['status' => 'paid']);
        }

        $transaction = Transaction::where('paid_id', $purchase_transaction->id)
            ->get()
            ->last();

        if (!empty($transaction)) {
            // update transaction
            $transaction->update([
                'status' => 'paid',
                'total' => $total,
                'date' => Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'),
                'subtotal' => $total,
                'paid_id' => $transaction_id,
            ]);
            $transactionDetail = TransactionDetail::where('transaction_id', $transaction->id)
                ->get()
                ->last();
            $transactionDetail->update([
                'transaction_id' => $transaction->id,
                'price' => $total,
                'tax' => 0,
            ]);
        } else {
            // code for generate invoice
            $lastTransaction = Transaction::where('category_id', 8)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->get()
                ->last();
            if (!empty($lastTransaction)) {
                $pieces = explode(' ', $lastTransaction->invoice);
                $lastInvoiceCode = array_pop($pieces);

                $numbering = (int) str_replace('#', '', $lastInvoiceCode);
                $newInvoice = 'Purchase Payment #' . ($numbering + 1);
            } else {
                $newInvoice = 'Purchase Payment #10001';
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
                'cuttotal' => 0,
                'paid_id' => $transaction_id,
            ]);

            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'price' => $total,
                'tax' => 0,
            ]);
        }



        $hutang_usaha = Coa::where('umkm_id', Auth::user()->umkm->id)
            ->where('code', '2-20100')
            ->get()
            ->last();
        $hu_transaction = Coa_Transaction::where('coa_id', $hutang_usaha->id)
            ->where('transaction_id', $transaction->id)
            ->get()
            ->last();
        if (!empty($hu_transaction)) {
            $hu_transaction->update([
                'debit' => $total
            ]);
        } else {
            Coa_Transaction::create([
                'transaction_id' => $transaction->id,
                'coa_id' => $hutang_usaha->id,
                'debit' => $total,
            ]);
        }

        $kas = Coa::findOrFail($kas_id);
        $kas_transaction = Coa_Transaction::where('coa_id', $kas->id)
            ->where('transaction_id', $transaction->id)
            ->get()
            ->last();
        if (!empty($kas_transaction)) {
            $kas_transaction->update([
                'credit' => $total
            ]);
        } else {
            Coa_Transaction::create([
                'transaction_id' => $transaction->id,
                'coa_id' => $kas->id,
                'credit' => $total,
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction = Transaction::findOrFail($id);

        return view('user.purchase.show_purchase', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transaction = Transaction::findOrFail($id);
        $contacts = Contact::where('umkm_id', Auth::user()->umkm->id)
            ->where('type', 'Supplier')
            ->orWhere('type', 'Lainnya')
            ->get();

        $products = Product::where('umkm_id', Auth::user()->umkm->id)
            ->whereHas('purchase', function ($q) {
                $q->whereNotNull('id');
            })->get();

        $products_json = Product::where('umkm_id', Auth::user()->umkm->id)
            ->whereHas('purchase', function ($q) {
                $q->whereNotNull('id');
            })->with('purchase')
            ->get()->toJson();

        $coas = Coa::where('umkm_id', Auth::user()->umkm->id)->get();

        return view('user.purchase.edit_purchase', compact(
            'contacts',
            'products',
            'products_json',
            'coas',
            'transaction'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
            }

            // cut
            $cuts = 0;
            if (!empty($request->cut)) {
                $cuts = $subtotal * $request->cut / 100;
                $total -= $cuts;
            }

            // check kas balance
            $kas = Coa::where('umkm_id', Auth::user()->umkm->id)
                ->where('category_id', 1)
                ->get()
                ->first();
            if ($request->status == 'paid') {
                if ($kas->balance() < $total) {
                    return redirect()->route('umkm.purchase.create')->with('alert', 'Saldo kas tidak mencukupi.');
                }
            }

            $transaction = Transaction::findOrFail($id);

            // create transaction
            $transaction->update([
                'contact_id' => $request->contact_id,
                'status' => $request->status,
                'total' => $total,
                'cut' => $request->cut ?? 0,
                'remaining_bill' => $total,
                'date' => Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d'),
                'due_date' => Carbon::createFromFormat('d/m/Y', $request->due_date)->format('Y-m-d'),
                'category_id' => 2,
                'umkm_id' => Auth::user()->umkm->id,
                'taxtotal' => $taxtotal,
                'subtotal' => $subtotal,
                'cuttotal' => $cuts
            ]);

            // create detail transaction
            $transactionDetails = TransactionDetail::where('transaction_id', $transaction->id)
                ->get();
            for ($x = 0; $x < count($request->price); $x++) {
                $product = Product::findOrFail($request->product_id[$x]);

                $price = (float) preg_replace('/[^\d]/', '', $request->price[$x]);
                $product->purchase->update([
                    'price' => $price
                ]);

                $lastQuantity = $transactionDetails[$x]->quantity;

                if (!empty($transactionDetails[$x])) {
                    $transactionDetails[$x]->update([
                        'transaction_id' => $transaction->id,
                        'product_id' => $request->product_id[$x],
                        'quantity' => $request->quantity[$x],
                        'description' => $request->description[$x],
                        'price' => $price,
                        'tax' => $request->tax[$x] ?? 0,
                    ]);
                } else {
                    TransactionDetail::create([
                        'transaction_id' => $transaction->id,
                        'product_id' => $request->product_id[$x],
                        'quantity' => $request->quantity[$x],
                        'description' => $request->description[$x],
                        'price' => $price,
                        'tax' => $request->tax[$x] ?? 0,
                    ]);
                }

                // update product stock
                if (!empty($product->stock)) {
                    $product->stock->update([
                        'stock' => $product->stock->stock - $lastQuantity + $request->quantity[$x]
                    ]);

                    // persediaan barang
                    $persediaan_barang = Coa::findOrFail($product->stock->coa_id);

                    $coa_transaction = Coa_Transaction::where('coa_id', $persediaan_barang->id)
                        ->where('transaction_id', $transaction->id)
                        ->get()
                        ->last();
                    if (!empty($coa_transaction)) {
                        $coa_transaction->update([
                            'debit' => $x < $transactionDetails->count() ? $price * $request->quantity[$x] : $coa_transaction->debit + ($price * $request->quantity[$x])
                        ]);
                    } else {
                        Coa_Transaction::create([
                            'transaction_id' => $transaction->id,
                            'coa_id' => $persediaan_barang->id,
                            'debit' => $price * $request->quantity[$x]
                        ]);
                    }
                }

                // update if aset produk
                if ($product->purchase->coa->category_id == 5) {
                    $aktiva_tetap = Coa::findOrFail($product->purchase->coa_id);

                    $coa_transaction = Coa_Transaction::where('coa_id', $aktiva_tetap->id)
                        ->where('transaction_id', $transaction->id)
                        ->get()
                        ->last();
                    if (!empty($coa_transaction)) {
                        $coa_transaction->update([
                            'debit' => $price * $request->quantity[$x] ? $price * $request->quantity[$x] : $coa_transaction->debit + ($price * $request->quantity[$x])
                        ]);
                    } else {
                        Coa_Transaction::create([
                            'transaction_id' => $transaction->id,
                            'coa_id' => $aktiva_tetap->id,
                            'debit' => $price * $request->quantity[$x]
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

                $coa_transaction = Coa_Transaction::where('coa_id', $hutang_pajak->id)
                    ->where('transaction_id', $transaction->id)
                    ->get()
                    ->last();

                if (!empty($coa_transaction)) {
                    $coa_transaction->update([
                        'credit' => $cuts
                    ]);
                } else {
                    Coa_Transaction::create([
                        'transaction_id' => $transaction->id,
                        'coa_id' => $hutang_pajak->id,
                        'credit' => $cuts
                    ]);
                }
            }

            if ($taxtotal != 0) {
                $ppn = Coa::where('umkm_id', Auth::user()->umkm->id)
                    ->where('code', '1-10500')
                    ->get()
                    ->last();

                $coa_transaction = Coa_Transaction::where('coa_id', $ppn->id)
                    ->where('transaction_id', $transaction->id)
                    ->get()
                    ->last();


                if (!empty($coa_transaction)) {
                    $coa_transaction->update([
                        'debit' => $taxtotal
                    ]);
                } else {
                    Coa_Transaction::create([
                        'transaction_id' => $transaction->id,
                        'coa_id' => $hutang_pajak->id,
                        'debit' => $taxtotal
                    ]);
                }
            }

            // hutang usaha
            $hutang_usaha = Coa::where('umkm_id', Auth::user()->umkm->id)
                ->where('code', '2-20100')
                ->get()
                ->last();
            $coa_transaction_hu = Coa_Transaction::where('coa_id', $hutang_usaha->id)
                ->where('transaction_id', $transaction->id)
                ->get()
                ->last();
            if (!empty($coa_transaction_hu)) {
                $coa_transaction_hu->update([
                    'credit' => $total
                ]);
            } else {
                Coa_Transaction::create([
                    'transaction_id' => $transaction->id,
                    'coa_id' => $hutang_usaha->id,
                    'credit' => $total
                ]);
            }

            // create receive payment
            if ($request->status == 'paid') {
                $this->update_purchase_payment($total, $kas->id, $request->date, $transaction->id);
            }

            return redirect()->route('umkm.purchase.index');
        } catch (Exception $e) {
            return redirect()->route('umkm.purchase.create')->with('alert', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = Transaction::findOrFail($id);

        Coa_Transaction::where('transaction_id', $transaction->id)
            ->delete();

        TransactionDetail::where('transaction_id', $transaction->id)
            ->delete();

        $transactionPayment = Transaction::where('paid_id', $transaction->id)
            ->get();

        foreach ($transactionPayment as $t) {
            Coa_Transaction::where('transaction_id', $t->id)
                ->delete();

            TransactionDetail::where('transaction_id', $t->id)
                ->delete();

            $t->delete();
        }

        $transaction->delete();

        return redirect()->route('umkm.purchase.index');
    }
}
