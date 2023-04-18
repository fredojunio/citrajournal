<?php

namespace App\Http\Controllers;

use App\Models\Coa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        return view('user.report.report');
    }

    public function labarugi(Request $request)
    {
        $date = $request->date;
        $due_date = $request->due_date;
        if (!empty($date)) {
            $pendapatan = Coa::where('category_id', 12)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->where('balance', '!=', 0)
                ->get();

            $beban_pendapatan = Coa::where('category_id', 13)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->where('balance', '!=', 0)
                ->get();

            $beban_operasional = Coa::where('umkm_id', Auth::user()->umkm->id)
                ->where('balance', '!=', 0)
                ->where(function ($q) {
                    $q->where('category_id', 14)
                        ->orWhere('category_id', 16);
                })
                ->get();

            $pendapatan_lain = Coa::where('umkm_id', Auth::user()->umkm->id)
                ->where('balance', '!=', 0)
                ->where('category_id', 15)
                ->get();
            $beban_lain = Coa::where('umkm_id', Auth::user()->umkm->id)
                ->where('balance', '!=', 0)
                ->where('category_id', 16)
                ->get();

            return view('user.report.labarugi', compact(
                'pendapatan',
                'beban_pendapatan',
                'beban_operasional',
                'pendapatan_lain',
                'beban_lain',
                'date',
                'due_date'
            ));
        }

        return view('user.report.labarugi');
    }

    public function neraca(Request $request)
    {
        $date = $request->date;


        if (!empty($date)) {
            $aset_lancar = Coa::where('category_id', '<=', 4)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->where('balance', '!=', 0)
                ->get();

            $aset_tetap = Coa::where('category_id', 5)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->where('balance', '!=', 0)
                ->get();

            $liabilitas_pendek = Coa::where('category_id', '>=', 8)
                ->where('category_id', '<=', 9)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->where('balance', '!=', 0)
                ->get();

            $modal_saham = Coa::where('category_id', 11)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->where('balance', '!=', 0)
                ->get();


            // hitung laba rugi
            $pendapatan = Coa::where('category_id', 12)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->where('balance', '!=', 0)
                ->get();

            $beban_pendapatan = Coa::where('category_id', 13)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->where('balance', '!=', 0)
                ->get();

            $beban_operasional = Coa::where('umkm_id', Auth::user()->umkm->id)
                ->where('balance', '!=', 0)
                ->where(function ($q) {
                    $q->where('category_id', 14)
                        ->orWhere('category_id', 16);
                })
                ->get();

            $pendapatan_lain = Coa::where('umkm_id', Auth::user()->umkm->id)
                ->where('balance', '!=', 0)
                ->where('category_id', 15)
                ->get();
            $beban_lain = Coa::where('umkm_id', Auth::user()->umkm->id)
                ->where('balance', '!=', 0)
                ->where('category_id', 16)
                ->get();
            $labarugi = $pendapatan->sum('balance') -
                $beban_pendapatan->sum('balance') -
                $beban_operasional->sum('balance') +
                ($pendapatan_lain->sum('balance') - $beban_lain->sum('balance'));

            return view('user.report.neraca', compact(
                'aset_lancar',
                'aset_tetap',
                'liabilitas_pendek',
                'modal_saham',
                'labarugi',
                'date'
            ));
        }

        return view('user.report.neraca');
    }

    public function healthanalysis(Request $request)
    {
        $date = $request->date;
        $due_date = $request->due_date;

        if (!empty($date)) {
            // aset lancar
            $aset_lancar = Coa::where('category_id', '<=', 4)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->where('balance', '!=', 0)
                ->get()->sum('balance');

            $liabilitas_pendek = Coa::where('category_id', '>=', 8)
                ->where('category_id', '<=', 9)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->where('balance', '!=', 0)
                ->get()->sum('balance');

            $total_aset = $aset_tetap = Coa::where('category_id', 5)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->where('balance', '!=', 0)
                ->get()->sum('balance') + $aset_lancar;

            $laba_operasional = Coa::where('category_id', 12)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->where('balance', '!=', 0)
                ->get()->sum('balance') -
                Coa::where('category_id', 13)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->where('balance', '!=', 0)
                ->get()->sum('balance') -
                Coa::where('umkm_id', Auth::user()->umkm->id)
                ->where('balance', '!=', 0)
                ->where(function ($q) {
                    $q->where('category_id', 14)
                        ->orWhere('category_id', 16);
                })
                ->get()->sum('balance');


            $pendapatan_lain = Coa::where('umkm_id', Auth::user()->umkm->id)
                ->where('balance', '!=', 0)
                ->where('category_id', 15)
                ->get();
            $beban_lain = Coa::where('umkm_id', Auth::user()->umkm->id)
                ->where('balance', '!=', 0)
                ->where('category_id', 16)
                ->get();
            $laba_bersih = $laba_operasional + $pendapatan_lain->sum('balance') - $beban_lain->sum('balance');
            $laba_ditahan = $laba_bersih - $beban_lain = Coa::where('umkm_id', Auth::user()->umkm->id)
                ->where('code', '3-30200')
                ->get()->sum('balance');

            $liabilitas = Coa::where('category_id', '>=', 8)
                ->where('category_id', '<=', 9)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->where('balance', '!=', 0)
                ->get()->sum('balance') +
                Coa::where('category_id', 10)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->where('balance', '!=', 0)
                ->get()->sum('balance');

            $modal_disetor = Coa::where('category_id', 11)
                ->where('code', '3-30000')
                ->where('balance', '!=', 0)
                ->get()->sum('balance') + Coa::where('category_id', 11)
                ->where('code', '3-30001')
                ->where('balance', '!=', 0)
                ->get()->sum('balance');


            $x1 = (($aset_lancar - $liabilitas) / $total_aset) * 6.56;
            $x2 = 3.26 * ($laba_operasional / $total_aset);
            $x3 = 6.72 * ($laba_operasional / $total_aset);
            $x4 = 1.05 * ($modal_disetor / $liabilitas);

            $zscore = $x1 + $x2 + $x3 + $x4;

            if ($zscore > 2.6) {
                $advices = [
                    "Pastikan kinerja keuangan UMKM tetap stabil dengan menjaga pengeluaran dan pemasukan tetap seimbang.",
                    "Cobalah untuk menambah jenis produk atau layanan yang ditawarkan untuk mengurangi risiko usaha jika salah satu produk atau layanan mengalami penurunan permintaan.",
                    "Lakukan promosi yang tepat sasaran dan hemat biaya untuk menarik lebih banyak pelanggan.",
                    "Hindari pembelian barang yang tidak diperlukan atau pemborosan biaya."
                ];
            } else if ($zscore < 1.8) {
                $advices = [
                    "Segera evaluasi keuangan UMKM dan identifikasi masalahnya dengan mencari tahu rasio-rasio keuangan yang lemah.",
                    "Carilah bantuan keuangan dari pihak kreditur atau investor untuk membantu UMKM melewati masa-masa sulit tersebut.",
                    "Kurangi pengeluaran yang tidak penting dan tingkatkan pendapatan dengan cara memperluas pasar dan menawarkan diskon atau penawaran khusus untuk menarik lebih banyak pelanggan.",
                    "Cari cara baru untuk menghasilkan uang dengan mencari pasar baru atau menambah produk atau layanan yang ditawarkan."
                ];
            } else {
                $advices = [
                    "Periksa kembali posisi keuangan UMKM dan cari cara untuk meningkatkan kinerja keuangan dengan cara mengevaluasi rasio-rasio keuangan yang lemah.",
                    "Cari tahu apa yang membuat pelanggan lebih tertarik pada produk atau layanan yang ditawarkan dan cobalah untuk meningkatkan kualitas produk atau layanan tersebut.",
                    "Kurangi biaya produksi dan operasional dengan cara memilih suplier yang lebih murah atau memanfaatkan teknologi untuk meningkatkan efisiensi produksi.",
                    "Bila mungkin, selalu sediakan cadangan dana untuk keperluan operasional UMKM agar dapat mengantisipasi risiko bisnis yang tidak terduga."
                ];
            }

            return view('user.report.healthanalysis', compact(
                'aset_lancar',
                'liabilitas_pendek',
                'total_aset',
                'laba_operasional',
                'laba_ditahan',
                'liabilitas',
                'modal_disetor',
                'x1',
                'x2',
                'x3',
                'x4',
                'zscore',
                'advices',
                'date',
                'due_date'
            ));
        }

        return view('user.report.healthanalysis');
    }
}
