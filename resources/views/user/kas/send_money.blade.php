<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaksi - Kirim Uang') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-4">
                <form id="sendmoney" action="{{ route('umkm.send_money.store') }}" method="post">@csrf</form>
                <!-- Coa -->
                <div class="">
                    <x-input-label for="type" :value="__('Bayar Dari')" />
                    <select form="sendmoney" id="type"
                        class="border-b-1 border-r-0 border-t-0 border-l-0 border-gray-300 focus:border-citragreen-500 focus:ring-citragreen-500 block mt-1 w-1/4"
                        type="text" name="kas_id" required>
                        @foreach ($kass as $kas)
                            <option value="{{ $kas->id }}">{{ $kas->code }} - {{ $kas->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <div class="flex gap-3 w-1/2">
                        <!-- Penerima -->
                        <div class="w-1/2">
                            <x-input-label for="contact" :value="__('Penerima')" />
                            <select form="sendmoney" id="contact"
                                class="border-b-1 border-r-0 border-t-0 border-l-0 border-gray-300 focus:border-citragreen-500 focus:ring-citragreen-500 block mt-1 w-full"
                                type="text" name="contact_id">
                                <option hidden value="">Pilih Penerima</option>
                                @foreach ($contacts as $contact)
                                    <option value="{{ $contact->id }}">{{ $contact->name }} ({{ $contact->type }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>
                        <!-- Date -->
                        <div>
                            <x-input-label for="date" :value="__('Tanggal')" />
                            <div class="flex items-center gap-1">
                                <x-text-input form="sendmoney" datepicker datepicker-autohide id="date"
                                    class="block mt-1 w-1/2" type="text" name="date"
                                    datepicker-format="dd/mm/yyyy" :value="\Carbon\Carbon::now()->format('d-m-Y')" required autofocus
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
                                <select form="sendmoney"
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
                                <x-text-input form="sendmoney" class="block mt-1 w-full" type="text"
                                    name="description[]" :value="old('description')" autofocus autocomplete="description"
                                    placeholder="Deskripsi" />
                            </td>
                            <td class="flex gap-1 items-center p-2">
                                <x-text-input form="sendmoney" class="taxtotal block mt-1 w-20" type="text"
                                    onchange="calculateTotal()" name="tax[]" :value="old('tax')" autofocus
                                    autocomplete="tax" placeholder="" />
                                %
                            </td>
                            <td class="p-2">
                                <x-text-input type="text" form="sendmoney"
                                    class="sumtotal rupiahInput block mt-1 w-full" name="price[]"
                                    onchange="calculateTotal()" :value="old('price')" required autofocus
                                    autocomplete="price" placeholder="Harga" />
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
                                    <select form="sendmoney"
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
                                    <x-text-input form="sendmoney" class="block mt-1 w-full" type="text"
                                        name="description[]" :value="old('description')" autofocus autocomplete="description"
                                        placeholder="Deskripsi" />
                                </td>
                                <td class="flex gap-1 items-center p-2">
                                    <x-text-input form="sendmoney" class="taxtotal block mt-1 w-20" type="text"
                                        onchange="calculateTotal()" name="tax[]" :value="old('tax')" autofocus
                                        autocomplete="tax" placeholder="" />
                                    %
                                </td>
                                <td class="p-2">
                                    <x-text-input type="text" form="sendmoney"
                                        class="sumtotal rupiahInput block mt-1 w-full" onchange="calculateTotal()"
                                        name="price[]" :value="old('price')" required autofocus autocomplete="price"
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
                    <div class="mt-4 flex justify-between items-center">
                        <div class="flex gap-1 items-center">
                            <p class="text-left">Potongan</p>
                            <x-text-input id="cut" form="sendmoney" class="block mt-1 w-12" type="text"
                                onchange="calculateTotal()" name="cut" :value="old('cut')" autofocus
                                autocomplete="tax" placeholder="" />
                            %
                        </div>
                        <p class="text-right" id="cuttotal">Rp. 0,-</p>
                    </div>
                    <div id="taxes" class="hidden mt-4 justify-between items-center">
                        <p class="text-left">Pajak</p>
                        <p class="text-right" id="taxtotal">Rp. 0,-</p>
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
                        <x-primary-button form="sendmoney" class="ml-2">
                            Simpan
                        </x-primary-button>
                    </div>
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
    </script>


</x-app-layout>
