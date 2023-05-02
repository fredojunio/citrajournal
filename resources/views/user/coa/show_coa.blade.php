<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('(' . $coa->code . ') ' . $coa->name) }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="px-4 pt-4 pb-24">

                    <table class="mt-4 w-full border-collapse">
                        <tr
                            class="text-zinc-400 font-bold border border-b-1 border-r-0 border-t-0 border-l-0 border-zinc-400">
                            <td class="p-3">Tanggal</td>
                            <td class="p-3">Faktur</td>
                            <td class="p-3">Kontak</td>
                            <td class="p-3">Debit</td>
                            <td class="p-3">Kredit</td>
                            <td class="p-3 text-center">Saldo</td>
                        </tr>
                        @foreach ($coa->coa_transactions as $ct)
                            <tr class="border border-b-1 border-r-0 border-t-0 border-l-0 border-zinc-400">
                                <td class="p-3">{{ AppHelper::date($ct->transaction->date) ?? '-' }}</td>
                                <td class="p-3">
                                    <a href="{{ route('umkm.showtransaction', $ct->transaction->id) }}"
                                        class="text-citradark-500 hover:text-citragreen-500 underline">
                                        {{ $ct->transaction->invoice ?? '-' }}
                                    </a>
                                </td>
                                <td class="p-3">{{ $ct->transaction->contact->name ?? '-' }}</td>
                                <td class="p-3">{{ AppHelper::rp($ct->debit ?? 0) }}</td>
                                <td class="p-3">{{ AppHelper::rp($ct->credit ?? 0) }}</td>
                                <td class="p-3">{{ AppHelper::rp($ct->currentBalance() ?? 0) }}</td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="mt-6 float-right">
                        <a href="javascript:history.back()"
                            class="inline-flex items-center px-4 py-2 bg-zinc-200 border border-transparent rounded-md font-bold text-xs text-zinc-500 hover:bg-zinc-300 focus:bg-zinc-400 active:bg-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
