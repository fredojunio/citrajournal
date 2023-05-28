<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Laba Rugi') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-4">
                <h3 class="font-bold text-lg">Tentukan Periode Laporan</h3>
                <div class="mt-4 flex justify-between items-center">
                    <form action="{{ route('umkm.report.labarugi') }}" method="get">
                        <div class="flex gap-5 items-center">
                            <div>
                                <x-input-label for="date" :value="__('Tanggal Awal')" />
                                <div class="flex items-center gap-1">
                                    <x-text-input datepicker datepicker-autohide id="date" class="block mt-1"
                                        type="text" name="date" datepicker-format="dd/mm/yyyy" :value="empty($date)
                                            ? \Carbon\Carbon::now()
                                                ->startOfMonth()
                                                ->format('d-m-Y')
                                            : $date"
                                        required autocomplete="date" />
                                    <label for="date" class="cursor-pointer">
                                        <i class=" bx bxs-calendar text-citradark-500 text-xl"></i>
                                    </label>
                                </div>
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="due_date" :value="__('Tanggal Akhir')" />
                                <div class="flex items-center gap-1">
                                    <x-text-input datepicker datepicker-autohide id="due_date" class="block mt-1"
                                        type="text" name="due_date" datepicker-format="dd/mm/yyyy" :value="empty($due_date)
                                            ? \Carbon\Carbon::now()->format('d-m-Y')
                                            : $due_date"
                                        required autocomplete="due_date" />
                                    <label for="due_date" class="cursor-pointer">
                                        <i class=" bx bxs-calendar text-citradark-500 text-xl"></i>
                                    </label>
                                </div>
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>
                            <x-primary-button class="ml-2">
                                Filter
                            </x-primary-button>
                        </div>
                    </form>
                    @isset($date)
                        <form action="{{ route('umkm.report.print_labarugi') }}" method="get">
                            <input type="hidden" name="date" value="{{ $date }}" id="">
                            <input type="hidden" name="due_date" value="{{ $due_date }}" id="">
                            <x-primary-button class="ml-2">
                                <span class="mr-2">
                                    <i class="bx bx-printer text-xl text-white"></i>
                                </span>
                                Cetak
                            </x-primary-button>
                        </form>
                    @endisset
                </div>
            </div>
            @isset($pendapatan)
                <div class="mt-5 bg-white overflow-hidden shadow-md sm:rounded-lg p-4">
                    <div class="flex justify-between">
                        <h4 class="font-bold">Tanggal Periode</h4>
                        <h4 class="font-bold">{{ $date }}-{{ $due_date }}</h4>
                    </div>
                    <div class="mt-4">
                        <h4 class="font-bold">
                            Pendapatan
                        </h4>
                        @foreach ($pendapatan as $p)
                            <div class="mt-2 flex justify-between">
                                <div class="ml-4 flex gap-3">
                                    <p>
                                        {{ $p->code }}
                                    </p>
                                    <p>
                                        {{ $p->name }}
                                    </p>
                                </div>
                                <p>
                                    {{ AppHelper::rp($p->balance()) }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                    <hr class="my-3">
                    <div class="ml-4 flex justify-between">
                        <p>
                            Total Pendapatan
                        </p>
                        <p class="font-bold">
                            {{ AppHelper::rp($pendapatan->map->balance()->sum() ?? 0) }}
                        </p>
                    </div>
                    <div class="mt-4">
                        <h4 class="font-bold">
                            Beban Pendapatan
                        </h4>
                        @foreach ($beban_pendapatan as $bp)
                            <div class="mt-2 flex justify-between">
                                <div class="ml-4 flex gap-3">
                                    <p>
                                        {{ $bp->code }}
                                    </p>
                                    <p>
                                        {{ $bp->name }}
                                    </p>
                                </div>
                                <p>
                                    {{ AppHelper::rp($bp->balance() ?? 0) }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                    <hr class="my-3">
                    <div class="ml-4 flex justify-between">
                        <p>
                            Total Beban Pendapatan
                        </p>
                        <p class="font-bold">
                            {{ AppHelper::rp($beban_pendapatan->map->balance()->sum() ?? 0) }}
                        </p>
                    </div>
                    <hr class="my-3">
                    <div class="flex justify-between">
                        <p class="font-bold">
                            Laba Kotor
                        </p>
                        <p class="font-bold">
                            {{ AppHelper::rp($pendapatan->map->balance()->sum() - $beban_pendapatan->map->balance()->sum() ?? 0) }}
                        </p>
                    </div>
                    <div class="mt-4">
                        <h4 class="font-bold">
                            Biaya Usaha
                        </h4>
                        @foreach ($beban_operasional as $bp)
                            <div class="mt-2 flex justify-between">
                                <div class="ml-4 flex gap-3">
                                    <p>
                                        {{ $bp->code }}
                                    </p>
                                    <p>
                                        {{ $bp->name }}
                                    </p>
                                </div>
                                <p>
                                    {{ AppHelper::rp($bp->balance() ?? 0) }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                    <hr class="my-3">
                    <div class="ml-4 flex justify-between">
                        <p>
                            Total Biaya Usaha
                        </p>
                        <p class="font-bold">
                            {{ AppHelper::rp($beban_operasional->map->balance()->sum() ?? 0) }}
                        </p>
                    </div>
                    <hr class="my-3">
                    <div class="flex justify-between">
                        <p class="font-bold">
                            Laba Operasional
                        </p>
                        <p class="font-bold">
                            {{ AppHelper::rp($pendapatan->map->balance()->sum() - $beban_pendapatan->map->balance()->sum() - $beban_operasional->map->balance()->sum() ?? 0) }}
                        </p>
                    </div>
                    <div class="mt-4">
                        <h4 class="font-bold">
                            Pendapatan dan Biaya Diluar Usaha
                        </h4>
                        <div class="mt-2 flex justify-between">
                            <p class="ml-4">
                                Pendapatan Diluar Usaha
                            </p>
                            <p>
                                {{ AppHelper::rp($pendapatan_lain->map->balance()->sum() ?? 0) }}
                            </p>
                        </div>
                        <div class="mt-2 flex justify-between">
                            <p class="ml-4">
                                Biaya Diluar Usaha
                            </p>
                            <p>
                                {{ AppHelper::rp($beban_lain->map->balance()->sum() ?? 0) }}
                            </p>
                        </div>
                    </div>
                    <hr class="my-3">
                    <div class="ml-4 flex justify-between">
                        <p>
                            Total Pendapatan (Biaya Diluar Usaha)
                        </p>
                        <p class="font-bold">
                            {{ AppHelper::rp($pendapatan_lain->map->balance()->sum() - $beban_lain->map->balance()->sum() ?? 0) }}
                        </p>
                    </div>
                    <hr class="my-3">
                    <div class="flex justify-between">
                        <p class="font-bold">
                            Laba (Rugi)
                        </p>
                        <p class="font-bold">
                            {{ AppHelper::rp(
                                $pendapatan->map->balance()->sum() -
                                    $beban_pendapatan->map->balance()->sum() -
                                    $beban_operasional->map->balance()->sum() +
                                    ($pendapatan_lain->map->balance()->sum() - $beban_lain->map->balance()->sum()) ??
                                    0,
                            ) }}
                        </p>
                    </div>
                </div>
                <div class="mt-5 bg-white shadow-md sm:rounded-lg p-4" id="labarugi">

                </div>
            @endisset
        </div>
    </div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        var revenueData = <?php echo json_encode($revenuesDate ?? ''); ?>;
        var costData = <?php echo json_encode($costsDate ?? ''); ?>;
        var revenueValue = <?php echo json_encode($revenues ?? ''); ?>;
        var costValue = <?php echo json_encode($costs ?? ''); ?>;

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
                text: 'Grafik Laporan Laba Rugi'
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
