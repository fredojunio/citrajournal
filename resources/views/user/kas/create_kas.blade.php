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
                    <div class="flex gap-3 w-1/2">
                        <!-- Penerima -->
                        <div class="w-1/2">
                            <x-input-label for="contact" :value="__('Penerima')" />
                            <select id="contact"
                                class="border-b-1 border-r-0 border-t-0 border-l-0 border-gray-300 focus:border-citragreen-500 focus:ring-citragreen-500 block mt-1 w-full"
                                type="text" name="contact_id" required>
                                <option hidden value="">Pilih Penerima</option>
                            </select>
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>
                        <!-- Date -->
                        <div>
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
                    </div>
                </div>

                <hr class="my-6">

                <table class="w-full">
                    <tr class="font-bold text-left">
                        <th class="p-2">Kode Akun</th>
                        <th class="p-2">Deskripsi</th>
                        <th class="p-2">Pajak</th>
                        <th class="p-2">Harga</th>
                        <th class="p-2"></th>
                    </tr>
                    <tr>
                        <td class="p-2">
                            <select id="coa-1"
                                class="border-b-1 border-r-0 border-t-0 border-l-0 border-gray-300 focus:border-citragreen-500 focus:ring-citragreen-500 block"
                                type="text" name="coa_id[]" required>
                                <option hidden value="">Pilih Akun</option>
                            </select>
                        </td>
                        <td class="p-2">
                            <x-text-input id="description-1" class="block mt-1 w-full" type="text"
                                name="description[]" :value="old('description')" required autofocus autocomplete="description"
                                placeholder="Deskripsi" />
                        </td>
                        <td class="flex gap-1 items-center p-2">
                            <x-text-input id="tax-1" class="block mt-1 w-full" type="number" name="tax[]"
                                :value="old('tax')" required autofocus autocomplete="tax" placeholder="" />
                            %
                        </td>
                        <td class="p-2">
                            <x-text-input id="price-1" class="block mt-1 w-full" type="number" name="price[]"
                                :value="old('price')" required autofocus autocomplete="price" placeholder="Harga" />
                        </td>
                        <td class="p-2">
                            <button>
                                <i class="bx bx-minus text-lg"></i>
                            </button>
                        </td>
                    </tr>
                </table>

                <div class="mt-4">
                    <button
                        class="mt-3 inline-flex items-center px-4 py-1 bg-citradark-500 border border-transparent rounded-md font-bold text-xs text-white hover:bg-citradark-700 focus:bg-citradark-400 active:bg-citradark-600 focus:outline-none focus:ring-2 focus:ring-citradark-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <i class="bx bx-plus text-xl"></i>
                        Tambah Data
                    </button>
                </div>

                <div class="mt-10 float-right w-1/2">
                    <div class="flex justify-between items-center">
                        <p class="text-left">Subtotal</p>
                        <p class="text-right">Rp. 6.600.000,-</p>
                    </div>
                    <div class="mt-4 flex justify-between items-center">
                        <div class="flex gap-1 items-center">
                            <p class="text-left">Potongan</p>
                            <x-text-input id="cut" class="block mt-1 w-12" type="text" name="cut"
                                :value="old('cut')" required autofocus autocomplete="tax" placeholder="" />
                            %
                        </div>
                        <p class="text-right">Rp. 0,-</p>
                    </div>

                    <div class="mt-6 flex justify-between items-center">
                        <h3 class="text-left text-md font-bold">Total</h3>
                        <h3 class="text-right text-2xl font-bold">Rp. 6.600.000,-</h3>
                    </div>

                    <div class="mt-6 float-right">
                        <a href="{{ route('umkm.kas.index') }}"
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