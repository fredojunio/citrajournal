<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pembelian') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex gap-4">
                <!-- Pemasukan -->
                <div class="bg-white shadow-sm sm:rounded-md p-4">
                    <div class="flex items-center gap-2">
                        <div class="bg-citradark-100 rounded-full w-14 h-14 flex justify-items-center items-center">
                            <i class="text-citradark-500 bx bxs-cart text-3xl m-auto"></i>
                        </div>
                        <div>
                            <p class="">Pembelian Terbayar 30 Hari Terakhir</p>
                            <h2 class="text-2xl font-bold">
                                {{ AppHelper::rp($purchaseMonth->where('status', 'paid')->sum('total')) }}
                            </h2>
                        </div>
                    </div>
                </div>

                <!-- Penjualan belum bayar -->
                <div class="bg-white shadow-sm sm:rounded-md p-4">
                    <div class="flex items-center gap-2">
                        <div class="bg-citrared-100 rounded-full w-14 h-14 flex justify-items-center items-center">
                            <i class="text-citrared-500 bx bxs-credit-card text-3xl m-auto"></i>
                        </div>
                        <div>
                            <p class="">Pembelian Belum Dibayar</p>
                            <h2 class="text-2xl font-bold">
                                {{ AppHelper::rp($purchases->where('status', '!=', 'paid')->sum('total')) }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="px-4 pt-4 pb-24">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold">Daftar Pembelian</h2>
                        <a href="{{ route('umkm.purchase.create') }}"
                            class="mt-3 inline-flex items-center px-4 py-1 bg-citradark-500 border border-transparent rounded-md font-bold text-xs text-white hover:bg-citradark-700 focus:bg-citradark-400 active:bg-citradark-600 focus:outline-none focus:ring-2 focus:ring-citradark-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <i class="bx bx-plus text-xl"></i>
                            Tambah Pembelian
                        </a>
                    </div>

                    <table class="mt-4 w-full border-collapse">
                        <tr
                            class="text-zinc-400 font-bold border border-b-1 border-r-0 border-t-0 border-l-0 border-zinc-400">
                            <td class="p-3">Tanggal
                            </td>
                            <td class="p-3">Faktur
                            </td>
                            <td class="p-3">Status
                            </td>
                            <td class="p-3">Supplier
                            </td>
                            <td class="p-3">Tgl Jatuh Tempo
                            </td>
                            <td class="p-3">Sisa Tagihan
                            </td>
                            <td class="p-3">Total
                            </td>
                            <td class="p-3 text-center">Tindakan</td>
                        </tr>
                        @foreach ($purchases as $purchase)
                            <tr class="border border-b-1 border-r-0 border-t-0 border-l-0 border-zinc-400">
                                <td class="p-3">{{ AppHelper::date($purchase->date) }}</td>
                                <td class="p-3">
                                    <a href="{{ route('umkm.purchase.show', $purchase->id) }}"
                                        class="text-citradark-500 hover:text-citragreen-500 underline">
                                        {{ $purchase->invoice }}
                                    </a>
                                </td>
                                <td
                                    class="p-3 {{ $purchase->status == 'paid' ? 'text-citragreen-500' : 'text-citrayellow-500' }}">
                                    {{ $purchase->status == 'paid' ? 'Sudah Bayar' : 'Belum Bayar' }}
                                </td>
                                <td class="p-3">{{ $purchase->contact->name ?? '' }}</td>
                                <td class="p-3">{{ AppHelper::date($purchase->due_date) }}</td>
                                <td class="p-3">{{ AppHelper::rp($purchase->remaining_bill ?? 0) }}</td>
                                <td class="p-3">{{ AppHelper::rp($purchase->total ?? 0) }}</td>
                                <td class="p-3 text-center">
                                    <x-dropdown align="left" width="48">
                                        <x-slot name="trigger">
                                            <button>
                                                <i class="bx bx-dots-horizontal-rounded text-xl"></i>
                                            </button>
                                        </x-slot>

                                        <x-slot name="content">
                                            @if ($purchase->status != 'paid')
                                                <x-dropdown-link data-modal="payModal-{{ $loop->iteration }}"
                                                    data-modal-toggle="payModal-{{ $loop->iteration }}"
                                                    class="cursor-pointer">
                                                    {{ __('Lunasi') }}
                                                </x-dropdown-link>
                                            @endif
                                            <x-dropdown-link :href="route('umkm.purchase.edit', $purchase->id)">
                                                {{ __('Edit') }}
                                            </x-dropdown-link>
                                            <x-dropdown-link data-modal="deletePurchaseModal-{{ $loop->iteration }}"
                                                data-modal-toggle="deletePurchaseModal-{{ $loop->iteration }}"
                                                class="text-citrared-500 cursor-pointer">
                                                {{ __('Hapus') }}
                                            </x-dropdown-link>
                                        </x-slot>
                                    </x-dropdown>
                                </td>
                            </tr>

                            <!-- Pay modal -->
                            <div id="payModal-{{ $loop->iteration }}" tabindex="-1" aria-hidden="true"
                                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                <div class="relative w-full h-full max-w-2xl md:h-auto">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-start justify-between p-4 border-b rounded-t border-zinc-200">
                                            <h3 class="text-xl font-bold">
                                                Kirim Pembayaran - {{ $purchase->invoice }}
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-zinc-200 hover:text-citrablack rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                                data-modal-hide="payModal-{{ $loop->iteration }}">
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
                                        <div class="p-6 space-y-6">
                                            <form action="{{ route('umkm.purchase.partial_payment') }}"
                                                id="partial_payment-{{ $loop->iteration }}" method="post">
                                                @csrf
                                                <div class="flex space-x-16 items-center">
                                                    <label for="date-{{ $loop->iteration }}"
                                                        class="w-32">Tanggal</label>
                                                    <div class="flex items-center gap-1">
                                                        <x-text-input datepicker datepicker-autohide
                                                            id="date-{{ $loop->iteration }}" class="block"
                                                            type="text" name="date" datepicker-format="dd/mm/yyyy"
                                                            :value="\Carbon\Carbon::now()->format('d-m-Y')" required autofocus autocomplete="date"
                                                            placeholder="Tanggal" /> <label
                                                            for="date-{{ $loop->iteration }}" class="cursor-pointer">
                                                            <i class=" bx bxs-calendar text-citradark-500 text-xl"></i>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="flex space-x-16 items-center">
                                                    <label for="total-{{ $loop->iteration }}"
                                                        class="w-32">Nominal</label>
                                                    <x-text-input 
                                                        id="total-{{ $loop->iteration }}" class="block w-full"
                                                        type="text" name="total" :value="$purchase->total" required
                                                        autofocus autocomplete="total" />
                                                </div>
                                                <input type="hidden" name="transaction_id"
                                                    value="{{ $purchase->id }}" id="">
                                            </form>
                                        </div>
                                        <div
                                            class="flex justify-end items-center p-6 space-x-2 border-t border-zinc-200 rounded-b">
                                            <button data-modal-hide="payModal-{{ $loop->iteration }}" type="button"
                                                class="inline-flex items-center px-4 py-2 bg-zinc-200 border border-transparent rounded-md font-bold text-xs text-zinc-500 hover:bg-zinc-300 focus:bg-zinc-400 active:bg-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                Batal
                                            </button>

                                            <x-primary-button type="submit" form="partial_payment-{{ $loop->iteration }}" class="ml-2">
                                                Bayar
                                            </x-primary-button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete modal -->
                            <div id="deletePurchaseModal-{{ $loop->iteration }}" tabindex="-1" aria-hidden="true"
                                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                <div class="relative w-full h-full max-w-2xl md:h-auto">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-start justify-between p-4 border-b rounded-t border-zinc-200">
                                            <h3 class="text-xl font-bold">
                                                Hapus Pembelian
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-zinc-200 hover:text-citrablack rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                                data-modal-hide="deletePurchaseModal-{{ $loop->iteration }}">
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
                                                <button data-modal-hide="deletePurchaseModal-{{ $loop->iteration }}"
                                                    type="button"
                                                    class="inline-flex items-center px-4 py-2 bg-zinc-200 border border-transparent rounded-md font-bold text-xs text-zinc-500 hover:bg-zinc-300 focus:bg-zinc-400 active:bg-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                    Batal
                                                </button>
                                                <form action="{{ route('umkm.purchase.destroy', $purchase->id) }}"
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
                        {{ $purchases->links('vendor.pagination.default') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
