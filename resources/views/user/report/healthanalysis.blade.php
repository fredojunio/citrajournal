<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Analisis Keseharan UMKM') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-4">
                <h3 class="font-bold text-lg">Tentukan Periode Laporan</h3>
                <div class="mt-4 flex justify-between items-center">
                    <div class="flex gap-5 items-center">
                        <div>
                            <x-input-label for="date" :value="__('Tanggal')" />
                            <div class="flex items-center gap-1">
                                <x-text-input datepicker datepicker-autohide id="date" class="block mt-1"
                                    type="text" name="date" :value="old('date')" required autofocus
                                    autocomplete="date" />
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
                                    type="text" name="due_date" :value="old('due_date')" required autofocus
                                    autocomplete="due_date" />
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
                    <x-primary-button class="ml-2">
                        <span class="mr-2">
                            <i class="bx bx-printer text-xl text-white"></i>
                        </span>
                        Cetak
                    </x-primary-button>
                </div>
            </div>

            <div class="mt-5 grid grid-cols-2 gap-4">
                <div class="bg-white shadow-md sm:rounded-lg p-4">

                </div>
                <div class="bg-white shadow-md sm:rounded-lg p-4">
                    <p>
                        Nilai Z-Score: 2.71
                    </p>
                    <div class="mt-2">
                        <p>
                            kondisi kesehatan UMKM berdasarkan periode,
                        </p>
                        <h1 class="text-xl font-bold text-citragreen-500">
                            Stabil
                        </h1>
                    </div>
                    <div class="mt-2">
                        <h2 class="text-lg font-bold">
                            Rekomendasi
                        </h2>
                        <p>
                            Rekomendasi terkait kesehatan rasio keuangan UMKM milik anda.
                        </p>
                        <div class="mt-3 flex flex-col gap-3">
                            <div class="p-3 bg-citragreen-100">
                                <p>
                                    Mempertahankan kinerja keuangan yang stabil dengan menjaga rasio-rasio keuangan pada
                                    tingkat yang sehat.
                                </p>
                            </div>
                            <div class="p-3 bg-citragreen-100">
                                <p>
                                    Mempertahankan kinerja keuangan yang stabil dengan menjaga rasio-rasio keuangan pada
                                    tingkat yang sehat.
                                </p>
                            </div>
                            <div class="p-3 bg-citragreen-100">
                                <p>
                                    Mempertahankan kinerja keuangan yang stabil dengan menjaga rasio-rasio keuangan pada
                                    tingkat yang sehat.
                                </p>
                            </div>
                            <div class="p-3 bg-citragreen-100">
                                <p>
                                    Mempertahankan kinerja keuangan yang stabil dengan menjaga rasio-rasio keuangan pada
                                    tingkat yang sehat.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5 bg-white overflow-hidden shadow-md sm:rounded-lg p-4">
                <h2 class="text-lg font-bold">
                    Rincian Perhitungan Perhitungan Analisis Rasio Keuangan
                </h2>
                <div class="mt-4 flex justify-between">
                    <h4 class="font-bold">Tanggal</h4>
                    <h4 class="font-bold">01/01/2023-31/01/2023</h4>
                </div>
                <div class="mt-4">
                    <h4 class="font-bold">
                        X1
                    </h4>
                    <div class="mt-2 flex justify-between">
                        <p class="ml-4">
                            Aset saat ini
                        </p>
                        <p>
                            Rp. xxx.xxx.xxx,-
                        </p>
                    </div>
                    <div class="mt-2 flex justify-between">
                        <p class="ml-4">
                            Liabilitas
                        </p>
                        <p>
                            Rp. xxx.xxx.xxx,-
                        </p>
                    </div>
                    <div class="mt-2 flex justify-between">
                        <p class="ml-4">
                            Modal Kerja Bersih
                        </p>
                        <p>
                            Rp. xxx.xxx.xxx,-
                        </p>
                    </div>
                    <div class="mt-2 flex justify-between">
                        <p class="ml-4">
                            Total Aset
                        </p>
                        <p>
                            Rp. xxx.xxx.xxx,-
                        </p>
                    </div>
                    <div class="mt-2 flex justify-between">
                        <p class="ml-4">
                            Modal Kerja Bersih/Total Aset
                        </p>
                        <p>
                            x.xx
                        </p>
                    </div>
                </div>

                <hr class="my-3">

                <div class="ml-4 flex justify-between">
                    <p class="font-bold">
                        X1 (6.56)
                    </p>
                    <p class="font-bold">
                        x.xx
                    </p>
                </div>

                <hr class="my-3">

                <div class="">
                    <h4 class="font-bold">
                        X2
                    </h4>
                    <div class="mt-2 flex justify-between">
                        <p class="ml-4">
                            Laba Ditahan
                        </p>
                        <p>
                            Rp. xxx.xxx.xxx,-
                        </p>
                    </div>
                    <div class="mt-2 flex justify-between">
                        <p class="ml-4">
                            Total Aset
                        </p>
                        <p>
                            Rp. xxx.xxx.xxx,-
                        </p>
                    </div>
                    <div class="mt-2 flex justify-between">
                        <p class="ml-4">
                            Laba Ditahan/Total Aset
                        </p>
                        <p>
                            x.xx
                        </p>
                    </div>
                </div>

                <hr class="my-3">

                <div class="ml-4 flex justify-between">
                    <p class="font-bold">
                        X2 (3.26)
                    </p>
                    <p class="font-bold">
                        x.xx
                    </p>
                </div>

                <hr class="my-3">

                <div class="">
                    <h4 class="font-bold">
                        X3
                    </h4>
                    <div class="mt-2 flex justify-between">
                        <p class="ml-4">
                            Pendapatan Sebelum Bunga dan Pajak
                        </p>
                        <p>
                            Rp. xxx.xxx.xxx,-
                        </p>
                    </div>
                    <div class="mt-2 flex justify-between">
                        <p class="ml-4">
                            Total Aset
                        </p>
                        <p>
                            Rp. xxx.xxx.xxx,-
                        </p>
                    </div>
                    <div class="mt-2 flex justify-between">
                        <p class="ml-4">
                            Pendapatan Sebelum Bunga dan Pajak/Total Aset
                        </p>
                        <p>
                            x.xx
                        </p>
                    </div>
                </div>

                <hr class="my-3">

                <div class="ml-4 flex justify-between">
                    <p class="font-bold">
                        X3 (6.72)
                    </p>
                    <p class="font-bold">
                        x.xx
                    </p>
                </div>

                <hr class="my-3">

                <div class="">
                    <h4 class="font-bold">
                        X4
                    </h4>
                    <div class="mt-2 flex justify-between">
                        <p class="ml-4 italic">
                            Paid in Capital
                        </p>
                        <p>
                            Rp. xxx.xxx.xxx,-
                        </p>
                    </div>
                    <div class="mt-2 flex justify-between">
                        <p class="ml-4">
                            Total Liabilitas
                        </p>
                        <p>
                            Rp. xxx.xxx.xxx,-
                        </p>
                    </div>
                    <div class="mt-2 flex justify-between">
                        <p class="ml-4">
                            <span class="italic">Paid in Capital</span>/Total Liabilitas
                        </p>
                        <p>
                            x.xx
                        </p>
                    </div>
                </div>

                <hr class="my-3">

                <div class="ml-4 flex justify-between">
                    <p class="font-bold">
                        X4 (1.05)
                    </p>
                    <p class="font-bold">
                        x.xx
                    </p>
                </div>

                <hr class="my-3">

                <div class="">
                    <h4 class="font-bold">
                        Z-Score
                    </h4>
                    <div class="mt-2 flex justify-between">
                        <p class="ml-4 italic">
                            X1
                        </p>
                        <p>
                            x.xx
                        </p>
                    </div>
                    <div class="mt-2 flex justify-between">
                        <p class="ml-4 italic">
                            X2
                        </p>
                        <p>
                            x.xx
                        </p>
                    </div>
                    <div class="mt-2 flex justify-between">
                        <p class="ml-4 italic">
                            X3
                        </p>
                        <p>
                            x.xx
                        </p>
                    </div>
                    <div class="mt-2 flex justify-between">
                        <p class="ml-4 italic">
                            X4
                        </p>
                        <p>
                            x.xx
                        </p>
                    </div>
                </div>

                <hr class="my-3">

                <div class="ml-4 flex justify-between">
                    <p class="font-bold">
                        Z-Score
                    </p>
                    <p class="font-bold">
                        x.xx
                    </p>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
