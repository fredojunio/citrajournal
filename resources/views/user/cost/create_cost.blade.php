<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Biaya') }}
        </h2>
    </x-slot>
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
                <form id="addcost" action="{{ route('umkm.cost.store') }}" method="post">@csrf</form>
                <!-- Coa -->
                <div class="">
                    <x-input-label for="type" :value="__('Bayar Dari')" />
                    <select form="addcost" id="type"
                        class="js-example-basic-single border-b-1 border-r-0 border-t-0 border-l-0 border-gray-300 focus:border-citragreen-500 focus:ring-citragreen-500 block mt-1 w-1/4"
                        type="text" name="kas_id" required>
                        @foreach ($kass as $kas)
                            <option value="{{ $kas->id }}">{{ $kas->code }} - {{ $kas->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
                </div>


                <div class="mt-4">
                    <div class="flex gap-3 w-3/4">
                        <!-- Contact -->
                        <div class="w-1/2">
                            <x-input-label for="contact" :value="__('Penerima')" />
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
                        <!-- Date -->
                        <div class="w-1/2">
                            <div>
                                <x-input-label for="date" :value="__('Tanggal')" />
                                <div class="flex items-center gap-1">
                                    <x-text-input form="addcost" datepicker datepicker-autohide id="date"
                                        class="block mt-1" type="text" name="date" datepicker-format="dd/mm/yyyy"
                                        :value="\Carbon\Carbon::now()->format('d-m-Y')" required autocomplete="date" placeholder="Tanggal" /> <label
                                        for="date" class="cursor-pointer" form="addcost">
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
                            <th class="p-2">Kode Akun</th>
                            <th class="p-2">Deskripsi</th>
                            <th class="p-2">Pajak</th>
                            <th class="p-2">Harga</th>
                            <th class="p-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-2">
                                <select form="addcost"
                                    class="js-example-basic-single border-b-1 border-r-0 border-t-0 border-l-0 border-gray-300 focus:border-citragreen-500 focus:ring-citragreen-500 block"
                                    type="text" name="coa_id[]" required>
                                    <option hidden value="">Pilih Akun</option>
                                    @foreach ($coas as $coa)
                                        <option class="text-clip" value="{{ $coa->id }}">{{ $coa->code }} -
                                            {{ $coa->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="p-2">
                                <x-text-input form="addcost" class="block mt-1 w-full" type="text"
                                    name="description[]" :value="old('description')" autocomplete="description"
                                    placeholder="Deskripsi" />
                            </td>
                            <td class="flex gap-1 items-center p-2">
                                <x-text-input form="addcost" class="taxtotal block mt-1 w-20" type="text"
                                    onchange="calculateTotal()" name="tax[]" :value="old('tax')" autocomplete="tax"
                                    placeholder="" />
                                %
                            </td>
                            <td class="p-2">
                                <x-text-input type="text" form="addcost"
                                    class="sumtotal rupiahInput block mt-1 w-full" name="price[]"
                                    onchange="calculateTotal()" :value="old('price')" required autocomplete="price"
                                    placeholder="Harga" />
                            </td>
                            {{-- <td class="p-2">
                                <button class="">
                                    <i class="removebtn bx bx-minus text-lg"></i>
                                </button>
                            </td> --}}
                        </tr>
                        <template id="appendRow">
                            <tr>
                                <td class="p-2">
                                    <select form="addcost"
                                        class="js-example-basic-single border-b-1 border-r-0 border-t-0 border-l-0 border-gray-300 focus:border-citragreen-500 focus:ring-citragreen-500 block"
                                        type="text" name="coa_id[]" required>
                                        <option hidden value="">Pilih Akun</option>
                                        @foreach ($coas as $coa)
                                            <option value="{{ $coa->id }}">
                                                {{ $coa->code }} -
                                                {{ $coa->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="p-2">
                                    <x-text-input form="addcost" class="block mt-1 w-full" type="text"
                                        name="description[]" :value="old('description')" autocomplete="description"
                                        placeholder="Deskripsi" />
                                </td>
                                <td class="flex gap-1 items-center p-2">
                                    <x-text-input form="addcost" class="taxtotal block mt-1 w-20" type="text"
                                        onchange="calculateTotal()" name="tax[]" :value="old('tax')"
                                        autocomplete="tax" placeholder="" />
                                    %
                                </td>
                                <td class="p-2">
                                    <x-text-input type="text" form="addcost"
                                        class="sumtotal rupiahInput block mt-1 w-full" onchange="calculateTotal()"
                                        name="price[]" :value="old('price')" required autocomplete="price"
                                        placeholder="Harga" />
                                </td>
                                <td class="p-2">
                                    <button class="">
                                        <i class="removebtn bx bx-minus text-lg"></i>
                                    </button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>

                <div class="mt-4">
                    <button
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
                        <a href="{{ route('umkm.kas.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-zinc-200 border border-transparent rounded-md font-bold text-xs text-zinc-500 hover:bg-zinc-300 focus:bg-zinc-400 active:bg-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Batal
                        </a>
                        <x-primary-button form="addcost" class="ml-2">
                            Simpan
                        </x-primary-button>
                    </div>
                </div>

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
                                <input form="addcontact" type="radio" name="type" class="accent-citragreen-500"
                                    value="Supplier" id="type2">
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

    <script>
        // get total of input
        function calculateTotal() {
            var inputs = document.getElementsByClassName("sumtotal");
            var inputTaxs = document.getElementsByClassName("taxtotal");
            var inputCut = document.getElementById("cut");
            var total = 0;
            var subtotal = 0;
            var taxtotal = 0;
            var cuttotal = 0;


            for (var i = 0; i < inputs.length; i++) {
                var value = parseFloat(inputs[i].value.replace(/^Rp\.|\s/g, '').replace(/[.,]/g, '')) ||
                    0;

                subtotal += value;

                var tax = value * (parseFloat(inputTaxs[i].value || 0) / 100)
                taxtotal += tax;
                total += value + tax;
            }

            cuttotal = subtotal * (inputCut.value / 100);
            total -= (cuttotal || 0);

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

        function modalhide() {
            document.querySelector("[modal-backdrop]").remove();
        }
    </script>


</x-app-layout>
