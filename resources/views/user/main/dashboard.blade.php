<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dasbor') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-10">
                    <div class="flex flex-col items-center">
                        <img src="{{ asset('images/assets/empty_state.svg') }}" class="w-44" alt="">
                        <div class="mt-3">
                            <h3 class="text-center font-bold text-lg">Anda belum memiliki catatan keuangan apapun</h3>
                            <p class="text-center mt-2">Mulai mengatur konfigurasi invoice pertama anda.</p>
                        </div>
                        <a href=""
                            class="mt-3 inline-flex items-center px-4 py-2 bg-citradark-500 border border-transparent rounded-md font-bold text-xs text-white hover:bg-citradark-700 focus:bg-citradark-400 active:bg-citradark-600 focus:outline-none focus:ring-2 focus:ring-citradark-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Tambah Transaksi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
