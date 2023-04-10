<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Kas;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kas_id = Kas::where('umkm_id', Auth::user()->umkm->id)
            ->get()
            ->first()
            ->id;
        $purchases = Transaction::where('category_id', 2)
            ->where('kas_id', $kas_id)
            ->paginate(15);
        return view('user.purchase.purchase', compact('purchases'));
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

        return view('user.purchase.create_purchase', compact('contacts', 'products'));
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
            for ($x = 0; $x < count($request->price); $x++) {
                $price = (float) preg_replace('/[^\d]/', '', $request->price[$x]);
                $subtotal += ($price * $request->quantity[$x]);
                $total += (($price + ($price * (($request->tax[$x] ?? 0) / 100))) * $request->quantity[$x]);
            }

            // cut
            if (!empty($request->cut)) {
                $cuts = $subtotal * $request->cut / 100;
                $total -= $cuts;
            }

            // update kas
            $kas = Kas::where('umkm_id', Auth::user()->umkm->id)
                ->get()
                ->first();
            $kas->update([
                'balance' => $kas->balance - $total
            ]);

            // code for generate invoice
            $lastTransaction = Transaction::where('category_id', 2)
                ->where('kas_id', $kas->id)
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
                'remaining_bill' => $request->status == 'paid' ? 0 : $total,
                'date' => new DateTime($request->date),
                'due_date' => new DateTime($request->due_date),
                'category_id' => 2,
                'kas_id' => $kas->id,
            ]);

            // create detail transaction
            for ($x = 0; $x < count($request->price); $x++) {
                $price = (float) preg_replace('/[^\d]/', '', $request->price[$x]);
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $request->product_id[$x],
                    'quantity' => $request->quantity[$x],
                    'description' => $request->description[$x],
                    'price' => $price,
                    'tax' => $request->tax[$x] ?? 0,
                ]);
            }
            return redirect()->route('umkm.purchase.index');
        } catch (Exception $e) {
            return redirect()->route('umkm.purchase.index');
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
