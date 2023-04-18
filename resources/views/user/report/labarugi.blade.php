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
                                <x-input-label for="date" :value="__('Tanggal')" />
                                <div class="flex items-center gap-1">
                                    <x-text-input datepicker datepicker-autohide id="date" class="block mt-1"
                                        type="text" name="date" datepicker-format="dd/mm/yyyy" :value="\Carbon\Carbon::now()->format('d-m-Y')"
                                        required autofocus autocomplete="date" />
                                    <label for="date" class="cursor-pointer">
                                        <i class=" bx bxs-calendar text-citradark-500 text-xl"></i>
                                    </label>
                                </div>
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="due_date" :value="__('Tanggal Jatuh Tempo')" />
                                <div class="flex items-center gap-1">
                                    <x-text-input datepicker datepicker-autohide id="due_date" class="block mt-1"
                                        type="text" name="due_date" datepicker-format="dd/mm/yyyy" :value="\Carbon\Carbon::now()->format('d-m-Y')"
                                        required autofocus autocomplete="due_date" />
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
                    <x-primary-button class="ml-2">
                        <span class="mr-2">
                            <i class="bx bx-printer text-xl text-white"></i>
                        </span>
                        Cetak
                    </x-primary-button>
                </div>
            </div>
            @isset($pendapatan)
                <div class="mt-5 bg-white overflow-hidden shadow-md sm:rounded-lg p-4">
                    <div class="flex justify-between">
                        <h4 class="font-bold">Tanggal</h4>
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
                                    {{ AppHelper::rp($p->balance ?? 0) }}
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
                            {{ AppHelper::rp($pendapatan->sum('balance') ?? 0) }}
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
                                    {{ AppHelper::rp($bp->balance ?? 0) }}
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
                            {{ AppHelper::rp($beban_pendapatan->sum('balance') ?? 0) }}
                        </p>
                    </div>
                    <hr class="my-3">
                    <div class="flex justify-between">
                        <p class="font-bold">
                            Laba Kotor
                        </p>
                        <p class="font-bold">
                            {{ AppHelper::rp($pendapatan->sum('balance') - $beban_pendapatan->sum('balance') ?? 0) }}
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
                                    {{ AppHelper::rp($bp->balance ?? 0) }}
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
                            {{ AppHelper::rp($beban_operasional->sum('balance') ?? 0) }}
                        </p>
                    </div>
                    <hr class="my-3">
                    <div class="flex justify-between">
                        <p class="font-bold">
                            Laba Operasional
                        </p>
                        <p class="font-bold">
                            {{ AppHelper::rp($pendapatan->sum('balance') - $beban_pendapatan->sum('balance') - $beban_operasional->sum('balance') ?? 0) }}
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
                                {{ AppHelper::rp($pendapatan_lain->sum('balance') ?? 0) }}
                            </p>
                        </div>
                        <div class="mt-2 flex justify-between">
                            <p class="ml-4">
                                Biaya Diluar Usaha
                            </p>
                            <p>
                                {{ AppHelper::rp($beban_lain->sum('balance') ?? 0) }}
                            </p>
                        </div>
                    </div>
                    <hr class="my-3">
                    <div class="ml-4 flex justify-between">
                        <p>
                            Total Pendapatan (Biaya Diluar Usaha)
                        </p>
                        <p class="font-bold">
                            {{ AppHelper::rp($pendapatan_lain->sum('balance') - $beban_lain->sum('balance') ?? 0) }}
                        </p>
                    </div>
                    <hr class="my-3">
                    <div class="flex justify-between">
                        <p class="font-bold">
                            Laba (Rugi)
                        </p>
                        <p class="font-bold">
                            {{ AppHelper::rp(
                                $pendapatan->sum('balance') -
                                    $beban_pendapatan->sum('balance') -
                                    $beban_operasional->sum('balance') +
                                    ($pendapatan_lain->sum('balance') - $beban_lain->sum('balance')) ??
                                    0,
                            ) }}
                        </p>
                    </div>
                </div>
            @endisset
        </div>
    </div>

</x-app-layout>
