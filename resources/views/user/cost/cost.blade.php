<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Biaya') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex gap-4">
                <!-- Pemasukan -->
                <div class="bg-white shadow-sm sm:rounded-md p-4">
                    <div class="flex items-center gap-2">
                        <div class="bg-citradark-100 rounded-full w-14 h-14 flex justify-items-center items-center">
                            <i class="text-citradark-500 bx bx-money text-3xl m-auto"></i>
                        </div>
                        <div>
                            <p class="">Total Biaya 30 Hari Terakhir</p>
                            <h2 class="text-2xl font-bold">
                                {{ AppHelper::rp($costMonth->sum('total')) }}
                            </h2>
                        </div>
                    </div>
                </div>

                <!-- Saldo -->
                {{-- <div class="bg-white shadow-sm sm:rounded-md p-4">
                    <div class="flex items-center gap-2">
                        <div class="bg-citrared-100 rounded-full w-14 h-14 flex justify-items-center items-center">
                            <i class="text-citrared-500 bx bxs-credit-card text-3xl m-auto"></i>
                        </div>
                        <div>
                            <p class="">Biaya belum terbayar</p>
                            <h2 class="text-2xl font-bold">
                                Rp. xxx.xxx.xxx,-
                            </h2>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="mt-4 bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="px-4 pt-4 pb-24">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold">Daftar Biaya</h2>
                        <a href="{{ route('umkm.cost.create') }}"
                            class="mt-3 inline-flex items-center px-4 py-1 bg-citradark-500 border border-transparent rounded-md font-bold text-xs text-white hover:bg-citradark-700 focus:bg-citradark-400 active:bg-citradark-600 focus:outline-none focus:ring-2 focus:ring-citradark-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <i class="bx bx-plus text-xl"></i>
                            Tambah Biaya
                        </a>
                    </div>

                    <table class="mt-4 w-full border-collapse">
                        <tr
                            class="text-zinc-400 font-bold border border-b-1 border-r-0 border-t-0 border-l-0 border-zinc-400">
                            <td class="p-3">Tanggal</td>
                            <td class="p-3">Faktur</td>
                            <td class="p-3">Penerima</td>
                            <td class="p-3">Kategori</td>
                            <td class="p-3">Biaya</td>
                            <td class="p-3 text-center">Tindakan</td>
                        </tr>
                        @foreach ($costs as $cost)
                            <tr class="border border-b-1 border-r-0 border-t-0 border-l-0 border-zinc-400">
                                <td class="p-3">{{ AppHelper::date($cost->date) ?? '-' }}</td>
                                <td class="p-3">
                                    <a href="{{ route('umkm.cost.show', $cost->id) }}"
                                        class="text-citradark-500 hover:text-citragreen-500 underline">
                                        {{ $cost->invoice }}
                                    </a>
                                </td>
                                <td class="p-3">{{ $cost->contact->name ?? '-' }}</td>
                                <td class="p-3">
                                    {{ $cost->details->count() > 1 ? 'terbagi' : $cost->details[0]->coa->name }}</td>
                                <td class="p-3">{{ AppHelper::rp($cost->total ?? 0) }}</td>
                                <td class="p-3 text-center">
                                    <x-dropdown align="left" width="48">
                                        <x-slot name="trigger">
                                            <button>
                                                <i class="bx bx-dots-horizontal-rounded text-xl"></i>
                                            </button>
                                        </x-slot>

                                        <x-slot name="content">
                                            <x-dropdown-link :href="route('umkm.cost.edit', $cost->id)">
                                                {{ __('Edit') }}
                                            </x-dropdown-link>
                                            <x-dropdown-link data-modal="deleteCostModal-{{ $loop->iteration }}"
                                                data-modal-toggle="deleteCostModal-{{ $loop->iteration }}"
                                                class="text-citrared-500">
                                                {{ __('Delete') }}
                                            </x-dropdown-link>
                                        </x-slot>
                                    </x-dropdown>
                                </td>
                            </tr>

                            <!-- Delete modal -->
                            <div id="deleteCostModal-{{ $loop->iteration }}" tabindex="-1" aria-hidden="true"
                                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                <div class="relative w-full h-full max-w-2xl md:h-auto">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-start justify-between p-4 border-b rounded-t border-zinc-200">
                                            <h3 class="text-xl font-bold">
                                                Hapus Biaya
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-zinc-200 hover:text-citrablack rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                                data-modal-hide="deleteCostModal-{{ $loop->iteration }}">
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
                                                <button data-modal-hide="deleteCostModal-{{ $loop->iteration }}"
                                                    type="button"
                                                    class="inline-flex items-center px-4 py-2 bg-zinc-200 border border-transparent rounded-md font-bold text-xs text-zinc-500 hover:bg-zinc-300 focus:bg-zinc-400 active:bg-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                    Batal
                                                </button>
                                                <form action="{{ route('umkm.cost.destroy', $cost->id) }}"
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
