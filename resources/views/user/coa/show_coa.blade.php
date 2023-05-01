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
                            <td class="p-3">Kontak</td>
                            <td class="p-3">Faktur</td>
                            <td class="p-3">Debit</td>
                            <td class="p-3">Kredit</td>
                            <td class="p-3 text-center">Saldo</td>
                        </tr>
                        @foreach ($coa->coa_transactions as $ct)
                            <tr class="border border-b-1 border-r-0 border-t-0 border-l-0 border-zinc-400">
                                <td class="p-3">{{ AppHelper::date($ct->transaction->date) ?? '-' }}</td>
                                <td class="p-3">
                                    {{ $ct->transaction->contact->name ?? '-' }}
                                </td>
                                <td class="p-3">{{ $ct->transaction->invoice ?? '-' }}</td>
                                <td class="p-3">{{ AppHelper::rp($ct->debit ?? 0) }}</td>
                                <td class="p-3">{{ AppHelper::rp($ct->credit ?? 0) }}</td>
                                <td class="p-3">{{ AppHelper::rp($ct->currentBalance() ?? 0) }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
