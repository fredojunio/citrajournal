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
                            <p class="">Total pembelian bulan ini</p>
                            <h2 class="text-2xl font-bold">
                                Rp. xxx.xxx.xxx,-
                            </h2>
                        </div>
                    </div>
                </div>

                <!-- Saldo -->
                <div class="bg-white shadow-sm sm:rounded-md p-4">
                    <div class="flex items-center gap-2">
                        <div class="bg-citrared-100 rounded-full w-14 h-14 flex justify-items-center items-center">
                            <i class="text-citrared-500 bx bxs-credit-card text-3xl m-auto"></i>
                        </div>
                        <div>
                            <p class="">Penjualan belum dibayar</p>
                            <h2 class="text-2xl font-bold">
                                Rp. xxx.xxx.xxx,-
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="px-4 pt-4 pb-24">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold">Daftar Penjualan</h2>
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
                            <td class="p-3">Total
                            </td>
                            <td class="p-3 text-center">Tindakan</td>
                        </tr>
                        <tr class="border border-b-1 border-r-0 border-t-0 border-l-0 border-zinc-400">
                            <td class="p-3">dd/mm/yy</td>
                            <td class="p-3">Faktur pembelian #10001</td>
                            <td class="p-3">xx</td>
                            <td class="p-3">xx</td>
                            <td class="p-3">dd/mm/yy</td>
                            <td class="p-3">Rp. xxx.xxx,-</td>
                            <td class="p-3 text-center">
                                <x-dropdown align="left" width="48">
                                    <x-slot name="trigger">
                                        <button>
                                            <i class="bx bx-dots-horizontal-rounded text-xl"></i>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('umkm.kas.edit', 0)">
                                            {{ __('Edit') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link class="text-red-500">
                                            {{ __('Delete') }}
                                        </x-dropdown-link>
                                    </x-slot>
                                </x-dropdown>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
