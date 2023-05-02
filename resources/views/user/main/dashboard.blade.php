<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dasbor') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl transition-all duration-200 mx-auto px-4">
            @if ($zscore == 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-10">
                        <div class="flex flex-col items-center">
                            <img src="{{ asset('images/assets/empty_state.svg') }}" class="w-44" alt="">
                            <div class="mt-3">
                                <h3 class="text-center font-bold text-lg">Anda belum memiliki catatan keuangan apapun
                                </h3>
                                <p class="text-center mt-2">Mulai mengatur konfigurasi invoice pertama anda.</p>
                            </div>
                            <a href="{{ route('umkm.kas.create') }}"
                                class="mt-3 inline-flex items-center px-4 py-2 bg-citradark-500 border border-transparent rounded-md font-bold text-xs text-white hover:bg-citradark-700 focus:bg-citradark-400 active:bg-citradark-600 focus:outline-none focus:ring-2 focus:ring-citradark-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Tambah Transaksi
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-4">
                    <div class="flex justify-between items-center">
                        <h3 class="font-bold text-lg">{{ Auth::user()->umkm->name }}</h3>
                        <div class="text-right">
                            <p>
                                kondisi kesehatan UMKM saat ini,
                            </p>
                            @if ($zscore > 2.6)
                                <h1 class="text-2xl font-semibold text-citragreen-500">
                                    Sehat
                                </h1>
                            @elseif ($zscore < 1.8)
                                <h1 class="text-2xl font-semibold text-citrared-500">
                                    Bangkrut
                                </h1>
                            @else
                                <h1 class="text-2xl font-semibold text-citrayellow-500">
                                    Berpotensi Bangkrut
                                </h1>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mt-5 grid grid-cols-2 gap-4">
                    <div class="bg-white shadow-md sm:rounded-lg p-4" id="kas">

                    </div>
                    <div class="bg-white shadow-md sm:rounded-lg p-4" id="labarugi">

                    </div>
                </div>

                <div class="mt-5 grid grid-cols-2 gap-4">
                    <div class="flex gap-4">
                        <div class="flex grow flex-col gap-4">
                            <div class="w-full bg-white shadow-sm sm:rounded-md p-4">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="bg-citradark-100 rounded-full w-14 h-14 flex justify-items-center items-center">
                                        <i class="text-citradark-500 bx bxs-purchase-tag text-3xl m-auto"></i>
                                    </div>
                                    <div>
                                        <p class="">Total Penjualan</p>
                                        <h2 class="text-2xl font-bold">
                                            {{ AppHelper::rp($pendapatan->map->balance()->sum() ?? 0) }}
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full bg-white shadow-sm sm:rounded-md p-4">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="bg-{{ $labarugi >= 0 ? 'citragreen' : 'citrared' }}-100 rounded-full w-14 h-14 flex justify-items-center items-center">
                                        <i
                                            class="text-{{ $labarugi >= 0 ? 'citragreen' : 'citrared' }}-500 bx bxs-bar-chart-alt-2 text-3xl m-auto"></i>
                                    </div>
                                    <div>
                                        <p class="">Total {{ $labarugi >= 0 ? 'Keuntungan' : 'Kerugian' }}</p>
                                        <h2 class="text-2xl font-bold">
                                            {{ AppHelper::rp($labarugi ?? 0) }}
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-4">
                            <div class="bg-white shadow-sm sm:rounded-md p-4">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="bg-citrablue-100 rounded-full w-14 h-14 flex justify-items-center items-center">
                                        <i class="text-citrablue-500 bx bxs-wallet text-3xl m-auto"></i>
                                    </div>
                                    <div>
                                        <p class="">Total Transaksi</p>
                                        <h2 class="text-2xl font-bold">
                                            {{ $transactions }}
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white shadow-sm sm:rounded-md p-4">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="bg-citrayellow-100 rounded-full w-14 h-14 flex justify-items-center items-center">
                                        <i class="text-citrayellow-500 bx bxs-box text-3xl m-auto"></i>
                                    </div>
                                    <div>
                                        <p class="">Produk Terjual</p>
                                        <h2 class="text-2xl font-bold">
                                            {{ $sales->map->details->flatten()->sum('quantity') }}
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow-md sm:rounded-lg p-4">
                        <div class="mt-2">
                            <h2 class="text-lg font-bold">
                                Rekomendasi
                            </h2>
                            <p>
                                Rekomendasi terkait kesehatan rasio keuangan UMKM milik anda.
                            </p>
                            <div class="mt-3 flex flex-col gap-3">
                                @foreach ($advices as $advice)
                                    <div class="p-3 bg-citragreen-100">
                                        <p>{{ $advice }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
    {{-- <script src="https://code.highcharts.com/modules/accessibility.js"></script> --}}
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript">
        var kasData = <?php echo json_encode($kas->transactions); ?>;
        var kasValue = <?php echo json_encode($kas->coa_transactions->map->currentBalance()); ?>;
        var printedKasData = kasData.map(function(kas, index) {
            return [Date.parse(kas.date), kasValue[index]];
        }).slice(-30);
        Highcharts.chart('kas', {
            title: {
                text: 'Saldo Kas, 30 Hari Terakhir'
            },
            subtitle: {
                text: 'Source: citrajournal'
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: {
                    day: '%e %b'
                }
            },
            yAxis: {
                title: {
                    text: 'Kas'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            colors: ['#2A69FC'],
            series: [{
                name: 'Saldo Kas',
                data: printedKasData
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });


        var revenueData = <?php echo json_encode($revenuesDate); ?>;
        var costData = <?php echo json_encode($costsDate); ?>;
        var revenueValue = <?php echo json_encode($revenues); ?>;
        var costValue = <?php echo json_encode($costs); ?>;

        var printedRevenueData = revenueData.map(function(rev, index) {
            return [Date.parse(rev), revenueValue[index]];
        }).slice(-30);

        var printedCostData = costData.map(function(cost, index) {
            return [Date.parse(cost), costValue[index]];
        }).slice(-30);

        Highcharts.chart('labarugi', {
            chart: {
                type: 'column' // set the chart type to "bar"
            },
            title: {
                text: 'Laporan Laba Rugi'
            },
            subtitle: {
                text: 'Source: citrajournal'
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: {
                    day: '%e %b'
                },
                tickInterval: 7 * 24 * 60 * 60 * 1000, // interval 7 hari
                labels: {
                    formatter: function() {
                        var start = Highcharts.dateFormat('%e %b', this.value);
                        var end = Highcharts.dateFormat('%e %b', this.value + (6 * 24 * 60 * 60 *
                            1000)); // 6 hari berikutnya
                        return start + ' - ' + end;
                    }
                }
            },
            yAxis: {
                title: {
                    text: 'Total'
                },
                labels: {
                    formatter: function() {
                        return this.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            colors: ['#2A69FC', '#E02A52'],
            series: [{
                name: 'Pemasukan',
                data: printedRevenueData,
                dataLabels: {
                    enabled: true,
                }
            }, {
                name: 'Biaya',
                data: printedCostData,
                center: ['85%', '25%'],
                size: 80,
                dataLabels: {
                    enabled: true,
                }
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
    </script>

</x-app-layout>
