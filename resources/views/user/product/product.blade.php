<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produk / Jasa') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="px-4 pt-4 pb-24">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold">Daftar Produk</h2>
                        <button type="button" data-modal="addProductModal" data-modal-toggle="addProductModal"
                            class="mt-3 inline-flex items-center px-4 py-1 bg-citradark-500 border border-transparent rounded-md font-bold text-xs text-white hover:bg-citradark-700 focus:bg-citradark-400 active:bg-citradark-600 focus:outline-none focus:ring-2 focus:ring-citradark-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <i class="bx bx-plus text-xl"></i>
                            Tambah Produk
                        </button>
                    </div>

                    <table class="mt-6 w-full border-collapse">
                        <tr
                            class="text-zinc-400 font-bold border border-b-1 border-r-0 border-t-0 border-l-0 border-zinc-400">
                            <td class="p-3">Nama</td>
                            <td class="p-3">Deskripsi</td>
                            <td class="p-3">Harga Beli</td>
                            <td class="p-3">Harga Jual</td>
                            <td class="p-3">Stok</td>
                            <td class="p-3">Pajak Beli</td>
                            <td class="p-3">Pajak Jual</td>
                            <td class="p-3 text-center">Tindakan</td>
                        </tr>
                        @foreach ($products as $product)
                            <tr class="border border-b-1 border-r-0 border-t-0 border-l-0 border-zinc-400">
                                <td class="p-3">{{ $product->name }}</td>
                                <td class="p-3">{{ $product->description ?? '-' }}</td>
                                <td class="p-3">
                                    {{ !empty($product->purchase->price) ? AppHelper::rp($product->purchase->price) : '-' }}
                                </td>
                                <td class="p-3">
                                    {{ !empty($product->sale->price) ? AppHelper::rp($product->sale->price) : '-' }}
                                </td>
                                <td class="p-3">
                                    {{ $product->stock->stock ?? '-' }}</td>
                                <td class="p-3">
                                    {{ !empty($product->purchase->tax) ? $product->purchase->tax . '%' : '-' }}
                                </td>
                                <td class="p-3">{{ !empty($product->sale->tax) ? $product->sale->tax . '%' : '-' }}
                                </td>
                                <td class="p-3 text-center">
                                    <x-dropdown align="left" width="48">
                                        <x-slot name="trigger">
                                            <button>
                                                <i class="bx bx-dots-horizontal-rounded text-xl"></i>
                                            </button>
                                        </x-slot>

                                        <x-slot name="content">
                                            <x-dropdown-link data-modal="editProductModal-{{ $loop->iteration }}"
                                                data-modal-toggle="editProductModal-{{ $loop->iteration }}">
                                                {{ __('Edit') }}
                                            </x-dropdown-link>
                                            <x-dropdown-link data-modal="deleteProductModal-{{ $loop->iteration }}"
                                                data-modal-toggle="deleteProductModal-{{ $loop->iteration }}"
                                                class="text-red-500">
                                                {{ __('Hapus') }}
                                            </x-dropdown-link>
                                        </x-slot>
                                    </x-dropdown>
                                </td>
                            </tr>

                            <!-- Edit modal -->
                            <div id="editProductModal-{{ $loop->iteration }}" tabindex="-1" aria-hidden="true"
                                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                <div class="relative w-full h-full max-w-2xl md:h-auto">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-start justify-between p-4 border-b rounded-t border-zinc-200">
                                            <h3 class="text-xl font-bold">
                                                Edit Produk
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-zinc-200 hover:text-citrablack rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                                data-modal-hide="editProductModal-{{ $loop->iteration }}">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('umkm.product.update', $product) }}"
                                            id="editproduct-{{ $loop->iteration }}" method="post">@csrf
                                            @method('PATCH')</form>
                                        <!-- Modal body -->
                                        <div class="p-6 space-y-6">
                                            <div class="flex space-x-16 items-center">
                                                <label for="name-{{ $loop->iteration }}" class="w-32">Nama
                                                    Produk</label>
                                                <x-text-input form="editproduct-{{ $loop->iteration }}"
                                                    id="name-{{ $loop->iteration }}" class="block w-full"
                                                    type="text" name="name" :value="$product->name" required autofocus
                                                    autocomplete="name" />
                                            </div>

                                            <div class="flex space-x-16 items-center">
                                                <label for="description-{{ $loop->iteration }}"
                                                    class="w-32">Deskripsi</label>
                                                <x-text-input form="addproduct" id="description-{{ $loop->iteration }}"
                                                    class="block w-full" type="text" name="description"
                                                    :value="$product->description" autofocus autocomplete="description" />
                                            </div>

                                            <div>
                                                <input {{ !empty($product->purchase) ? 'checked' : '' }}
                                                    form="editproduct-{{ $loop->iteration }}" type="checkbox"
                                                    name="beli" class="peer" id="beli-{{ $loop->iteration }}">
                                                <label for="beli-{{ $loop->iteration }}">Saya Beli Produk Ini</label>
                                                <div class="peer-checked:block hidden ">
                                                    <div class="flex space-x-16 items-center">
                                                        <label for="coa_id_beli-{{ $loop->iteration }}"
                                                            class="pl-3 w-32">Kode Akun</label>
                                                        <select form="editproduct-{{ $loop->iteration }}"
                                                            id="coa_id_beli-{{ $loop->iteration }}"
                                                            class="border-b-1 w-full border-r-0 border-t-0 border-l-0 border-gray-300 focus:border-citragreen-500 focus:ring-citragreen-500 block mt-1"
                                                            type="text" name="coa_id_beli" required>
                                                            @if (!empty($product->purchase))
                                                                <option hidden
                                                                    value="{{ $product->purchase->coa->id }}">
                                                                    {{ $product->purchase->coa->code }}
                                                                    - {{ $product->purchase->coa->name }}
                                                                </option>
                                                            @else
                                                                <option hidden
                                                                    value="{{ $coas->where('code', '5-50000')->first()->id }}">
                                                                    {{ $coas->where('code', '5-50000')->first()->code }}
                                                                    -
                                                                    {{ $coas->where('code', '5-50000')->first()->name }}
                                                                </option>
                                                            @endif
                                                            @foreach ($coas as $coa)
                                                                <option value="{{ $coa->id }}">
                                                                    {{ $coa->code }} -
                                                                    {{ $coa->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="flex justify-between items-center">
                                                        <label for="harga_beli-{{ $loop->iteration }}"
                                                            class="pl-3">Harga Beli</label>
                                                        <x-text-input form="editproduct-{{ $loop->iteration }}"
                                                            id="harga_beli-{{ $loop->iteration }}" class="block"
                                                            type="text" name="harga_beli" :value="$product->purchase->price ?? ''"
                                                            autofocus autocomplete="harga_beli" />
                                                        <label for="pajak_beli" class="">Pajak Beli</label>
                                                        <x-text-input form="editproduct-{{ $loop->iteration }}"
                                                            id="pajak_beli-{{ $loop->iteration }}"
                                                            class="w-1/6 block" type="text" name="pajak_beli"
                                                            :value="$product->purchase->tax ?? ''" autofocus autocomplete="pajak_beli" />
                                                        %
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <input {{ !empty($product->sale) ? 'checked' : '' }}
                                                    form="editproduct-{{ $loop->iteration }}" type="checkbox"
                                                    name="jual" class="peer" id="jual-{{ $loop->iteration }}">
                                                <label for="jual-{{ $loop->iteration }}">Saya Jual Produk Ini</label>
                                                <div class="peer-checked:block hidden">
                                                    <div class="flex space-x-16 items-center">
                                                        <label for="coa_id_jual-{{ $loop->iteration }}"
                                                            class="pl-3 w-32">Kode Akun</label>
                                                        <select form="editproduct-{{ $loop->iteration }}"
                                                            id="coa_id_jual-{{ $loop->iteration }}"
                                                            class="border-b-1 w-full border-r-0 border-t-0 border-l-0 border-gray-300 focus:border-citragreen-500 focus:ring-citragreen-500 block mt-1"
                                                            type="text" name="coa_id_jual" required>
                                                            @if (!empty($product->sale))
                                                                <option hidden value="{{ $product->sale->coa->id }}">
                                                                    {{ $product->sale->coa->code }}
                                                                    - {{ $product->sale->coa->name }}
                                                                </option>
                                                            @else
                                                                <option hidden
                                                                    value="{{ $coas->where('code', '4-40000')->first()->id }}">
                                                                    {{ $coas->where('code', '4-40000')->first()->code }}
                                                                    -
                                                                    {{ $coas->where('code', '4-40000')->first()->name }}
                                                                </option>
                                                            @endif
                                                            @foreach ($coas as $coa)
                                                                <option value="{{ $coa->id }}">
                                                                    {{ $coa->code }} -
                                                                    {{ $coa->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="flex justify-between items-center">
                                                        <label for="harga_jual-{{ $loop->iteration }}"
                                                            class=" pl-3">Harga Jual</label>
                                                        <x-text-input form="editproduct-{{ $loop->iteration }}"
                                                            id="harga_jual-{{ $loop->iteration }}" class="block"
                                                            type="text" name="harga_jual" :value="$product->sale->price ?? ''"
                                                            autofocus autocomplete="harga_jual" />
                                                        <label for="pajak_jual-{{ $loop->iteration }}"
                                                            class="">Pajak Jual</label>
                                                        <x-text-input form="editproduct-{{ $loop->iteration }}"
                                                            id="pajak_jual-{{ $loop->iteration }}"
                                                            class="w-1/6 block" type="text" name="pajak_jual"
                                                            :value="$product->sale->tax ?? ''" autofocus autocomplete="pajak_jual" />
                                                        %
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <input {{ !empty($product->stock) ? 'checked' : '' }}
                                                    form="editproduct-{{ $loop->iteration }}" type="checkbox"
                                                    name="monitor" class="peer"
                                                    id="monitor-{{ $loop->iteration }}">
                                                <label for="monitor-{{ $loop->iteration }}">Monitor Stok Persediaan
                                                    Barang</label>
                                                <div class="peer-checked:block hidden">
                                                    <div class="flex space-x-16 items-center">
                                                        <label for="coa_id_stock-{{ $loop->iteration }}"
                                                            class="pl-3 w-32">Kode Akun</label>
                                                        <select form="editproduct-{{ $loop->iteration }}"
                                                            id="coa_id_stock-{{ $loop->iteration }}"
                                                            class="border-b-1 w-full border-r-0 border-t-0 border-l-0 border-gray-300 focus:border-citragreen-500 focus:ring-citragreen-500 block mt-1"
                                                            type="text" name="coa_id_stock" required>
                                                            @if (!empty($product->stock))
                                                                <option hidden value="{{ $product->stock->coa->id }}">
                                                                    {{ $product->stock->coa->code }}
                                                                    - {{ $product->stock->coa->name }}
                                                                </option>
                                                            @else
                                                                <option hidden
                                                                    value="{{ $coas->where('code', '1-10200')->first()->id }}">
                                                                    {{ $coas->where('code', '1-10200')->first()->code }}
                                                                    -
                                                                    {{ $coas->where('code', '1-10200')->first()->name }}
                                                                </option>
                                                            @endif
                                                            @foreach ($coas as $coa)
                                                                <option value="{{ $coa->id }}">
                                                                    {{ $coa->code }} -
                                                                    {{ $coa->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <!-- Modal footer -->
                                        <div
                                            class="flex justify-end items-center p-6 space-x-2 border-t border-zinc-200 rounded-b">

                                            <button data-modal-hide="editProductModal-{{ $loop->iteration }}"
                                                type="button"
                                                class="inline-flex items-center px-4 py-2 bg-zinc-200 border border-transparent rounded-md font-bold text-xs text-zinc-500 hover:bg-zinc-300 focus:bg-zinc-400 active:bg-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                Batal
                                            </button>
                                            <x-primary-button form="editproduct-{{ $loop->iteration }}"
                                                class="ml-2">
                                                Simpan
                                            </x-primary-button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete modal -->
                            <div id="deleteProductModal-{{ $loop->iteration }}" tabindex="-1" aria-hidden="true"
                                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                <div class="relative w-full h-full max-w-2xl md:h-auto">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-start justify-between p-4 border-b rounded-t border-zinc-200">
                                            <h3 class="text-xl font-bold">
                                                Hapus Produk
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-zinc-200 hover:text-citrablack rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                                data-modal-hide="deleteProductModal-{{ $loop->iteration }}">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-6 space-y-6 flex flex-col items-center">
                                            <img src="{{ asset('images/assets/delete.svg') }}" class="w-36"
                                                alt="">
                                            <div>
                                                <h3 class="text-lg font-bold">Apakah anda yakin akan menghapus data
                                                    ini?</h3>
                                                <p class="text-center">Data yang
                                                    telah terhapus tidak
                                                    dapat diakses kembali.</p>
                                            </div>
                                            <div class="flex">
                                                <button data-modal-hide="deleteProductModal-{{ $loop->iteration }}"
                                                    type="button"
                                                    class="inline-flex items-center px-4 py-2 bg-zinc-200 border border-transparent rounded-md font-bold text-xs text-zinc-500 hover:bg-zinc-300 focus:bg-zinc-400 active:bg-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                    Batal
                                                </button>
                                                <form action="{{ route('umkm.product.destroy', $product) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <x-primary-button
                                                        class="bg-citrared-500 hover:bg-citrared-600 ml-2">
                                                        Hapus
                                                    </x-primary-button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </table>
                    <div class="mt-4">
                        {{ $products->links('vendor.pagination.default') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add modal -->
    <div id="addProductModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
        <div class="relative w-full h-full max-w-2xl md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t border-zinc-200">
                    <h3 class="text-xl font-bold">
                        Tambah Produk / Jasa
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-zinc-200 hover:text-citrablack rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                        data-modal-hide="addProductModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form action="{{ route('umkm.product.store') }}" id="addproduct" method="post">@csrf</form>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <div class="flex space-x-16 items-center">
                        <label for="name" class="w-32">Nama Produk</label>
                        <x-text-input form="addproduct" id="name" class="block w-full" type="text"
                            name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>

                    <div class="flex space-x-16 items-center">
                        <label for="description" class="w-32">Deskripsi</label>
                        <x-text-input form="addproduct" id="description" class="block w-full" type="text"
                            name="description" :value="old('description')" autofocus autocomplete="description" />
                    </div>

                    <div>
                        <input form="addproduct" type="checkbox" name="beli" class="peer" id="beli">
                        <label for="beli">Saya Beli Produk Ini</label>
                        <div class="peer-checked:block hidden ">
                            <div class="flex space-x-16 items-center">
                                <label for="coa_id_beli" class="pl-3 w-32">Kode Akun</label>
                                <select form="addproduct" id="coa_id_beli"
                                    class="js-example-basic-single border-b-1 w-full border-r-0 border-t-0 border-l-0 border-gray-300 focus:border-citragreen-500 focus:ring-citragreen-500 block mt-1"
                                    type="text" name="coa_id_beli" required>
                                    <option hidden value="{{ $coas->where('code', '5-50000')->first()->id }}">
                                        {{ $coas->where('code', '5-50000')->first()->code }}
                                        - {{ $coas->where('code', '5-50000')->first()->name }}</option>
                                    @foreach ($coas as $coa)
                                        <option value="{{ $coa->id }}">{{ $coa->code }} -
                                            {{ $coa->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex justify-between items-center">
                                <label for="harga_beli" class="pl-3">Harga Beli</label>
                                <x-text-input form="addproduct" id="harga_beli" class="block" type="text"
                                    name="harga_beli" :value="old('harga_beli')" autofocus autocomplete="harga_beli" />
                                <label for="pajak_beli" class="">Pajak Beli</label>
                                <x-text-input form="addproduct" id="pajak_beli" class="w-1/6 block" type="text"
                                    name="pajak_beli" :value="old('pajak_beli')" autofocus autocomplete="pajak_beli" />
                                %
                            </div>
                        </div>
                    </div>

                    <div>
                        <input form="addproduct" type="checkbox" name="jual" class="peer" id="jual">
                        <label for="jual">Saya Jual Produk Ini</label>
                        <div class="peer-checked:block hidden">
                            <div class="flex space-x-16 items-center">
                                <label for="coa_id_jual" class="pl-3 w-32">Kode Akun</label>
                                <select form="addproduct" id="coa_id_jual"
                                    class="js-example-basic-single border-b-1 w-full border-r-0 border-t-0 border-l-0 border-gray-300 focus:border-citragreen-500 focus:ring-citragreen-500 block mt-1"
                                    type="text" name="coa_id_jual" required>
                                    <option hidden value="{{ $coas->where('code', '4-40000')->first()->id }}">
                                        {{ $coas->where('code', '4-40000')->first()->code }}
                                        - {{ $coas->where('code', '4-40000')->first()->name }}</option>
                                    @foreach ($coas as $coa)
                                        <option value="{{ $coa->id }}">{{ $coa->code }} -
                                            {{ $coa->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex justify-between items-center">
                                <label for="harga_jual" class=" pl-3">Harga Jual</label>
                                <x-text-input form="addproduct" id="harga_jual" class="block" type="text"
                                    name="harga_jual" :value="old('harga_jual')" autofocus autocomplete="harga_jual" />
                                <label for="pajak_beli" class="">Pajak Jual</label>
                                <x-text-input form="addproduct" id="pajak_jual" class="w-1/6 block" type="text"
                                    name="pajak_jual" :value="old('pajak_jual')" autofocus autocomplete="pajak_jual" />
                                %
                            </div>
                        </div>
                    </div>

                    <div>
                        <input form="addproduct" type="checkbox" name="monitor" class="peer" id="monitor">
                        <label for="monitor">Monitor Stok Persediaan Barang</label>
                        <div class="peer-checked:block hidden">
                            <div class="flex space-x-16 items-center">
                                <label for="coa_id_stock" class="pl-3 w-32">Kode Akun</label>
                                <select form="addproduct" id="coa_id_stock"
                                    class="js-example-basic-single border-b-1 w-full border-r-0 border-t-0 border-l-0 border-gray-300 focus:border-citragreen-500 focus:ring-citragreen-500 block mt-1"
                                    type="text" name="coa_id_stock" required>
                                    <option hidden value="{{ $coas->where('code', '1-10200')->first()->id }}">
                                        {{ $coas->where('code', '1-10200')->first()->code }}
                                        - {{ $coas->where('code', '1-10200')->first()->name }}</option>
                                    @foreach ($coas as $coa)
                                        <option value="{{ $coa->id }}">{{ $coa->code }} -
                                            {{ $coa->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Modal footer -->
                <div class="flex justify-end items-center p-6 space-x-2 border-t border-zinc-200 rounded-b">

                    <button data-modal-hide="addProductModal" type="button"
                        class="inline-flex items-center px-4 py-2 bg-zinc-200 border border-transparent rounded-md font-bold text-xs text-zinc-500 hover:bg-zinc-300 focus:bg-zinc-400 active:bg-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Batal
                    </button>
                    <x-primary-button form="addproduct" class="ml-2">
                        Simpan
                    </x-primary-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
