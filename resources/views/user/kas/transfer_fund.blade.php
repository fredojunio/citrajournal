<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaksi - Pemindahan Dana') }}
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
            <form action="{{ route('umkm.transfer_fund.store') }}" method="post">
                @csrf
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-4">
                    <form id="receive" action="{{ route('umkm.receive_money.store') }}" method="post">@csrf</form>
                    <!-- Coa -->
                    <div class="flex gap-3">
                        <div class="">
                            <x-input-label for="type" :value="__('Pindah Dana Dari')" />
                            <select id="type"
                                class="border-b-1 border-r-0 border-t-0 border-l-0 border-gray-300 focus:border-citragreen-500 focus:ring-citragreen-500 block mt-1 w-full"
                                type="text" name="kas_id" required>
                                @foreach ($kass as $kas)
                                    <option value="{{ $kas->id }}">{{ $kas->code }} - {{ $kas->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>
                        <div class="">
                            <x-input-label for="to_kas" :value="__('Pindah Dana Ke')" />
                            <select id="to_kas"
                                class="border-b-1 border-r-0 border-t-0 border-l-0 border-gray-300 focus:border-citragreen-500 focus:ring-citragreen-500 block mt-1 w-full"
                                type="text" name="to_kas_id" required>
                                <option hidden value="{{ $kass[1]->id }}">{{ $kass[1]->code }} - {{ $kass[1]->name }}
                                </option>
                                @foreach ($kass as $kas)
                                    <option value="{{ $kas->id }}">{{ $kas->code }} - {{ $kas->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-4 flex gap-3">
                        <div>
                            <x-input-label for="total" :value="__('Jumlah Dana')" />
                            <x-text-input class="rupiahInput block mt-1 w-full" type="text" name="total"
                                :value="old('total')" autofocus autocomplete="total" placeholder="Rp. 0" required />
                        </div>
                        <div>
                            <x-input-label for="description" :value="__('Catatan')" />
                            <x-text-input class="block mt-1 w-full" type="text" name="description" :value="old('description')"
                                autofocus autocomplete="description" placeholder="" />
                        </div>
                        <div>
                            <x-input-label for="date" :value="__('Tanggal')" />
                            <div class="flex items-center gap-1">
                                <x-text-input datepicker datepicker-autohide id="date" class="block mt-1 w-1/2"
                                    type="text" name="date" datepicker-format="dd/mm/yyyy" :value="\Carbon\Carbon::now()->format('d-m-Y')"
                                    required autofocus autocomplete="date" placeholder="Tanggal" />
                                <label for="date" class="cursor-pointer">
                                    <i class=" bx bxs-calendar text-citradark-500 text-xl"></i>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-16 float-right">
                        <a href="{{ route('umkm.kas.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-zinc-200 border border-transparent rounded-md font-bold text-xs text-zinc-500 hover:bg-zinc-300 focus:bg-zinc-400 active:bg-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Batal
                        </a>
                        <x-primary-button class="ml-2">
                            Simpan
                        </x-primary-button>
                    </div>

                </div>
            </form>
        </div>
    </div>


</x-app-layout>
