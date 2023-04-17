<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Aset') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="px-4 pt-4 pb-24">
                    <h2 class="text-xl font-bold">Aset yang Dimiliki</h2>

                    <table class="mt-6 w-full border-collapse">
                        <tr
                            class="text-zinc-400 font-bold border border-b-1 border-r-0 border-t-0 border-l-0 border-zinc-400">
                            <td class="p-3">Tanggal diperoleh</td>
                            <td class="p-3">Barang</td>
                            <td class="p-3">Faktur</td>
                            <td class="p-3">Total Biaya</td>
                            <td class="p-3 text-center">Tindakan</td>
                        </tr>
                        @foreach ($assets as $asset)
                            <tr class="border border-b-1 border-r-0 border-t-0 border-l-0 border-zinc-400">
                                <td class="p-3">{{ AppHelper::date($asset->transaction->date) }}</td>
                                <td class="p-3">{{ $asset->product->name }}</td>
                                <td class="p-3">{{ $asset->transaction->invoice }}</td>
                                <td class="p-3">{{ AppHelper::rp($asset->price ?? 0) }}</td>
                                <td class="p-3 text-center">
                                    <x-dropdown align="left" width="48">
                                        <x-slot name="trigger">
                                            <button>
                                                <i class="bx bx-dots-horizontal-rounded text-xl"></i>
                                            </button>
                                        </x-slot>

                                        <x-slot name="content">
                                            <x-dropdown-link data-modal="editAssetModal"
                                                data-modal-toggle="editAssetModal">
                                                {{ __('Edit') }}
                                            </x-dropdown-link>
                                            <x-dropdown-link class="text-red-500">
                                                {{ __('Delete') }}
                                            </x-dropdown-link>
                                        </x-slot>
                                    </x-dropdown>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit modal -->
    <div id="editAssetModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
        <div class="relative w-full h-full max-w-2xl md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t border-zinc-200">
                    <h3 class="text-xl font-bold">
                        Edit Aset
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-zinc-200 hover:text-citrablack rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                        data-modal-hide="editAssetModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <div class="flex space-x-16 items-center">
                        <label for="name" class="w-32">Nama Aset</label>
                        <x-text-input id="name" class="block w-full" type="text" name="name"
                            :value="old('name')" required autofocus autocomplete="name" />
                    </div>

                    <div class="flex space-x-16 items-center">
                        <label for="coa_id" class="w-32">Kode Akun</label>
                        <select id="coa_id"
                            class="border-b-1 w-full border-r-0 border-t-0 border-l-0 border-gray-300 focus:border-citragreen-500 focus:ring-citragreen-500 block mt-1"
                            type="text" name="coa_id" required>
                            <option hidden value="">Pilih Akun</option>
                        </select>
                    </div>

                    <div class="flex space-x-16 items-center">
                        <label for="description" class="w-32">Deskripsi</label>
                        <x-text-input id="description" class="block w-full" type="text" name="description"
                            :value="old('description')" required autofocus autocomplete="description" />
                    </div>

                    <div class="flex space-x-16 items-center">
                        <p class="w-32">Tanggal</p>
                        <p class="w-full">08/12/2021</p>
                    </div>

                    <div class="flex space-x-16 items-center">
                        <p class="w-32">Harga</p>
                        <p class="w-full">Rp. 20.000</p>
                    </div>

                    <div class="flex space-x-16 items-center">
                        <p class="w-32">Faktur</p>
                        <p class="w-full">Faktur Pembelian #10001</p>
                    </div>

                </div>
                <!-- Modal footer -->
                <div class="flex justify-end items-center p-6 space-x-2 border-t border-zinc-200 rounded-b">

                    <button data-modal-hide="editAssetModal" type="button"
                        class="inline-flex items-center px-4 py-2 bg-zinc-200 border border-transparent rounded-md font-bold text-xs text-zinc-500 hover:bg-zinc-300 focus:bg-zinc-400 active:bg-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Batal
                    </button>
                    <x-primary-button class="ml-2">
                        Simpan
                    </x-primary-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
