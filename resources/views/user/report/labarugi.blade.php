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
                        Pendapatan
                    </h4>
                    <div class="mt-2 flex justify-between">
                        <div class="ml-4 flex gap-3">
                            <p>
                                4-40000
                            </p>
                            <p>
                                Pendapatan
                            </p>
                        </div>
                        <p>
                            Rp. xxx.xxx.xxx,-
                        </p>
                    </div>
                </div>
                <hr class="my-3">
                <div class="ml-4 flex justify-between">
                    <p>
                        Total Pendapatan
                    </p>
                    <p class="font-bold">
                        Rp. xxx.xxx.xxx,-
                    </p>
                </div>
                <div class="mt-4">
                    <h4 class="font-bold">
                        Beban Pendapatan
                    </h4>
                    <div class="mt-2 flex justify-between">
                        <div class="ml-4 flex gap-3">
                            <p>
                                5-50000
                            </p>
                            <p>
                                Beban Pokok Pendapatan
                            </p>
                        </div>
                        <p>
                            Rp. xxx.xxx.xxx,-
                        </p>
                    </div>
                </div>
                <hr class="my-3">
                <div class="ml-4 flex justify-between">
                    <p>
                        Total Beban Pendapatan
                    </p>
                    <p class="font-bold">
                        Rp. xxx.xxx.xxx,-
                    </p>
                </div>
                <hr class="my-3">
                <div class="flex justify-between">
                    <p class="font-bold">
                        Laba Kotor
                    </p>
                    <p class="font-bold">
                        Rp. xxx.xxx.xxx,-
                    </p>
                </div>
                <div class="mt-4">
                    <h4 class="font-bold">
                        Biaya Usaha
                    </h4>
                    <div class="mt-2 flex justify-between">
                        <div class="ml-4 flex gap-3">
                            <p>
                                6-60101
                            </p>
                            <p>
                                Gaji
                            </p>
                        </div>
                        <p>
                            Rp. xxx.xxx.xxx,-
                        </p>
                    </div>
                    <div class="mt-2 flex justify-between">
                        <div class="ml-4 flex gap-3">
                            <p>
                                6-60217
                            </p>
                            <p>
                                Listrik
                            </p>
                        </div>
                        <p>
                            Rp. xxx.xxx.xxx,-
                        </p>
                    </div>
                    <div class="mt-2 flex justify-between">
                        <div class="ml-4 flex gap-3">
                            <p>
                                6-60300
                            </p>
                            <p>
                                Beban Kantor
                            </p>
                        </div>
                        <p>
                            Rp. xxx.xxx.xxx,-
                        </p>
                    </div>
                    <div class="mt-2 flex justify-between">
                        <div class="ml-4 flex gap-3">
                            <p>
                                6-60301
                            </p>
                            <p>
                                Depresiasi
                            </p>
                        </div>
                        <p>
                            Rp. xxx.xxx.xxx,-
                        </p>
                    </div>
                    <div class="mt-2 flex justify-between">
                        <div class="ml-4 flex gap-3">
                            <p>
                                6-60301
                            </p>
                            <p>
                                Depresiasi
                            </p>
                        </div>
                        <p>
                            Rp. xxx.xxx.xxx,-
                        </p>
                    </div>
                    <div class="mt-2 flex justify-between">
                        <div class="ml-4 flex gap-3">
                            <p>
                                6-60401
                            </p>
                            <p>
                                Lain-lain
                            </p>
                        </div>
                        <p>
                            Rp. xxx.xxx.xxx,-
                        </p>
                    </div>
                </div>
                <hr class="my-3">
                <div class="ml-4 flex justify-between">
                    <p>
                        Total Biaya Usaha
                    </p>
                    <p class="font-bold">
                        Rp. xxx.xxx.xxx,-
                    </p>
                </div>
                <hr class="my-3">
                <div class="flex justify-between">
                    <p class="font-bold">
                        Laba Operasional
                    </p>
                    <p class="font-bold">
                        Rp. xxx.xxx.xxx,-
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
                            Rp. xxx.xxx.xxx,-
                        </p>
                    </div>
                    <div class="mt-2 flex justify-between">
                        <p class="ml-4">
                            Biaya Diluar Usaha
                        </p>
                        <p>
                            Rp. xxx.xxx.xxx,-
                        </p>
                    </div>
                </div>
                <hr class="my-3">
                <div class="ml-4 flex justify-between">
                    <p>
                        Total Pendapatan dan Biaya Diluar Usaha
                    </p>
                    <p class="font-bold">
                        Rp. xxx.xxx.xxx,-
                    </p>
                </div>
                <hr class="my-3">
                <div class="flex justify-between">
                    <p class="font-bold">
                        Laba
                    </p>
                    <p class="font-bold">
                        Rp. xxx.xxx.xxx,-
                    </p>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
