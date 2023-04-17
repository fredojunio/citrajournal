<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        return view('user.report.report');
    }

    public function labarugi()
    {
        return view('user.report.labarugi');
    }

    public function neraca(Request $request)
    {
        $date = $request->date;
        $due_date = $request->due_date;
        $kas = Kas::where('umkm_id', Auth::user()->umkm->id)
            ->get()
            ->first();

        // piutang
        $allPiutang = Transaction::where('category_id', 1)
            ->where('kas_id', $kas->id)
            ->where('status', 'open')
            ->get();
        $piutangValue = 0;
        foreach ($allPiutang as $piutang) {
            $piutangValue += $piutang->remaining_bill;
        }

        // persediaan barang
        $barangValue = 0;
        $products = Product::where('umkm_id', Auth::user()->umkm->id)
            ->whereHas('stock', function ($q) {
                $q->where('stock', '!=', '0');
            })->whereHas('purchase')
            ->get();
        foreach ($products as $product) {
            $barangValue += $product->purchase->price;
        }

        // biaya muka
        $biayamukas = Transaction::where('kas_id', $kas->id)
            ->where('category_id', 6)
            ->get();
        $biayamukaValue = 0;
        foreach ($biayamukas as $biayamuka) {
            $taxtotal = 0;
            foreach ($biayamuka->details as $detail) {
                $taxtotal += (($detail->price * $detail->tax / 100) * $detail->quantity);
                $biayamukaValue += ($detail->price + $taxtotal);
            }
        }

        // ppn masukan
        // $ppnmasukans = $Transaction

        $aset_lancar = [
            [
                'code' => '1-10001',
                'title' => 'Kas',
                'value' => $kas->balance
            ],
            [
                'code' => '1-10100',
                'title' => 'Piutang Usaha',
                'value' => $piutangValue
            ],
            [
                'code' => '1-10200',
                'title' => 'Persediaan Barang',
                'value' => $barangValue
            ],
            [
                'code' => '1-10402',
                'title' => 'Biaya Dibayar Di Muka',
                'value' => $biayamukaValue
            ],
            // [
            //     'code' => '1-10500',
            //     'title' => 'PPN Masukan',
            //     'value' => $ppnMasukan
            // ],
        ];
        return view('user.report.neraca', compact('aset_lancar'));
    }

    public function healthanalysis()
    {
        return view('user.report.healthanalysis');
    }
}
