<?php

namespace App\Http\Controllers;

use App\Models\Coa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

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
                ->whereHas('transactions', function ($q) use ($date, $due_date) {
                    $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
                })
                ->get()
                ->filter(function ($q) {
                    return $q->balance() != 0;
                });

            $beban_pendapatan = Coa::where('category_id', 13)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->whereHas('transactions', function ($q) use ($date, $due_date) {
                    $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
                })
                ->get()
                ->filter(function ($q) {
                    return $q->balance() != 0;
                });

            $beban_operasional = Coa::where('umkm_id', Auth::user()->umkm->id)
                ->where(function ($q) {
                    $q->where('category_id', 14)
                        ->orWhere('category_id', 16);
                })
                ->whereHas('transactions', function ($q) use ($date, $due_date) {
                    $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
                })
                ->get()
                ->filter(function ($q) {
                    return $q->balance() != 0;
                });

            $pendapatan_lain = Coa::where('umkm_id', Auth::user()->umkm->id)
                ->where('category_id', 15)
                ->whereHas('transactions', function ($q) use ($date, $due_date) {
                    $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
                })
                ->get()
                ->filter(function ($q) {
                    return $q->balance() != 0;
                });
            $beban_lain = Coa::where('umkm_id', Auth::user()->umkm->id)
                ->where('category_id', 16)
                ->whereHas('transactions', function ($q) use ($date, $due_date) {
                    $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
                })
                ->get()
                ->filter(function ($q) {
                    return $q->balance() != 0;
                });


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
            foreach ($beban_pendapatan as $b) {
                foreach ($b->coa_transactions as $t) {
                    $total = $t->debit - $t->credit;
                    if ($total < 0) {
                        $total = -$total;
                    }
                    $costs->push($total);
                    $costsDate->push($t->transaction->date);
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
                }
            }

            return view('user.report.labarugi', compact(
                'pendapatan',
                'beban_pendapatan',
                'beban_operasional',
                'pendapatan_lain',
                'beban_lain',
                'date',
                'due_date',
                'revenues',
                'costs',
                'revenuesDate',
                'costsDate',
            ));
        }

        return view('user.report.labarugi');
    }

    public function print_labarugi(Request $request)
    {
        $date = $request->date;
        $due_date = $request->due_date;

        $pendapatan = Coa::where('category_id', 12)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->whereHas('transactions', function ($q) use ($date, $due_date) {
                $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
            })
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            });

        $beban_pendapatan = Coa::where('category_id', 13)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->whereHas('transactions', function ($q) use ($date, $due_date) {
                $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
            })
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            });

        $beban_operasional = Coa::where('umkm_id', Auth::user()->umkm->id)
            ->where(function ($q) {
                $q->where('category_id', 14)
                    ->orWhere('category_id', 16);
            })
            ->whereHas('transactions', function ($q) use ($date, $due_date) {
                $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
            })
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            });

        $pendapatan_lain = Coa::where('umkm_id', Auth::user()->umkm->id)
            ->where('category_id', 15)
            ->whereHas('transactions', function ($q) use ($date, $due_date) {
                $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
            })
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            });
        $beban_lain = Coa::where('umkm_id', Auth::user()->umkm->id)
            ->where('category_id', 16)
            ->whereHas('transactions', function ($q) use ($date, $due_date) {
                $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
            })
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            });

        $pdf = PDF::loadview('user.report.labarugi_pdf', compact(
            'pendapatan',
            'beban_pendapatan',
            'beban_operasional',
            'pendapatan_lain',
            'beban_lain',
            'date',
            'due_date'
        ));

        return $pdf->download('Laporan Laba Rugi Reriode ' . $date . ' - ' . $due_date . '.pdf');
        // return $pdf->stream('Laporan Laba Rugi Reriode ' . $date . ' - ' . $due_date . '.pdf');
    }

    public function neraca(Request $request)
    {
        $date = $request->date;

        if (!empty($date)) {
            $aset_lancar = Coa::where('category_id', '<=', 4)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->get()
                ->filter(function ($q) {
                    return $q->balance() != 0;
                });

            $aset_tetap = Coa::where('category_id', 5)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->get()
                ->filter(function ($q) {
                    return $q->balance() != 0;
                });

            $liabilitas_pendek = Coa::where('category_id', '>=', 8)
                ->where('category_id', '<=', 9)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->get()
                ->filter(function ($q) {
                    return $q->balance() != 0;
                });

            $modal_saham = Coa::where('category_id', 11)
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

            return view('user.report.neraca', compact(
                'aset_lancar',
                'aset_tetap',
                'liabilitas_pendek',
                'modal_saham',
                'pendapatan_lain',
                'labarugi',
                'date'
            ));
        }

        return view('user.report.neraca');
    }

    public function print_neraca(Request $request)
    {
        $date = $request->date;

        $aset_lancar = Coa::where('category_id', '<=', 4)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            });

        $aset_tetap = Coa::where('category_id', 5)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            });

        $liabilitas_pendek = Coa::where('category_id', '>=', 8)
            ->where('category_id', '<=', 9)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            });

        $modal_saham = Coa::where('category_id', 11)
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

        $pdf = PDF::loadview('user.report.neraca_pdf', compact(
            'aset_lancar',
            'aset_tetap',
            'liabilitas_pendek',
            'modal_saham',
            'pendapatan_lain',
            'labarugi',
            'date'
        ));

        return $pdf->download('Laporan Neraca Tanggal ' . $date . '.pdf');
        // return $pdf->stream('Laporan Neraca Tanggal ' . $date . '.pdf');
    }

    public function healthanalysis(Request $request)
    {
        $date = $request->date;
        $due_date = $request->due_date;

        if (!empty($date)) {
            // aset lancar
            $aset_lancar = Coa::where('category_id', '<=', 4)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->whereHas('transactions', function ($q) use ($date, $due_date) {
                    $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
                })
                ->get()
                ->filter(function ($q) {
                    return $q->balance() != 0;
                })->map->balance()->sum();

            $liabilitas_pendek = Coa::where('category_id', '>=', 8)
                ->where('category_id', '<=', 9)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->whereHas('transactions', function ($q) use ($date, $due_date) {
                    $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
                })
                ->get()
                ->filter(function ($q) {
                    return $q->balance() != 0;
                })->map->balance()->sum();

            $total_aset = $aset_tetap = Coa::where('category_id', 5)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->whereHas('transactions', function ($q) use ($date, $due_date) {
                    $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
                })
                ->get()
                ->filter(function ($q) {
                    return $q->balance() != 0;
                })->map->balance()->sum() + $aset_lancar;

            $laba_operasional = Coa::where('category_id', 12)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->whereHas('transactions', function ($q) use ($date, $due_date) {
                    $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
                })
                ->get()
                ->filter(function ($q) {
                    return $q->balance() != 0;
                })->map->balance()->sum() -
                Coa::where('category_id', 13)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->whereHas('transactions', function ($q) use ($date, $due_date) {
                    $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
                })
                ->get()
                ->filter(function ($q) {
                    return $q->balance() != 0;
                })->map->balance()->sum() -
                Coa::where('umkm_id', Auth::user()->umkm->id)
                ->where(function ($q) {
                    $q->where('category_id', 14)
                        ->orWhere('category_id', 16);
                })
                ->whereHas('transactions', function ($q) use ($date, $due_date) {
                    $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
                })
                ->get()
                ->filter(function ($q) {
                    return $q->balance() != 0;
                })->map->balance()->sum();


            $pendapatan_lain = Coa::where('umkm_id', Auth::user()->umkm->id)
                ->where('category_id', 15)
                ->whereHas('transactions', function ($q) use ($date, $due_date) {
                    $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
                })
                ->get()
                ->filter(function ($q) {
                    return $q->balance() != 0;
                });
            $beban_lain = Coa::where('umkm_id', Auth::user()->umkm->id)
                ->where('category_id', 16)
                ->whereHas('transactions', function ($q) use ($date, $due_date) {
                    $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
                })
                ->get()
                ->filter(function ($q) {
                    return $q->balance() != 0;
                });
            $laba_bersih = $laba_operasional + $pendapatan_lain->map->balance()->sum() - $beban_lain->map->balance()->sum();
            $laba_ditahan = $laba_bersih - $beban_lain = Coa::where('umkm_id', Auth::user()->umkm->id)
                ->where('code', '3-30200')
                ->whereHas('transactions', function ($q) use ($date, $due_date) {
                    $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
                })
                ->get()->map->balance()->sum();

            $liabilitas = Coa::where('category_id', '>=', 8)
                ->where('category_id', '<=', 9)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->whereHas('transactions', function ($q) use ($date, $due_date) {
                    $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
                })
                ->get()
                ->filter(function ($q) {
                    return $q->balance() != 0;
                })->map->balance()->sum() +
                Coa::where('category_id', 10)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->whereHas('transactions', function ($q) use ($date, $due_date) {
                    $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
                })
                ->get()
                ->filter(function ($q) {
                    return $q->balance() != 0;
                })->map->balance()->sum();

            $modal_disetor = Coa::where('category_id', 11)
                ->where('umkm_id', Auth::user()->umkm->id)
                ->where('code', '3-30000')
                ->whereHas('transactions', function ($q) use ($date, $due_date) {
                    $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
                })
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

    public function print_healthanalysis(Request $request)
    {
        $date = $request->date;
        $due_date = $request->due_date;

        // aset lancar
        $aset_lancar = Coa::where('category_id', '<=', 4)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->whereHas('transactions', function ($q) use ($date, $due_date) {
                $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
            })
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            })->map->balance()->sum();

        $liabilitas_pendek = Coa::where('category_id', '>=', 8)
            ->where('category_id', '<=', 9)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->whereHas('transactions', function ($q) use ($date, $due_date) {
                $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
            })
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            })->map->balance()->sum();

        $total_aset = $aset_tetap = Coa::where('category_id', 5)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->whereHas('transactions', function ($q) use ($date, $due_date) {
                $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
            })
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            })->map->balance()->sum() + $aset_lancar;

        $laba_operasional = Coa::where('category_id', 12)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->whereHas('transactions', function ($q) use ($date, $due_date) {
                $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
            })
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            })->map->balance()->sum() -
            Coa::where('category_id', 13)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->whereHas('transactions', function ($q) use ($date, $due_date) {
                $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
            })
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            })->map->balance()->sum() -
            Coa::where('umkm_id', Auth::user()->umkm->id)
            ->where(function ($q) {
                $q->where('category_id', 14)
                    ->orWhere('category_id', 16);
            })
            ->whereHas('transactions', function ($q) use ($date, $due_date) {
                $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
            })
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            })->map->balance()->sum();


        $pendapatan_lain = Coa::where('umkm_id', Auth::user()->umkm->id)
            ->where('category_id', 15)
            ->whereHas('transactions', function ($q) use ($date, $due_date) {
                $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
            })
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            });
        $beban_lain = Coa::where('umkm_id', Auth::user()->umkm->id)
            ->where('category_id', 16)
            ->whereHas('transactions', function ($q) use ($date, $due_date) {
                $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
            })
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            });
        $laba_bersih = $laba_operasional + $pendapatan_lain->map->balance()->sum() - $beban_lain->map->balance()->sum();
        $laba_ditahan = $laba_bersih - $beban_lain = Coa::where('umkm_id', Auth::user()->umkm->id)
            ->where('code', '3-30200')
            ->whereHas('transactions', function ($q) use ($date, $due_date) {
                $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
            })
            ->get()->map->balance()->sum();

        $liabilitas = Coa::where('category_id', '>=', 8)
            ->where('category_id', '<=', 9)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->whereHas('transactions', function ($q) use ($date, $due_date) {
                $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
            })
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            })->map->balance()->sum() +
            Coa::where('category_id', 10)
            ->where('umkm_id', Auth::user()->umkm->id)
            ->whereHas('transactions', function ($q) use ($date, $due_date) {
                $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
            })
            ->get()
            ->filter(function ($q) {
                return $q->balance() != 0;
            })->map->balance()->sum();

        $modal_disetor = Coa::where('category_id', 11)
            ->where('code', '3-30000')
            ->whereHas('transactions', function ($q) use ($date, $due_date) {
                $q->whereBetween('date', [Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $due_date)->format('Y-m-d')]);
            })
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

        $pdf = PDF::loadview('user.report.healthanalysis_pdf', compact(
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

        return $pdf->download('Analisa Kesehatan Perusahaan ' . Auth::user()->umkm->name . ' Periode ' . $date . ' - ' . $due_date . '.pdf');
        // return $pdf->stream('Analisa Kesehatan Perusahaan ' . Auth::user()->umkm->name . ' Tanggal ' . $date . '.pdf');
    }
}
