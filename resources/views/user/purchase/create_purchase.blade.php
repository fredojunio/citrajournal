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
                <form id="receive" action="{{ route('umkm.purchase.store') }}" method="post">@csrf

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
                                            :value="\Carbon\Carbon::now()->format('d-m-Y')" onchange="setDueDate()" required autofocus
                                            autocomplete="date" placeholder="Tanggal" /> <label for="date"
                                            class="cursor-pointer">
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
                                            :value="\Carbon\Carbon::now()->format('d-m-Y')" required autofocus autocomplete="due_date"
                                            placeholder="Tanggal" />
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
                                    <select id="product-1" onchange="setTaxPrice(event, this.value), calculateTotal()"
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
                                        name="description[]" :value="old('description')" autofocus autocomplete="description"
                                        placeholder="Deskripsi" />
                                </td>
                                <td class="p-2">
                                    <x-text-input id="quantity-1" class="quantitytotal block mt-1 w-full" type="number"
                                        onchange="calculateTotal()" name="quantity[]" :value="1" required
                                        autofocus autocomplete="quantity" placeholder="" />
                                </td>
                                <td class="flex gap-1 items-center p-2">
                                    <x-text-input id="tax-1" class="taxtotal block mt-1 w-full" type="number"
                                        onchange="calculateTotal()" name="tax[]" :value="old('tax')" autofocus
                                        autocomplete="tax" placeholder="" />
                                    %
                                </td>
                                <td class="p-2">
                                    <x-text-input id="price-1" class="sumtotal rupiahInput block mt-1 w-full"
                                        type="text" onchange="calculateTotal()" name="price[]" :value="old('price')"
                                        required autofocus autocomplete="price" placeholder="Harga" />
                                </td>
                                <td class="p-2">
                                    <x-text-input id="subtotal-1" class="subtotal block mt-1 w-full" type="text"
                                        name="subtotal[]" :value="old('subtotal')" required autofocus
                                        autocomplete="subtotal" disabled />
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
                                        <select id="product-1"
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
                                            name="description[]" :value="old('description')" autofocus
                                            autocomplete="description" placeholder="Deskripsi" />
                                    </td>
                                    <td class="p-2">
                                        <x-text-input id="quantity-1" class="quantitytotal block mt-1 w-full"
                                            type="number" onchange="calculateTotal()" name="quantity[]"
                                            :value="1" required autofocus autocomplete="quantity"
                                            placeholder="" />
                                    </td>
                                    <td class="flex gap-1 items-center p-2">
                                        <x-text-input id="tax-1" class="taxtotal block mt-1 w-full"
                                            type="number" onchange="calculateTotal()" name="tax[]"
                                            :value="old('tax')" autofocus autocomplete="tax" placeholder="" />
                                        %
                                    </td>
                                    <td class="p-2">
                                        <x-text-input id="price-1" class="sumtotal rupiahInput block mt-1 w-full"
                                            type="text" onchange="calculateTotal()" name="price[]"
                                            :value="old('price')" required autofocus autocomplete="price"
                                            placeholder="Harga" />
                                    </td>
                                    <td class="p-2">
                                        <x-text-input id="subtotal-1" class="subtotal block mt-1 w-full"
                                            type="text" name="subtotal[]" :value="old('subtotal')" required autofocus
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
                                    onchange="calculateTotal()" name="cut" :value="old('cut')" autofocus
                                    autocomplete="tax" placeholder="" />
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
            var tr = event.target.closest("tr");

            var filteredProduct = productData.filter(function(obj) {
                return obj.id == idProduct;
            })[0];


            console.log(filteredProduct);

            var harga = tr.querySelector(".sumtotal");
            harga.value = "Rp. " + filteredProduct.purchase.price.toLocaleString("id-ID");
            var pajak = tr.querySelector(".taxtotal");
            pajak.value = filteredProduct.purchase.tax;
        }
    </script>

</x-app-layout>
