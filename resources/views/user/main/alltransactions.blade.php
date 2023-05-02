<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Transaksi') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-4">
                <h3 class="font-bold text-lg">Tentukan Periode Transaksi</h3>
                <div class="mt-4 flex justify-between items-center">
                    <form action="{{ route('umkm.alltransactions') }}" method="get">
                        <div class="flex gap-5 items-center">
                            <div>
                                <x-input-label for="date" :value="__('Tanggal Awal')" />
                                <div class="flex items-center gap-1">
                                    <x-text-input datepicker datepicker-autohide id="date" class="block mt-1"
                                        type="text" name="date" datepicker-format="dd/mm/yyyy" :value="empty($date)
                                            ? \Carbon\Carbon::now()
                                                ->startOfMonth()
                                                ->format('d-m-Y')
                                            : $date"
                                        required autocomplete="date" />
                                    <label for="date" class="cursor-pointer">
                                        <i class=" bx bxs-calendar text-citradark-500 text-xl"></i>
                                    </label>
                                </div>
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="due_date" :value="__('Tanggal Akhir')" />
                                <div class="flex items-center gap-1">
                                    <x-text-input datepicker datepicker-autohide id="due_date" class="block mt-1"
                                        type="text" name="due_date" datepicker-format="dd/mm/yyyy" :value="empty($due_date)
                                            ? \Carbon\Carbon::now()->format('d-m-Y')
                                            : $due_date"
                                        required autocomplete="due_date" />
                                    <label for="due_date" class="cursor-pointer">
                                        <i class=" bx bxs-calendar text-citradark-500 text-xl"></i>
                                    </label>
                                </div>
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>
                            <x-primary-button class="ml-2">
                                Filter
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
            @isset($transactions)
                <div class="mt-4 bg-white overflow-hidden shadow-md sm:rounded-lg">
                    <div class="px-4 pt-4 pb-24">

                        <table class="mt-4 w-full border-collapse">
                            <tr
                                class="text-zinc-400 font-bold border border-b-1 border-r-0 border-t-0 border-l-0 border-zinc-400">
                                <td class="p-3">Tanggal</td>
                                <td class="p-3">Faktur</td>
                                <td class="p-3">Kontak</td>
                                <td class="p-3">Status</td>
                                <td class="p-3">Sisa Tagihan</td>
                                <td class="p-3">Total</td>
                            </tr>
                            @foreach ($transactions as $t)
                                <tr class="border border-b-1 border-r-0 border-t-0 border-l-0 border-zinc-400">
                                    <td class="p-3">{{ AppHelper::date($t->date) ?? '-' }}</td>
                                    <td class="p-3">
                                        <a href="{{ route('umkm.showtransaction', $t->id) }}"
                                            class="text-citradark-500 hover:text-citragreen-500 underline">
                                            {{ $t->invoice ?? '-' }}
                                        </a>
                                    </td>
                                    <td class="p-3">{{ $t->contact->name ?? '-' }}</td>
                                    <td class="p-3">{{ $t->status ?? '-' }}</td>
                                    <td class="p-3">{{ AppHelper::rp($t->remaining_bill ?? 0) }}</td>
                                    <td class="p-3">{{ AppHelper::rp($t->total ?? 0) }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            @endisset

        </div>
    </div>

</x-app-layout>
