<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Transaksi Kas') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-4">
                <!-- Coa -->
                <div class="">
                    <x-input-label for="type" :value="__('Kode Akun')" />
                    <select id="type"
                        class="border-b-1 border-r-0 border-t-0 border-l-0 border-gray-300 focus:border-citragreen-500 focus:ring-citragreen-500 block mt-1 w-1/4"
                        type="text" name="coa_id" required>
                        <option hidden value="">Pilih Akun</option>
                    </select>
                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <div class="w-4/5 flex gap-3">
                        <!-- Penerima -->
                        <div class="w-full">
                            <x-input-label for="contact" :value="__('Penerima')" />
                            <select id="contact"
                                class="border-b-1 border-r-0 border-t-0 border-l-0 border-gray-300 focus:border-citragreen-500 focus:ring-citragreen-500 block mt-1 w-full"
                                type="text" name="contact_id" required>
                                <option hidden value="">Pilih Penerima</option>
                            </select>
                            <x-input-error :messages="$errors->get('contact')" class="mt-2" />
                        </div>


                        <!-- Harga -->
                        <div class="w-full">
                            <x-input-label for="price" :value="__('Harga')" />
                            <x-text-input id="price" class="block mt-1 w-full" type="text" name="price"
                                :value="old('price')" required autofocus autocomplete="price"
                                placeholder="Masukkan harga" />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                    </div>
                </div>

                <div class="mt-4">
                    <div class="w-4/5 flex gap-3">
                        <!-- Date -->
                        <div class="w-full">
                            <x-input-label for="date" :value="__('Tanggal')" />
                            <div class="flex items-center gap-1">
                                <x-text-input datepicker datepicker-autohide id="date" class="block mt-1 w-1/2"
                                    type="text" name="date" :value="old('date')" required autofocus
                                    autocomplete="date" placeholder="Tanggal" />
                                <label for="date" class="cursor-pointer">
                                    <i class=" bx bxs-calendar text-citradark-500 text-xl"></i>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>
                        <div class="w-full">
                            <x-input-label for="tax" :value="__('Pajak')" />
                            <div class="flex items-center gap-1">
                                <x-text-input datepicker datepicker-autohide id="tax" class="block mt-1 w-1/2"
                                    type="text" name="tax" :value="old('tax')" required autofocus
                                    autocomplete="tax" placeholder="Tanggal" />
                                <label for="tax" class="cursor-pointer">
                                    %
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <div class="w-2/5 flex pr-3">
                        <!-- Keterangan -->
                        <div class="w-full">
                            <x-input-label for="description" :value="__('Keterangan')" />
                            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description"
                                :value="old('description')" required autofocus autocomplete="description"
                                placeholder="Masukkan harga" />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                    </div>

                </div>


                <div class="w-1/2 relative float-right">
                    <div class="mt-6 flex justify-between">
                        <h3 class="text-left text-md font-bold">Total</h3>
                        <h3 class="text-2xl font-bold text-right">Rp. 6.600.000,-</h3>
                    </div>

                    <div class="mt-6 float-right">
                        <a href="{{ route('umkm.cost.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-zinc-200 border border-transparent rounded-md font-bold text-xs text-zinc-500 hover:bg-zinc-300 focus:bg-zinc-400 active:bg-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Batal
                        </a>
                        <x-primary-button class="ml-2">
                            Simpan
                        </x-primary-button>
                    </div>
                </div>




            </div>
        </div>
    </div>

</x-app-layout>
