<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Analisis Kesehatan UMKM (Altman Z-Score)') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-4">
                <h3 class="font-bold text-lg">Tentukan Periode Laporan</h3>
                <div class="mt-4 flex justify-between items-center">
                    <form action="{{ route('umkm.report.healthanalysis') }}" method="get">
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
                        <form action="{{ route('umkm.report.print_healthanalysis') }}" method="get">
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

            @isset($aset_lancar)
                <div class="mt-5 grid grid-cols-2 gap-4">
                    <div class="bg-white shadow-md sm:rounded-lg p-4">
                        <p class="text-lg font-bold">
                            Nilai Z-Score:
                            {{ AppHelper::decimal($zscore) }}
                        </p>
                        <div class="mt-2">
                            <p>
                                kondisi kesehatan UMKM berdasarkan periode,
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
                    <div class="bg-white shadow-md sm:rounded-lg p-4">
                        <h1 class="text-lg font-bold">Penjelasan terkait Z-Score</h1>
                        <p>
                            Z-Score Altman merupakan metode yang dikembangkan oleh Edward I.Altman sebagai metode prediksi
                            <span class="italic">financial distress</span> dengan menentukan rasio finansial
                            menggunakan sebuah skor Z-Score untuk menentukan tingkat posibilitas dari suatu perusahaan
                            mengalami kebangkrutan.
                        </p>
                        <p class="my-4 text-center text-lg border p-3 border-citrablack">
                            Z = 6.56 X1 + 3.26X2 + 6.72 X3 + 1.05 X4
                        </p>
                        <p class="my-4">
                            Metode Z-Score memiliki berbagai kategori diantaranya sebagai berikut.
                        </p>
                        <ul class="flex flex-col gap-3 list-disc ml-5">
                            <li>
                                <h2 class="font-bold text-citrared-500"> Bangkrut: Nilai Z-Score < 1.8 </h2>
                                        <p>
                                            Perusahaan yang diprediksi mengalami kesulitan keuangan dan akan mengalami
                                            kebangkrutan.
                                        </p>
                            </li>
                            <li>
                                <h2 class="font-bold text-citrayellow-500">
                                    Abu-abu: Nilai Z-Score 1.8 - 2.6
                                </h2>
                                <p>
                                    Perusahaan yang diprediksi sedang berada dalam zona abu-abu dan berpotensi mengalami
                                    kebangkrutan.
                                </p>
                            </li>
                            <li>
                                <h2 class="font-bold text-citragreen-500">
                                    Sehat: Nilai Z-Score > 2.6
                                </h2>
                                <p>
                                    Perusahaan dikategorikan sehat dan berisiko rendah untuk mengalami kesulitan keuangan
                                    atau kebangkrutan.
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="mt-5 bg-white overflow-hidden shadow-md sm:rounded-lg p-4">
                    <h2 class="text-lg font-bold">
                        Rincian Perhitungan Perhitungan Analisis Rasio Keuangan
                    </h2>
                    <div class="mt-4 flex justify-between">
                        <h4 class="font-bold">Tanggal</h4>
                        <h4 class="font-bold">{{ $date }}-{{ $due_date }}</h4>
                    </div>
                    <div class="mt-4">
                        <h4 class="font-bold">
                            6.56 X1
                        </h4>
                        <div class="mt-2 flex justify-between">
                            <p class="ml-4">
                                Aset lancar
                            </p>
                            <p>
                                {{ AppHelper::rp($aset_lancar ?? 0) }}
                            </p>
                        </div>
                        <div class="mt-2 flex justify-between">
                            <p class="ml-4">
                                Liabilitas jangka pendek
                            </p>
                            <p>
                                {{ AppHelper::rp($liabilitas_pendek ?? 0) }}
                            </p>
                        </div>
                        <div class="mt-2 flex justify-between">
                            <p class="ml-4">
                                Modal Kerja
                            </p>
                            <p>
                                {{ AppHelper::rp($aset_lancar - $liabilitas_pendek ?? 0) }}
                            </p>
                        </div>
                        <div class="mt-2 flex justify-between">
                            <p class="ml-4">
                                Total Aset
                            </p>
                            <p>
                                {{ AppHelper::rp($total_aset ?? 0) }}
                            </p>
                        </div>
                        <div class="mt-2 flex justify-between">
                            <p class="ml-4">
                                X1 (Modal Kerja/Total Aset)
                            </p>
                            <p>
                                {{ AppHelper::decimal($total_aset != 0 ? ($aset_lancar - $liabilitas) / $total_aset : 0) }}
                            </p>
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="ml-4 flex justify-between">
                        <p class="font-bold">
                            6.56 X1
                        </p>
                        <p class="font-bold">
                            {{ AppHelper::decimal($total_aset != 0 ? (($aset_lancar - $liabilitas) / $total_aset) * 6.56 : 0) }}
                        </p>
                    </div>

                    <hr class="my-3">

                    <div class="">
                        <h4 class="font-bold">
                            3.26 X2
                        </h4>
                        <div class="mt-2 flex justify-between">
                            <p class="ml-4">
                                Laba Ditahan
                            </p>
                            <p>
                                {{ AppHelper::rp($laba_ditahan ?? 0) }}
                            </p>
                        </div>
                        <div class="mt-2 flex justify-between">
                            <p class="ml-4">
                                Total Aset
                            </p>
                            <p>
                                {{ AppHelper::rp($total_aset ?? 0) }}
                            </p>
                        </div>
                        <div class="mt-2 flex justify-between">
                            <p class="ml-4">
                                X2 (Laba Operasional/Total Aset)
                            </p>
                            <p>
                                {{ AppHelper::decimal($total_aset != 0 ? $laba_ditahan / $total_aset : 0) }}
                            </p>
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="ml-4 flex justify-between">
                        <p class="font-bold">
                            3.26 X2
                        </p>
                        <p class="font-bold">
                            {{ AppHelper::decimal($total_aset != 0 ? 3.26 * ($laba_operasional / $total_aset) : 0) }}
                        </p>
                    </div>

                    <hr class="my-3">

                    <div class="">
                        <h4 class="font-bold">
                            6.72 X3
                        </h4>
                        <div class="mt-2 flex justify-between">
                            <p class="ml-4">
                                Laba Operasional
                            </p>
                            <p>
                                {{ AppHelper::rp($laba_operasional ?? 0) }}
                            </p>
                        </div>
                        <div class="mt-2 flex justify-between">
                            <p class="ml-4">
                                Total Aset
                            </p>
                            <p>
                                {{ AppHelper::rp($total_aset ?? 0) }}
                            </p>
                        </div>
                        <div class="mt-2 flex justify-between">
                            <p class="ml-4">
                                X3 (Laba Operasional/Total Aset)
                            </p>
                            <p>
                                {{ AppHelper::decimal($total_aset != 0 ? $laba_operasional / $total_aset : 0) }}
                            </p>
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="ml-4 flex justify-between">
                        <p class="font-bold">
                            6.72 X3
                        </p>
                        <p class="font-bold">
                            {{ AppHelper::decimal($total_aset != 0 ? 6.72 * ($laba_operasional / $total_aset) : 0) }}
                        </p>
                    </div>

                    <hr class="my-3">

                    <div class="">
                        <h4 class="font-bold">
                            1.05 X4
                        </h4>
                        <div class="mt-2 flex justify-between">
                            <p class="ml-4">
                                Modal Disetor
                            </p>
                            <p>
                                {{ AppHelper::rp($modal_disetor ?? 0) }}
                            </p>
                        </div>
                        <div class="mt-2 flex justify-between">
                            <p class="ml-4">
                                Total Liabilitas
                            </p>
                            <p>
                                {{ AppHelper::rp($liabilitas ?? 0) }}
                            </p>
                        </div>
                        <div class="mt-2 flex justify-between">
                            <p class="ml-4">
                                X4 (Modal Disetor/Total Liabilitas)
                            </p>
                            <p>
                                {{ AppHelper::decimal($liabilitas != 0 ? $modal_disetor / $liabilitas : 0) }}
                            </p>
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="ml-4 flex justify-between">
                        <p class="font-bold">
                            1.05 X4
                        </p>
                        <p class="font-bold">
                            {{ AppHelper::decimal($liabilitas != 0 ? 1.05 * ($modal_disetor / $liabilitas) : 0) }}
                        </p>
                    </div>

                    <hr class="my-3">

                    <div class="">
                        <h4 class="font-bold">
                            Z-Score
                        </h4>
                        <div class="mt-2 flex justify-between">
                            <p class="ml-4 italic">
                                6.56 X1
                            </p>
                            <p>
                                {{ AppHelper::decimal($x1) }}
                            </p>
                        </div>
                        <div class="mt-2 flex justify-between">
                            <p class="ml-4 italic">
                                3.26 X2
                            </p>
                            <p>
                                {{ AppHelper::decimal($x2) }}
                            </p>
                        </div>
                        <div class="mt-2 flex justify-between">
                            <p class="ml-4 italic">
                                6.72 X3
                            </p>
                            <p>
                                {{ AppHelper::decimal($x3) }}
                            </p>
                        </div>
                        <div class="mt-2 flex justify-between">
                            <p class="ml-4 italic">
                                1.05 X4
                            </p>
                            <p>
                                {{ AppHelper::decimal($x4) }}
                            </p>
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="ml-4 flex justify-between">
                        <p class="font-bold">
                            Z-Score
                        </p>
                        <p class="font-bold">
                            {{ AppHelper::decimal($zscore) }}
                        </p>
                    </div>
                </div>
            @endisset
        </div>
    </div>

</x-app-layout>
