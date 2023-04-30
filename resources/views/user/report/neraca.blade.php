<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Neraca') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-4">
                <h3 class="font-bold text-lg">Tentukan Periode Laporan</h3>
                <div class="mt-4 flex justify-between items-center">
                    <form action="{{ route('umkm.report.neraca') }}" method="get">
                        <div class="flex gap-5 items-center">
                            <div>
                                <x-input-label for="date" :value="__('Tanggal')" />
                                <div class="flex items-center gap-1">
                                    <x-text-input datepicker datepicker-autohide id="date" class="block mt-1"
                                        type="text" name="date" datepicker-format="dd/mm/yyyy" :value="empty($date) ? \Carbon\Carbon::now()->format('d-m-Y') : $date"
                                        required autofocus autocomplete="date" />
                                    <label for="date" class="cursor-pointer">
                                        <i class=" bx bxs-calendar text-citradark-500 text-xl"></i>
                                    </label>
                                </div>
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>
                            {{-- <div>
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
                            </div> --}}
                            <x-primary-button class="ml-2">
                                Filter
                            </x-primary-button>
                        </div>
                    </form>
                    @isset($date)
                        <form action="{{ route('umkm.report.print_neraca') }}" method="get">
                            <input type="hidden" name="date" value="{{ $date }}" id="">
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

            @isset($aset_lancar)

                <div class="mt-5 bg-white overflow-hidden shadow-md sm:rounded-lg p-4">
                    <div class="flex justify-between">
                        <h4 class="font-bold">Tanggal</h4>
                        <h4 class="font-bold">{{ $date }}</h4>
                    </div>
                    <div class="mt-4">
                        <h4 class="font-bold">
                            Aset
                        </h4>
                        <div class="mt-2 ml-4">
                            <h4 class="font-bold">
                                Aset Lancar
                            </h4>
                            @foreach ($aset_lancar as $al)
                                <div class="mt-2 flex justify-between">
                                    <div class="ml-4 flex gap-3">
                                        <p>
                                            {{ $al->code }}
                                        </p>
                                        <p>
                                            {{ $al->name }}
                                        </p>
                                    </div>
                                    <p>
                                        {{ AppHelper::rp($al->balance() ?? 0) }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="ml-4 flex justify-between">
                        <p class="font-bold">
                            Total Aset Lancar
                        </p>
                        <p class="font-bold">
                            {{ AppHelper::rp($aset_lancar->map->balance()->sum() ?? 0) }}
                        </p>
                    </div>
                    <div class="mt-4 ml-4">
                        <h4 class="font-bold">
                            Aset Tetap
                        </h4>
                        @foreach ($aset_tetap as $at)
                            <div class="mt-2 flex justify-between">
                                <div class="ml-4 flex gap-3">
                                    <p>
                                        {{ $at->code }}
                                    </p>
                                    <p>
                                        {{ $at->name }}
                                    </p>
                                </div>
                                <p>
                                    {{ AppHelper::rp($at->balance() ?? 0) }}
                                </p>
                            </div>
                        @endforeach
                    </div>

                    <hr class="my-3">

                    <div class="ml-4 flex justify-between">
                        <p class="font-bold">
                            Total Aset Tetap
                        </p>
                        <p class="font-bold">
                            {{ AppHelper::rp($aset_tetap->map->balance()->sum() ?? 0) }}
                        </p>
                    </div>

                    <hr class="my-3">

                    <div class="flex justify-between">
                        <p class="font-bold">
                            Total Aset
                        </p>
                        <p class="font-bold">
                            {{ AppHelper::rp($aset_lancar->map->balance()->sum() + $aset_tetap->map->balance()->sum() ?? 0) }}
                        </p>
                    </div>

                    <div class="mt-4">
                        <h4 class="font-bold">
                            Liabilitas dan Modal
                        </h4>
                        <div class="mt-2 ml-4">
                            <h4 class="font-bold">
                                Liabilitas Jangka Pendek
                            </h4>
                            @foreach ($liabilitas_pendek as $lp)
                                <div class="mt-2 flex justify-between">
                                    <div class="ml-4 flex gap-3">
                                        <p>
                                            {{ $lp->code }}
                                        </p>
                                        <p>
                                            {{ $lp->name }}
                                        </p>
                                    </div>
                                    <p>
                                        {{ AppHelper::rp($lp->balance() ?? 0) }}
                                    </p>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="ml-4 flex justify-between">
                        <p class="font-bold">
                            Liabilitas Jangka Pendek
                        </p>
                        <p class="font-bold">
                            {{ AppHelper::rp($liabilitas_pendek->map->balance()->sum() ?? 0) }}
                        </p>
                    </div>

                    <hr class="my-3">

                    <div class="ml-4 flex justify-between">
                        <p class="font-bold">
                            Total Liabilitas
                        </p>
                        <p class="font-bold">
                            {{ AppHelper::rp($liabilitas_pendek->map->balance()->sum() ?? 0) }}
                        </p>
                    </div>

                    <div class="mt-10">
                        <div class="mt-2 ml-4">
                            <h4 class="font-bold">
                                Modal Pemilik
                            </h4>
                            @foreach ($modal_saham as $ms)
                                <div class="mt-2 flex justify-between">
                                    <div class="ml-4 flex gap-3">
                                        <p>
                                            {{ $ms->code }}
                                        </p>
                                        <p>
                                            {{ $ms->name }}
                                        </p>
                                    </div>
                                    <p>
                                        {{ AppHelper::rp($ms->balance() ?? 0) }}
                                    </p>
                                </div>
                            @endforeach
                            <div class="mt-2 flex justify-between">
                                <div class="ml-4 flex gap-3">
                                    <p class="text-white select-none">
                                        3-30000
                                    </p>
                                    <div class="flex flex-col gap-2">
                                        <p>
                                            Pendapatan lain
                                        </p>
                                        <p>
                                            Pendapatan tahun lalu
                                        </p>
                                        <p>
                                            Pendapatan periode ini
                                        </p>
                                    </div>

                                </div>
                                <div class="flex flex-col gap-2 text-right">
                                    <p>
                                        Rp. 0,-
                                    </p>
                                    <p>
                                        Rp. 0,-
                                    </p>
                                    <p>
                                        {{ AppHelper::rp($labarugi ?? 0) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="ml-4 flex justify-between">
                        <p class="font-bold">
                            Total Modal Pemilik
                        </p>
                        <p class="font-bold">
                            {{ AppHelper::rp($modal_saham->map->balance()->sum() + $labarugi ?? 0) }}
                        </p>
                    </div>

                    <hr class="my-3">

                    <div class="flex justify-between">
                        <p class="font-bold">
                            Total Liabilitas dan Modal
                        </p>
                        <p class="font-bold">
                            {{ AppHelper::rp($liabilitas_pendek->map->balance()->sum() + $modal_saham->map->balance()->sum() + $labarugi ?? 0) }}
                        </p>
                    </div>
                </div>
            @endisset
        </div>
    </div>

</x-app-layout>
