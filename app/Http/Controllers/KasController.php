<?php

namespace App\Http\Controllers;

use App\Models\Coa;
use App\Models\Coa_Transaction;
use App\Models\Contact;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kass = Coa::where('umkm_id', Auth::user()->umkm->id)
            ->where('category_id', 1)
            ->get();
        return view('user.kas.kas', compact('kass'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    public function transfer_fund()
    {
        return view('user.kas.transfer_fund');
    }

    public function receive_money()
    {
        $kass = Coa::where('umkm_id', Auth::user()->umkm->id)
            ->where('category_id', 1)
            ->get();

        $coas = Coa::where('umkm_id', Auth::user()->umkm->id)
            ->get();

        $contacts = Contact::where('umkm_id', Auth::user()->umkm->id)
            ->get();

        return view('user.kas.receive_money', compact('kass', 'coas', 'contacts'));
    }

    public function store_receive_money(Request $request)
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

                $total += $price + $tax;
            }

            // update kas
            $kas = Coa::findOrFail($request->kas_id);
            $kas->update([
                'balance' => $kas->balance + $total
            ]);

            // code for generate invoice
            $lastTransaction = Transaction::where('category_id', 5)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->get()
                ->last();
            if (!empty($lastTransaction)) {
                $pieces = explode(' ', $lastTransaction->invoice);
                $lastInvoiceCode = array_pop($pieces);

                $numbering = (int) str_replace('#', '', $lastInvoiceCode);
                $newInvoice = 'Bank Deposit #' . ($numbering + 1);
            } else {
                $newInvoice = 'Bank Deposit #10001';
            }

            // create transaction
            $transaction = Transaction::create([
                'contact_id' => $request->contact_id,
                'invoice' => $newInvoice,
                'status' => 'paid',
                'total' => $total,
                'cut' => 0,
                'remaining_bill' => $total,
                'date' => Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d'),
                'category_id' => 5,
                'umkm_id' => Auth::user()->umkm->id,
                'cuttotal' => 0,
                'taxtotal' => $taxtotal,
                'subtotal' => $subtotal,
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

                // receive
                $coa_transaction = Coa_Transaction::where('coa_id', $request->coa_id[$x])
                    ->where('transaction_id', $transaction->id)
                    ->get()
                    ->last();
                if (!empty($coa_transaction)) {
                    $coa_transaction->update([
                        'credit' => $coa_transaction->credit + $price
                    ]);
                } else {
                    Coa_Transaction::create([
                        'transaction_id' => $transaction->id,
                        'coa_id' => $request->coa_id[$x],
                        'credit' => $price
                    ]);
                }
            }

            Coa_Transaction::create([
                'coa_id' => $kas->id,
                'transaction_id' => $transaction->id,
                'debit' => $total
            ]);

            // update coa balance
            if ($taxtotal != 0) {
                $ppn = Coa::where('umkm_id', Auth::user()->umkm->id)
                    ->where('code', '2-20500')
                    ->get()
                    ->last();

                $ppn->update(['balance' => $ppn->balance + $taxtotal]);

                Coa_Transaction::create([
                    'transaction_id' => $transaction->id,
                    'coa_id' => $ppn->id,
                    'debit' => $taxtotal
                ]);
            }

            return redirect()->route('umkm.kas.index');
        } catch (Exception $e) {
            return redirect()->route('umkm.kas.index');
        }
    }

    public function send_money()
    {
        $kass = Coa::where('umkm_id', Auth::user()->umkm->id)
            ->where('category_id', 1)
            ->get();

        $coas = Coa::where('umkm_id', Auth::user()->umkm->id)
            ->get();

        $contacts = Contact::where('umkm_id', Auth::user()->umkm->id)
            ->get();

        return view('user.kas.send_money', compact('kass', 'coas', 'contacts'));
    }

    public function store_send_money(Request $request)
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

                $total += $price + $tax;
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
                return redirect()->route('umkm.kas.send_money');
            }
            $kas->update([
                'balance' => $kas->balance - $total
            ]);

            // code for generate invoice
            $lastTransaction = Transaction::where('category_id', 5)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->get()
                ->last();
            if (!empty($lastTransaction)) {
                $pieces = explode(' ', $lastTransaction->invoice);
                $lastInvoiceCode = array_pop($pieces);

                $numbering = (int) str_replace('#', '', $lastInvoiceCode);
                $newInvoice = 'Bank Withdrawal #' . ($numbering + 1);
            } else {
                $newInvoice = 'Bank Withdrawal #10001';
            }

            // create transaction
            $transaction = Transaction::create([
                'contact_id' => $request->contact_id,
                'invoice' => $newInvoice,
                'status' => 'paid',
                'total' => $total,
                'cut' => $request->cut ?? 0,
                'remaining_bill' => $total,
                'date' => Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d'),
                'category_id' => 6,
                'umkm_id' => Auth::user()->umkm->id,
                'subtotal' => $subtotal,
                'taxtotal' => $taxtotal,
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

                // receive
                $coa_transaction = Coa_Transaction::where('coa_id', $request->coa_id[$x])
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

            Coa_Transaction::create([
                'coa_id' => $kas->id,
                'transaction_id' => $transaction->id,
                'credit' => $total
            ]);

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

            return redirect()->route('umkm.kas.index');
        } catch (Exception $e) {
            return redirect()->route('umkm.kas.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Kas $kas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kas $kas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kas $kas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kas $kas)
    {
        //
    }
}
