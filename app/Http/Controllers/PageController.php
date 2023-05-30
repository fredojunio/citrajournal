<?php

namespace App\Http\Controllers;

use App\Models\Coa;
use App\Models\Transaction;
use App\Models\Umkm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('umkm.index');
        } else {
            return redirect()->route('landing_page');
        }
    }

    public function landing_page()
    {
        return view('user.landing_page');
    }

    public function dashboard()
    {
        $kas = Coa::where('umkm_id', Auth::user()->umkm->id)
            ->where('category_id', 1)
            ->get()
            ->first();

        // aset lancar
        $aset_lancar = Coa::where('category_id', '<=', 4)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            })->map->balance()->sum();

        $liabilitas_pendek = Coa::where('category_id', '>=', 8)
            ->where('category_id', '<=', 9)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            })->map->balance()->sum();

        $total_aset = $aset_tetap = Coa::where('category_id', 5)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            })->map->balance()->sum() + $aset_lancar;

        $laba_operasional = Coa::where('category_id', 12)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            })->map->balance()->sum() -
            Coa::where('category_id', 13)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            })->map->balance()->sum() -
            Coa::where('umkm_id', Auth::user()->umkm->id)
            ->where(function ($q) {
                $q->where('category_id', 14)
                    ->orWhere('category_id', 16);
            })
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            })->map->balance()->sum();


        $pendapatan_lain = Coa::where('umkm_id', Auth::user()->umkm->id)
            ->where('category_id', 15)
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            });
        $beban_lain = Coa::where('umkm_id', Auth::user()->umkm->id)
            ->where('category_id', 16)
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            });
        $laba_bersih = $laba_operasional + $pendapatan_lain->map->balance()->sum() - $beban_lain->map->balance()->sum();
        $laba_ditahan = $laba_bersih - $beban_lain = Coa::where('umkm_id', Auth::user()->umkm->id)
            ->where('code', '3-30200')
            ->get()->map->balance()->sum();

        $liabilitas = Coa::where('category_id', '>=', 8)
            ->where('category_id', '<=', 9)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            })->map->balance()->sum() +
            Coa::where('category_id', 10)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            })->map->balance()->sum();

        $modal_disetor = Coa::where('category_id', 11)
            ->where('code', '3-30000')
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            })->map->balance()->sum() + Coa::where('category_id', 11)
            ->where('code', '3-30001')
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            })->map->balance()->sum();


        if ($total_aset != 0) {
            $x1 = (($aset_lancar - $liabilitas) / $total_aset) * 6.56;
            $x2 = 3.26 * ($laba_operasional / $total_aset);
            $x3 = 6.72 * ($laba_operasional / $total_aset);
        } else {
            $x1 = 0;
            $x2 = 0;
            $x3 = 0;
        }
        if ($liabilitas != 0) {
            $x4 = 1.05 * ($modal_disetor / $liabilitas);
        } else {
            $x4 = 0;
        }

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

        $pendapatan = Coa::where('category_id', 12)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            });

        // hitung laba rugi
        $pendapatan = Coa::where('category_id', 12)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            });

        $beban_pendapatan = Coa::where('category_id', 13)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            });

        $beban_operasional = Coa::where('umkm_id', Auth::user()->umkm->id)
            ->where(function ($q) {
                $q->where('category_id', 14)
                    ->orWhere('category_id', 16);
            })
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            });

        $pendapatan_lain = Coa::where('umkm_id', Auth::user()->umkm->id)
            ->where('category_id', 15)
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            });
        $beban_lain = Coa::where('umkm_id', Auth::user()->umkm->id)
            ->where('category_id', 16)
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            });
        $labarugi = $pendapatan->map->balance()->sum() -
            $beban_pendapatan->map->balance()->sum() -
            $beban_operasional->map->balance()->sum() +
            ($pendapatan_lain->map->balance()->sum() - $beban_lain->map->balance()->sum());

        $transactions = Transaction::where('umkm_id', Auth::user()->umkm->id)
            ->where('category_id', '!=', 7)
            ->where('category_id', '!=', 8)
            ->get()->count();

        $sales = Transaction::where('category_id', 1)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->get();

        $revenues = collect();
        $revenuesDate = collect();
        foreach ($pendapatan as $p) {
            foreach ($p->coa_transactions as $t) {
                $total = $t->debit - $t->credit;
                if ($total < 0) {
                    $total = -$total;
                }
                $revenues->push($total);
                $revenuesDate->push($t->transaction->date);
            }
        }
        foreach ($pendapatan_lain as $p) {
            foreach ($p->coa_transactions as $t) {
                $total = $t->debit - $t->credit;
                if ($total < 0) {
                    $total = -$total;
                }
                $revenues->push($total);
                $revenuesDate->push($t->transaction->date);
            }
        }

        $costs = collect();
        $costsDate = collect();
        $expenses = collect();
        $expensesName = collect();
        foreach ($beban_pendapatan as $b) {
            foreach ($b->coa_transactions as $t) {
                $total = $t->debit - $t->credit;
                if ($total < 0) {
                    $total = -$total;
                }
                $costs->push($total);
                $costsDate->push($t->transaction->date);

                $expenses->push(['name' => $t->coa->name, 'y' => $total]);
            }
        }
        foreach ($beban_operasional as $b) {
            foreach ($b->coa_transactions as $t) {
                $total = $t->debit - $t->credit;
                if ($total < 0) {
                    $total = -$total;
                }
                $costs->push($total);
                $costsDate->push($t->transaction->date);

                $expenses->push(['name' => $t->coa->name, 'y' => $total]);
            }
        }
        foreach ($beban_lain as $b) {
            foreach ($b->coa_transactions as $t) {
                $total = $t->debit - $t->credit;
                if ($total < 0) {
                    $total = -$total;
                }
                $costs->push($total);
                $costsDate->push($t->transaction->date);

                $expenses->push(['name' => $t->coa->name, 'y' => $total]);
            }
        }

        return view('user.main.dashboard', compact(
            'kas',
            'zscore',
            'advices',
            'pendapatan',
            'labarugi',
            'transactions',
            'sales',
            'revenues',
            'costs',
            'revenuesDate',
            'costsDate',
            'expenses'
        ));
    }

    public function alltransactions(Request $request)
    {
        $date = $request->date;
        $due_date = $request->due_date;
        if (!empty($date)) {
            $transactions = Transaction::where('umkm_id', Auth::user()->umkm->id)
                ->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')])
                ->orderBy('date')
                ->get();

            return view('user.main.alltransactions', compact(
                'transactions',
                'date',
                'due_date'
            ));
        }
        return view('user.main.alltransactions');
    }

    public function showTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);

        switch ($transaction->category_id) {
            case 1:
                return redirect()->route('umkm.sale.show', $id);
                break;
            case 2:
                return redirect()->route('umkm.purchase.show', $id);
                break;
            case 3:
                return redirect()->route('umkm.cost.show', $id);
                break;
            case 4:
            case 5:
            case 6:
                return view('user.main.show_transaction_bank', compact('transaction'));
                break;
            case 7:
            case 8:
                return view('user.main.show_transaction_payment', compact('transaction'));
                break;
            default:
                return redirect()->back();
        }
        if ($transaction->category_id == 1 && $transaction->category_id == 1) {
        }
    }
}
