<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Transaksi - ' . $transaction->invoice) }}
        </h2>
    </x-slot>


    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-4">

                <div class="w-full flex justify-between">
                    <!-- Contact -->
                    <div class="">
                        <x-input-label for="contact" :value="__('Penerima')" />
                        <p>{{ $transaction->contact->name ?? '-' }}</p>
                    </div>
                    <!-- Status -->
                    <div class="text-right">
                        <x-input-label for="Status" :value="__('Status')" />
                        <h1
                            class="{{ $transaction->status == 'paid' ? 'text-citragreen-500' : 'text-citrayellow-500' }} font-bold text-3xl">
                            {{ $transaction->status == 'paid' ? 'Sudah dibayar' : 'Belum dibayar' }}</h1>
                    </div>
                </div>

                <div class="mt-4">
                    <!-- Date -->
                    <div>
                        <x-input-label for="date" :value="__('Tanggal')" />
                        <p>{{ $transaction->date }}</p>
                    </div>
                </div>

                <hr class="my-6">

                <h3 class="text-lg mb-6 font-bold">
                    Detail Transaksi
                </h3>

                <table class="w-full append">
                    <thead>
                        <tr class="font-bold text-left">
                            <th class="p-2">Kode Akun</th>
                            <th class="p-2">Deskripsi</th>
                            <th class="p-2">Pajak</th>
                            <th class="p-2">Harga</th>
                            <th class="p-2">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaction->details as $td)
                            <tr>
                                <td class="p-2">
                                    {{ $td->coa->name }}
                                </td>
                                <td class="p-2">
                                    {{ $td->description ?? '-' }}
                                </td>
                                <td class="flex gap-1 items-center p-2">
                                    {{ $td->tax }}%
                                </td>
                                <td class="p-2">
                                    {{ AppHelper::rp($td->price) }}
                                </td>
                                <td class="p-2">
                                    {{ AppHelper::rp($td->price + ($td->price * $td->tax) / 100) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-10 float-right w-1/2">
                    <div class="flex justify-between items-center">
                        <p class="text-left">Subtotal</p>
                        <p class="text-right" id="subtotal">{{ AppHelper::rp($transaction->subtotal) }}</p>
                    </div>
                    <div id="taxes" class="flex mt-4 justify-between items-center">
                        <p class="text-left">Pajak</p>
                        <p class="text-right" id="taxtotal">{{ AppHelper::rp($transaction->taxtotal) }}</p>
                    </div>

                    <div class="mt-4 flex justify-between items-center">
                        <div class="flex gap-1 items-center">
                            <p class="text-left">Potongan</p>
                            <p>
                                {{ $transaction->cut }}%
                            </p>
                        </div>
                        <p class="text-right" id="cuttotal">{{ AppHelper::rp($transaction->cuttotal) }}</p>
                    </div>

                    <div class="mt-6 flex justify-between items-center">
                        <h3 class="text-left text-md font-bold">Total</h3>
                        <h3 class="text-right text-2xl font-bold" id="total">
                            {{ AppHelper::rp($transaction->total) }}</h3>
                    </div>


                    <div class="mt-6 float-right">
                        <a href="javascript:history.back()"
                            class="inline-flex items-center px-4 py-2 bg-zinc-200 border border-transparent rounded-md font-bold text-xs text-zinc-500 hover:bg-zinc-300 focus:bg-zinc-400 active:bg-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Kembali
                        </a>
                        {{-- <form class="inline-flex ml-2" action="{{ route('umkm.purchase.edit', $transaction->id) }}"
                            method="get">
                            <x-primary-button type="submit">
                                Ubah
                            </x-primary-button>
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
