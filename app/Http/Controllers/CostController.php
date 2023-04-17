<?php

namespace App\Http\Controllers;

use App\Models\Coa;
use App\Models\Coa_Transaction;
use App\Models\Contact;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $costs = TransactionDetail::whereHas('transaction', function ($q) {
            $q->where('umkm_id', Auth::user()->umkm->id)
                ->where('category_id', 3);
        })->paginate(15);

        return view('user.cost.cost', compact('costs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kass = Coa::where('category_id', 1)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->get();

        $contacts = Contact::where('umkm_id', Auth::user()->umkm->id)
            ->get();

        $coas = Coa::where('umkm_id', Auth::user()->umkm->id)
            ->where('category_id', 14)
            ->orWhere('category_id', 16)
            ->get();

        return view('user.cost.create_cost', compact('kass', 'contacts', 'coas'));
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
                $subtotal += $price;
                $tax = $price * ($request->tax[$x] ?? 0 / 100);
                $taxtotal += $tax;

                $total += ($price + $tax);
            }

            // cut
            $cuts = 0;
            if (!empty($request->cut)) {
                $cuts = $subtotal * $request->cut / 100;
                $total -= $cuts;
            }

            // update kas
            $kas = Coa::findOrFail($request->kas_id);
            if ($kas->balance < $total) {
                return redirect()->route('umkm.purchase.create')->with('alert', 'Saldo kas tidak mencukupi.');
            }
            $kas->update([
                'balance' => $kas->balance - $total
            ]);

            // code for generate invoice
            $lastTransaction = Transaction::where('category_id', 3)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->get()
                ->last();
            if (!empty($lastTransaction)) {
                $pieces = explode(' ', $lastTransaction->invoice);
                $lastInvoiceCode = array_pop($pieces);

                $numbering = (int) str_replace('#', '', $lastInvoiceCode);
                $newInvoice = 'Expense #' . ($numbering + 1);
            } else {
                $newInvoice = 'Expense #10001';
            }

            // create transaction
            $transaction = Transaction::create([
                'contact_id' => $request->contact_id,
                'invoice' => $newInvoice,
                'status' => 'paid',
                'total' => $total,
                'cut' => $request->cut ?? 0,
                'remaining_bill' => 0,
                'date' => Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d'),
                'category_id' => 3,
                'umkm_id' => Auth::user()->umkm->id,
                'taxtotal' => $taxtotal,
                'subtotal' => $subtotal,
                'cuttotal' => $cuts,
            ]);

            // create detail transaction
            for ($x = 0; $x < count($request->price); $x++) {
                $price = (float) preg_replace('/[^\d]/', '', $request->price[$x]);
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'description' => $request->description[$x],
                    'price' => $price,
                    'tax' => $request->tax[$x] ?? 0,
                    'coa_id' => $request->coa_id[$x],
                ]);

                // update coa balance
                $coa = Coa::findOrFail($request->coa_id[$x]);
                $coa->update([
                    'balance' => $coa->balance + $price
                ]);

                // cost
                $coa_transaction = Coa_Transaction::where('coa_id', $coa->id)
                    ->where('transaction_id', $transaction->id)
                    ->get()
                    ->last();
                if (!empty($coa_transaction)) {
                    $coa_transaction->update([
                        'debit' => $coa_transaction->debit + $price
                    ]);
                } else {
                    Coa_Transaction::create([
                        'transaction_id' => $transaction->id,
                        'coa_id' => $request->coa_id[$x],
                        'debit' => $price
                    ]);
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
                // ppn masukan
                $ppn = Coa::where('umkm_id', Auth::user()->umkm->id)
                    ->where('code', '1-10500')
                    ->get()
                    ->last();

                $ppn->update(['balance' => $ppn->balance + $taxtotal]);

                Coa_Transaction::create([
                    'transaction_id' => $transaction->id,
                    'coa_id' => $ppn->id,
                    'debit' => $taxtotal
                ]);
            }

            // kas
            Coa_Transaction::create([
                'transaction_id' => $transaction->id,
                'coa_id' => $kas->id,
                'credit' => $subtotal
            ]);

            return redirect()->route('umkm.cost.index');
        } catch (Exception $e) {
            return redirect()->route('umkm.cost.create')->with('alert', $e->getMessage());
        }
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
