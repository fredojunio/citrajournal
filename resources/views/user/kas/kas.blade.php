<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kas') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex gap-4">
                <!-- Pemasukan -->
                {{-- <div class="bg-white shadow-sm sm:rounded-md p-4">
                    <div class="flex items-center gap-2">
                        <div class="bg-citragreen-100 rounded-full w-14 h-14 flex justify-items-center items-center">
                            <i class="text-citragreen-500 bx bxs-bar-chart-alt-2 text-3xl m-auto"></i>
                        </div>
                        <div>
                            <p class="">Pemasukan kas bulan ini</p>
                            <h2 class="text-2xl font-bold">
                                Rp. xxx.xxx.xxx,-
                            </h2>
                        </div>
                    </div>
                </div> --}}

                <!-- Saldo -->
                <div class="bg-white shadow-sm sm:rounded-md p-4">
                    <div class="flex items-center gap-2">
                        <div class="bg-citradark-100 rounded-full w-14 h-14 flex justify-items-center items-center">
                            <i class="text-citradark-500 bx bxs-credit-card text-3xl m-auto"></i>
                        </div>
                        <div>
                            <p class="">Saldo kas</p>
                            <h2 class="text-2xl font-bold">
                                {{ AppHelper::rp($kass->map->balance()->sum()) }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="px-4 pt-4 pb-24">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold">Daftar Akun Kas</h2>
                        <x-dropdown>
                            <x-slot name="trigger">
                                <button
                                    class="mt-3 inline-flex items-center px-4 py-1 bg-citradark-500 border border-transparent rounded-md font-bold text-xs text-white hover:bg-citradark-700 focus:bg-citradark-400 active:bg-citradark-600 focus:outline-none focus:ring-2 focus:ring-citradark-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <i class="bx bx-plus text-xl"></i>
                                    Tambah Transaksi
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('umkm.kas.send_money')">
                                    {{ __('Kirim Uang') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('umkm.kas.transfer_fund')">
                                    {{ __('Pemindahan Dana') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('umkm.kas.receive_money')">
                                    {{ __('Terima Uang') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <table class="mt-4 w-full border-collapse">
                        <tr
                            class="text-zinc-400 font-bold border border-b-1 border-r-0 border-t-0 border-l-0 border-zinc-400">
                            <td class="p-3">Kode Akun</td>
                            <td class="p-3">Nama Akun</td>
                            <td class="p-3">Saldo</td>
                        </tr>
                        @foreach ($kass as $kas)
                            <tr class="border border-b-1 border-r-0 border-t-0 border-l-0 border-zinc-400">
                                <td class="p-3">{{ $kas->code }}</td>
                                <td class="p-3">{{ $kas->name }}</td>
                                <td class="p-3">{{ AppHelper::rp($kas->balance() ?? 0) }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
