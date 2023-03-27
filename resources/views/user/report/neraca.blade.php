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
            <div class="mt-5 bg-white overflow-hidden shadow-md sm:rounded-lg p-4">
                <div class="flex justify-between">
                    <h4 class="font-bold">Tanggal</h4>
                    <h4 class="font-bold">01/01/2023-31/01/2023</h4>
                </div>
                <div class="mt-4">
                    <h4 class="font-bold">
                        Aset
                    </h4>
                    <div class="mt-2 ml-4">
                        <h4 class="font-bold">
                            Aset Lancar
                        </h4>
                        <div class="mt-2 flex justify-between">
                            <div class="ml-4 flex gap-3">
                                <p>
                                    1-10001
                                </p>
                                <p>
                                    Kas
                                </p>
                            </div>
                            <p>
                                Rp. xxx.xxx.xxx,-
                            </p>
                        </div>
                        <div class="mt-2 flex justify-between">
                            <div class="ml-4 flex gap-3">
                                <p>
                                    1-10100
                                </p>
                                <p>
                                    Piutang Usaha
                                </p>
                            </div>
                            <p>
                                Rp. xxx.xxx.xxx,-
                            </p>
                        </div>
                        <div class="mt-2 flex justify-between">
                            <div class="ml-4 flex gap-3">
                                <p>
                                    1-10200
                                </p>
                                <p>
                                    Persediaan Barang
                                </p>
                            </div>
                            <p>
                                Rp. xxx.xxx.xxx,-
                            </p>
                        </div>
                        <div class="mt-2 flex justify-between">
                            <div class="ml-4 flex gap-3">
                                <p>
                                    1-10402
                                </p>
                                <p>
                                    Biaya Dibayar Di Muka
                                </p>
                            </div>
                            <p>
                                Rp. xxx.xxx.xxx,-
                            </p>
                        </div>
                        <div class="mt-2 flex justify-between">
                            <div class="ml-4 flex gap-3">
                                <p>
                                    1-10500
                                </p>
                                <p>
                                    PPN Masukan
                                </p>
                            </div>
                            <p>
                                Rp. xxx.xxx.xxx,-
                            </p>
                        </div>
                    </div>
                </div>

                <hr class="my-3">

                <div class="ml-4 flex justify-between">
                    <p class="font-bold">
                        Total Aset Lancar
                    </p>
                    <p class="font-bold">
                        Rp. xxx.xxx.xxx,-
                    </p>
                </div>
                <div class="mt-4 ml-4">
                    <h4 class="font-bold">
                        Aset Tetap
                    </h4>
                    <div class="mt-2 flex justify-between">
                        <div class="ml-4 flex gap-3">
                            <p>
                                1-10705
                            </p>
                            <p>
                                Aset Tetap - Perlengkapan Kantor
                            </p>
                        </div>
                        <p>
                            Rp. xxx.xxx.xxx,-
                        </p>
                    </div>
                </div>

                <hr class="my-3">

                <div class="ml-4 flex justify-between">
                    <p class="font-bold">
                        Total Aset Tetap
                    </p>
                    <p class="font-bold">
                        Rp. xxx.xxx.xxx,-
                    </p>
                </div>

                <hr class="my-3">

                <div class="flex justify-between">
                    <p class="font-bold">
                        Total Aset
                    </p>
                    <p class="font-bold">
                        Rp. xxx.xxx.xxx,-
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
                        <div class="mt-2 flex justify-between">
                            <div class="ml-4 flex gap-3">
                                <p>
                                    2-20100
                                </p>
                                <p>
                                    Hutang Usaha
                                </p>
                            </div>
                            <p>
                                Rp. xxx.xxx.xxx,-
                            </p>
                        </div>
                        <div class="mt-2 flex justify-between">
                            <div class="ml-4 flex gap-3">
                                <p>
                                    2-20500
                                </p>
                                <p>
                                    PPN Keluaran
                                </p>
                            </div>
                            <p>
                                Rp. xxx.xxx.xxx,-
                            </p>
                        </div>
                        <div class="mt-2 flex justify-between">
                            <div class="ml-4 flex gap-3">
                                <p>
                                    2-20505
                                </p>
                                <p>
                                    Hutang Pajak
                                </p>
                            </div>
                            <p>
                                Rp. xxx.xxx.xxx,-
                            </p>
                        </div>
                    </div>
                </div>

                <hr class="my-3">

                <div class="ml-4 flex justify-between">
                    <p class="font-bold">
                        Liabilitas Jangka Pendek
                    </p>
                    <p class="font-bold">
                        Rp. xxx.xxx.xxx,-
                    </p>
                </div>

                <div class="mt-10">
                    <div class="mt-2 ml-4">
                        <h4 class="font-bold">
                            Modal Pemilik
                        </h4>
                        <div class="mt-2 flex justify-between">
                            <div class="ml-4 flex gap-3">
                                <p>
                                    3-30000
                                </p>
                                <div class="flex flex-col gap-2">
                                    <p>
                                        Modal Saham
                                    </p>
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
                            <div class="flex flex-col gap-2">
                                <p>
                                    Rp. xxx.xxx.xxx,-
                                </p>
                                <p>
                                    Rp. xxx.xxx.xxx,-
                                </p>
                                <p>
                                    Rp. xxx.xxx.xxx,-
                                </p>
                                <p>
                                    Rp. xxx.xxx.xxx,-
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
                        Rp. xxx.xxx.xxx,-
                    </p>
                </div>

                <hr class="my-3">

                <div class="flex justify-between">
                    <p class="font-bold">
                        Total Liabilitas dan Modal
                    </p>
                    <p class="font-bold">
                        Rp. xxx.xxx.xxx,-
                    </p>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
