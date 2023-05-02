<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Pembelian') }}
        </h2>
    </x-slot>

    <div id="product-data" data-product-data="{{ $products_json }}"></div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            @if (session('alert'))
                <div class="mb-6 bg-white overflow-hidden shadow-md sm:rounded-lg p-4">
                    <p class="text-citrared-500 text-center">
                        {{ session('alert') }}
                    </p>
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-4">
                <form action="{{ route('umkm.purchase.store') }}" method="post">@csrf

                    <div class="w-3/4">
                        <!-- Contact -->
                        <div class="w-1/2">
                            <x-input-label for="contact" :value="__('Supplier')" />
                            <select id="contact"
                                class="w-full border-b-1 border-r-0 border-t-0 border-l-0 border-gray-300 focus:border-citragreen-500 focus:ring-citragreen-500 block mt-1"
                                type="text" name="contact_id">
                                <option hidden value="">Pilih Kontak</option>
                                @foreach ($contacts as $contact)
                                    <option value="{{ $contact->id }}">{{ $contact->name }} ({{ $contact->type }})
                                    </option>
                                @endforeach
                                <option data-modal-target="addContactModal" value="addcontact"
                                    class="text-citragreen-500">
                                    Tambah Kontak
                                </option>

                            </select>
                            <x-input-error :messages="$errors->get('contact')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="flex gap-3 w-4/5">
                            <!-- Status -->
                            <div class="w-full">
                                <x-input-label for="Status" :value="__('Status')" />
                                <select id="Status"
                                    class="border-b-1 border-r-0 border-t-0 border-l-0 border-gray-300 focus:border-citragreen-500 focus:ring-citragreen-500 block mt-1 w-full"
                                    type="text" name="status" required>
                                    <option value="paid">Sudah dibayar</option>
                                    <option value="open">Belum dibayar</option>
                                </select>
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>
                            <!-- Date -->
                            <div class="w-full flex gap-3">
                                <div>
                                    <x-input-label for="date" :value="__('Tanggal')" />
                                    <div class="flex items-center gap-1">
                                        <x-text-input datepicker datepicker-autohide id="date" class="block mt-1"
                                            type="text" name="date" datepicker-format="dd/mm/yyyy"
                                            :value="\Carbon\Carbon::now()->format('d-m-Y')" onchange="setDueDate()" required autocomplete="date"
                                            placeholder="Tanggal" /> <label for="date" class="cursor-pointer">
                                            <i class=" bx bxs-calendar text-citradark-500 text-xl"></i>
                                        </label>
                                    </div>
                                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="due_date" :value="__('Tanggal Jatuh Tempo')" />
                                    <div class="flex items-center gap-1">
                                        <x-text-input datepicker datepicker-autohide id="due_date" class="block mt-1"
                                            type="text" name="due_date" datepicker-format="dd/mm/yyyy"
                                            :value="\Carbon\Carbon::now()->format('d-m-Y')" required autocomplete="due_date" placeholder="Tanggal" />
                                        <label for="due_date" class="cursor-pointer">
                                            <i class=" bx bxs-calendar text-citradark-500 text-xl"></i>
                                        </label>
                                    </div>
                                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-6">

                    <table class="w-full append">
                        <thead>
                            <tr class="font-bold text-left">
                                <th class="p-2">Produk</th>
                                <th class="p-2">Deskripsi</th>
                                <th class="p-2">Jumlah</th>
                                <th class="p-2">Pajak</th>
                                <th class="p-2">Harga</th>
                                <th class="p-2">Subtotal</th>
                                <th class="p-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="p-2">
                                    <select id="product" onchange="setTaxPrice(event, this.value), calculateTotal()"
                                        class="selecttotal border-b-1 border-r-0 border-t-0 border-l-0 border-gray-300 focus:border-citragreen-500 focus:ring-citragreen-500 block"
                                        type="text" name="product_id[]" required>
                                        <option hidden value="">Pilih Produk</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                        <option data-modal-target="addProductModal" value="addproduct"
                                            class="text-citragreen-500">
                                            Tambah Produk
                                        </option>

                                    </select>
                                </td>
                                <td class="p-2">
                                    <x-text-input id="description-1" class="block mt-1 w-full" type="text"
                                        name="description[]" :value="old('description')" autocomplete="description"
                                        placeholder="Deskripsi" />
                                </td>
                                <td class="p-2">
                                    <x-text-input id="quantity-1" class="quantitytotal block mt-1 w-full" type="number"
                                        onchange="calculateTotal()" name="quantity[]" :value="1" required
                                        autocomplete="quantity" placeholder="" />
                                </td>
                                <td class="flex gap-1 items-center p-2">
                                    <x-text-input id="tax-1" class="taxtotal block mt-1 w-full" type="number"
                                        onchange="calculateTotal()" name="tax[]" :value="old('tax')"
                                        autocomplete="tax" placeholder="" />
                                    %
                                </td>
                                <td class="p-2">
                                    <x-text-input id="price-1" class="sumtotal rupiahInput block mt-1 w-full"
                                        type="text" onchange="calculateTotal()" name="price[]" :value="old('price')"
                                        required autocomplete="price" placeholder="Harga" />
                                </td>
                                <td class="p-2">
                                    <x-text-input id="subtotal-1" class="subtotal block mt-1 w-full" type="text"
                                        name="subtotal[]" :value="old('subtotal')" required autocomplete="subtotal"
                                        disabled />
                                </td>
                                {{-- <td class="p-2">
                                <button>
                                    <i class="removebtn bx bx-minus text-lg"></i>
                                </button>
                            </td> --}}
                            </tr>

                            <template id="appendRow">
                                <tr>
                                    <td class="p-2">
                                        <select id="product"
                                            onchange="setTaxPrice(event, this.value), calculateTotal()"
                                            class="selecttotal border-b-1 border-r-0 border-t-0 border-l-0 border-gray-300 focus:border-citragreen-500 focus:ring-citragreen-500 block"
                                            type="text" name="product_id[]" required>
                                            <option hidden value="">Pilih Produk</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="p-2">
                                        <x-text-input id="description-1" class="block mt-1 w-full" type="text"
                                            name="description[]" :value="old('description')" autocomplete="description"
                                            placeholder="Deskripsi" />
                                    </td>
                                    <td class="p-2">
                                        <x-text-input id="quantity-1" class="quantitytotal block mt-1 w-full"
                                            type="number" onchange="calculateTotal()" name="quantity[]"
                                            :value="1" required autocomplete="quantity" placeholder="" />
                                    </td>
                                    <td class="flex gap-1 items-center p-2">
                                        <x-text-input id="tax-1" class="taxtotal block mt-1 w-full"
                                            type="number" onchange="calculateTotal()" name="tax[]"
                                            :value="old('tax')" autocomplete="tax" placeholder="" />
                                        %
                                    </td>
                                    <td class="p-2">
                                        <x-text-input id="price-1" class="sumtotal rupiahInput block mt-1 w-full"
                                            type="text" onchange="calculateTotal()" name="price[]"
                                            :value="old('price')" required autocomplete="price" placeholder="Harga" />
                                    </td>
                                    <td class="p-2">
                                        <x-text-input id="subtotal-1" class="subtotal block mt-1 w-full"
                                            type="text" name="subtotal[]" :value="old('subtotal')" required
                                            autocomplete="subtotal" disabled />
                                    </td>
                                    <td class="p-2">
                                        <button>
                                            <i class="removebtn bx bx-minus text-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>

                    <div class="mt-4">
                        <button type="button"
                            class="appendbtn mt-3 inline-flex items-center px-4 py-1 bg-citradark-500 border border-transparent rounded-md font-bold text-xs text-white hover:bg-citradark-700 focus:bg-citradark-400 active:bg-citradark-600 focus:outline-none focus:ring-2 focus:ring-citradark-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <i class="bx bx-plus text-xl"></i>
                            Tambah Data
                        </button>
                    </div>

                    <div class="mt-10 float-right w-1/2">
                        <div class="flex justify-between items-center">
                            <p class="text-left">Subtotal</p>
                            <p class="text-right" id="subtotal">Rp. 0,-</p>
                        </div>
                        <div id="taxes" class="hidden mt-4 justify-between items-center">
                            <p class="text-left">Pajak</p>
                            <p class="text-right" id="taxtotal">Rp. 0,-</p>
                        </div>

                        <div class="mt-4 flex justify-between items-center">
                            <div class="flex gap-1 items-center">
                                <p class="text-left">Potongan</p>
                                <x-text-input id="cut" class="block mt-1 w-12" type="text"
                                    onchange="calculateTotal()" name="cut" :value="old('cut')" autocomplete="tax"
                                    placeholder="" />
                                %
                            </div>
                            <p class="text-right" id="cuttotal">Rp. 0,-</p>
                        </div>

                        <div class="mt-6 flex justify-between items-center">
                            <h3 class="text-left text-md font-bold">Total</h3>
                            <h3 class="text-right text-2xl font-bold" id="total">Rp. 0,-</h3>
                        </div>


                        <div class="mt-6 float-right">
                            <a href="{{ route('umkm.purchase.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-zinc-200 border border-transparent rounded-md font-bold text-xs text-zinc-500 hover:bg-zinc-300 focus:bg-zinc-400 active:bg-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Batal
                            </a>
                            <x-primary-button type="submit" class="ml-2">
                                Simpan
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add modal -->
    <div id="addContactModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
        <div class="relative w-full h-full max-w-2xl md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t border-zinc-200">
                    <h3 class="text-xl font-bold">
                        Tambah Kontak
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-zinc-200 hover:text-citrablack rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                        onclick="modalhide()" data-modal-hide="addContactModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form action="{{ route('umkm.contact.store') }}" id="addcontact" method="post">@csrf</form>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <div class="flex space-x-16 items-center">
                        <label for="name" class="w-32">Nama</label>
                        <x-text-input form="addcontact" id="name" class="block w-full" type="text"
                            name="name" :value="old('name')" required autocomplete="name" />
                    </div>

                    <div class="flex space-x-16 items-center">
                        <label for="type" class="w-32">Tipe Kontak</label>
                        <div class="flex justify-between w-full">
                            <div class="inline-block">
                                <input form="addcontact" type="radio" name="type" class="accent-citragreen-500"
                                    value="Pelanggan" id="type1">
                                <label for="type1">Pelanggan</label>
                            </div>
                            <div class="inline-block">
                                <input form="addcontact" checked type="radio" name="type"
                                    class="accent-citragreen-500" value="Supplier" id="type2">
                                <label for="type2">Supplier</label>
                            </div>
                            <div class="inline-block">
                                <input form="addcontact" type="radio" name="type" class="accent-citragreen-500"
                                    value="Karyawan" id="type3">
                                <label for="type3">Karyawan</label>
                            </div>
                            <div class="inline-block">
                                <input form="addcontact" type="radio" name="type" class="accent-citragreen-500"
                                    value="Lainnya" id="type4">
                                <label for="type4">Lainnya</label>
                            </div>
                        </div>
                    </div>

                    <div class="flex space-x-16 items-center">
                        <label for="phone" class="w-32">Handphone</label>
                        <x-text-input form="addcontact" id="phone" class="block w-full" type="text"
                            name="phone" :value="old('phone')" autocomplete="phone" />
                    </div>

                    <div class="flex space-x-16 items-center">
                        <label for="email" class="w-32">Email</label>
                        <x-text-input form="addcontact" id="email" class="block w-full" type="text"
                            name="email" :value="old('email')" autocomplete="email" />
                    </div>

                    <div class="flex space-x-16 items-center">
                        <label for="address" class="w-32">Alamat</label>
                        <x-text-input form="addcontact" id="address" class="block w-full" type="text"
                            name="address" :value="old('address')" autocomplete="address" />
                    </div>

                </div>
                <!-- Modal footer -->
                <div class="flex justify-end items-center p-6 space-x-2 border-t border-zinc-200 rounded-b">

                    <button data-modal-hide="addContactModal" type="button" onclick="modalhide()"
                        class="inline-flex items-center px-4 py-2 bg-zinc-200 border border-transparent rounded-md font-bold text-xs text-zinc-500 hover:bg-zinc-300 focus:bg-zinc-400 active:bg-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Batal
                    </button>
                    <x-primary-button form="addcontact" class="ml-2">
                        Simpan
                    </x-primary-button>
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
                    <button type="button" onclick="modalhide()"
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
                            name="name" :value="old('name')" required autocomplete="name" />
                    </div>

                    <div class="flex space-x-16 items-center">
                        <label for="description" class="w-32">Deskripsi</label>
                        <x-text-input form="addproduct" id="description" class="block w-full" type="text"
                            name="description" :value="old('description')" autocomplete="description" />
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
                                    name="harga_beli" :value="old('harga_beli')" autocomplete="harga_beli" />
                                <label for="pajak_beli" class="">Pajak Beli</label>
                                <x-text-input form="addproduct" id="pajak_beli" class="w-1/6 block" type="text"
                                    name="pajak_beli" :value="old('pajak_beli')" autocomplete="pajak_beli" />
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
                                    name="harga_jual" :value="old('harga_jual')" autocomplete="harga_jual" />
                                <label for="pajak_beli" class="">Pajak Jual</label>
                                <x-text-input form="addproduct" id="pajak_jual" class="w-1/6 block" type="text"
                                    name="pajak_jual" :value="old('pajak_jual')" autocomplete="pajak_jual" />
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

                    <button data-modal-hide="addProductModal" type="button" onclick="modalhide()"
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

    <script>
        var productData = JSON.parse(document.getElementById('product-data').getAttribute('data-product-data'));

        // get total of input
        function calculateTotal() {
            var inputs = document.getElementsByClassName("sumtotal");
            var inputTaxs = document.getElementsByClassName("taxtotal");
            var inputCut = document.getElementById("cut");
            var inputQty = document.getElementsByClassName("quantitytotal");
            var total = 0;
            var subtotal = 0;
            var taxtotal = 0;
            var cuttotal = 0;


            for (var i = 0; i < inputs.length; i++) {
                var value = parseFloat(inputs[i].value.replace(/^Rp\.|\s/g, '').replace(/[.,]/g, '')) ||
                    0;
                var quantity = parseFloat(inputQty[i].value || 0);

                subtotal += (value * quantity);

                var tax = value * (parseFloat(inputTaxs[i].value || 0) / 100)
                taxtotal += (tax * quantity);
                total += ((value + tax) * quantity);
            }

            cuttotal = subtotal * (inputCut.value / 100);
            total -= (cuttotal || 0)

            document.getElementById("subtotal").textContent = "Rp. " + subtotal.toLocaleString('id-ID') +
                ",-"; // Atur nilai input total
            document.getElementById("cuttotal").textContent = "Rp. " + cuttotal.toLocaleString('id-ID') +
                ",-"; // Atur nilai input cut

            document.getElementById("total").textContent = "Rp. " + total.toLocaleString('id-ID') +
                ",-"; // Atur nilai input total

            var taxes = document.getElementById('taxes');
            if (taxtotal != 0) {
                taxes.classList.remove('hidden');
                taxes.classList.add("flex");

                document.getElementById('taxtotal').textContent = "Rp. " + taxtotal.toLocaleString('id-ID') +
                    ",-";
            } else {
                document.getElementById('taxtotal').textContent = "Rp. " + taxtotal.toLocaleString('id-ID') +
                    ",-";

                taxes.classList.remove('flex');
                taxes.classList.add("hidden");
            }
        }

        var tbody = document.querySelector(".append tbody")

        // subtotal on each row
        tbody.addEventListener("change", function(event) {
            if (event.target.classList.contains("sumtotal") || event.target.classList.contains("taxtotal") || event
                .target.classList.contains("quantitytotal") || event
                .target.classList.contains("selecttotal")) {
                var tr = event.target.closest("tr");
                var subtotal = tr.querySelector('.subtotal');

                var sumtotal = tr.querySelector('.sumtotal');
                var taxtotal = tr.querySelector('.taxtotal');
                var qtotal = tr.querySelector('.quantitytotal');

                var sumvalue = parseFloat(sumtotal.value.replace(/^Rp\.|\s/g, '').replace(/[.,]/g, ''));
                var subvalue = (sumvalue + ((sumvalue * (taxtotal.value / 100)) || 0)) * qtotal.value;
                subtotal.value = "Rp. " + subvalue.toLocaleString("id-ID") + ",-";
            }
        });

        function setDueDate() {
            // Mendapatkan nilai input tanggal pertama
            var date1 = document.getElementById("date").value;
            var [day1, month1, year1] = date1.split("/");

            // Membuat objek Date baru dengan nilai-nilai tanggal, bulan, dan tahun dari input pertama
            var dateObj1 = new Date(year1, month1 - 1, day1);

            // Mengatur nilai input tanggal kedua dengan nilai satu bulan setelah tanggal pertama
            var dateObj2 = new Date(dateObj1.getFullYear(), dateObj1.getMonth() + 1, dateObj1.getDate());
            var day2 = dateObj2.getDate();
            var month2 = dateObj2.getMonth() + 1;
            var year2 = dateObj2.getFullYear();

            // Mengubah format tampilan tanggal kedua menjadi dd/mm/yyyy
            var formattedDate2 = `${day2 < 10 ? '0'+day2 : day2}/${month2 < 10 ? '0'+month2 : month2}/${year2}`;
            document.getElementById("due_date").value = formattedDate2;
        }

        function setTaxPrice(event, idProduct) {
            if (idProduct != "addproduct" && idProduct != "") {
                var tr = event.target.closest("tr");

                var filteredProduct = productData.filter(function(obj) {
                    return obj.id == idProduct;
                })[0];


                var harga = tr.querySelector(".sumtotal");
                harga.value = "Rp. " + filteredProduct.purchase.price.toLocaleString("id-ID");
                var pajak = tr.querySelector(".taxtotal");
                pajak.value = filteredProduct.purchase.tax;
            }
        }

        function modalhide() {
            document.querySelector("[modal-backdrop]").remove();
        }
    </script>

</x-app-layout>
