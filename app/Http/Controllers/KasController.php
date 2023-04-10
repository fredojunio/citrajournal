<?php

namespace App\Http\Controllers;

use App\Models\Coa;
use App\Models\Contact;
use App\Models\Kas;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kass = Kas::where('umkm_id', Auth::user()->umkm->id)->get();
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
        $kass = Kas::where('umkm_id', Auth::user()->umkm->id)
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
            for ($x = 0; $x < count($request->price); $x++) {
                $price = (float) preg_replace('/[^\d]/', '', $request->price[$x]);
                $total += $price + ($price * ($request->tax[$x] ?? 0 / 100));
            }

            // update kas
            $kas = Kas::findOrFail($request->kas_id);
            $kas->update([
                'balance' => $kas->balance + $total
            ]);

            // code for generate invoice
            $lastTransaction = Transaction::where('category_id', 5)->where('kas_id', $request->kas_id)->get()->last();
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
                'contact_id' => $request->contact_id,
                'invoice' => $newInvoice,
                'status' => 'Selesai',
                'total' => $total,
                'remaining_bill' => $total,
                'date' => new DateTime($request->date),
                'category_id' => 5,
                'kas_id' => $request->kas_id,
            ]);

            // create detail transaction
            for ($x = 0; $x < count($request->price); $x++) {
                $price = (float) preg_replace('/[^\d]/', '', $request->price[$x]);
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'description' => $request->description[$x],
                    'price' => $price,
                    'tax' => $request->tax[$x] ?? 0,
                ]);
            }

            return redirect()->route('umkm.kas.index');
        } catch (Exception $e) {
            return redirect()->route('umkm.kas.index');
        }
    }

    public function send_money()
    {
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
