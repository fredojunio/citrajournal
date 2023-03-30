<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kode Akun') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="px-4 pt-4 pb-24">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold">Daftar Akun</h2>
                        <button type="button" data-modal="addCoaModal" data-modal-toggle="addCoaModal"
                            class="mt-3 inline-flex items-center px-4 py-1 bg-citradark-500 border border-transparent rounded-md font-bold text-xs text-white hover:bg-citradark-700 focus:bg-citradark-400 active:bg-citradark-600 focus:outline-none focus:ring-2 focus:ring-citradark-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <i class="bx bx-plus text-xl"></i>
                            Tambah Nomor Akun
                        </button>
                    </div>

                    <table class="mt-6 w-full border-collapse">
                        <thead
                            class="text-zinc-400 font-bold border border-b-1 border-r-0 border-t-0 border-l-0 border-zinc-400">
                            <td class="p-3">Kode Akun</td>
                            <td class="p-3">Nama</td>
                            <td class="p-3">Kategori</td>
                            <td class="p-3 text-center">Tindakan</td>
                        </thead>
                        @foreach ($coas as $coa)
                            <tr class="border border-b-1 border-r-0 border-t-0 border-l-0 border-zinc-400">
                                <td class="p-3">{{ $coa->code }}</td>
                                <td class="p-3">{{ $coa->name }}</td>
                                <td class="p-3">{{ $coa->category->name }}</td>
                                <td class="p-3 text-center">
                                    <x-dropdown align="left" width="48">
                                        <x-slot name="trigger">
                                            <button>
                                                <i class="bx bx-dots-horizontal-rounded text-xl"></i>
                                            </button>
                                        </x-slot>

                                        <x-slot name="content">
                                            <x-dropdown-link data-modal="editCoaModal-{{ $loop->iteration }}"
                                                data-modal-toggle="editCoaModal-{{ $loop->iteration }}">
                                                {{ __('Edit') }}
                                            </x-dropdown-link>
                                            <x-dropdown-link data-modal="deleteCoaModal-{{ $loop->iteration }}"
                                                data-modal-toggle="deleteCoaModal-{{ $loop->iteration }}"
                                                class="text-red-500">
                                                {{ __('Delete') }}
                                            </x-dropdown-link>
                                        </x-slot>
                                    </x-dropdown>
                                </td>
                            </tr>

                            <!-- Edit modal -->
                            <div id="editCoaModal-{{ $loop->iteration }}" tabindex="-1" aria-hidden="true"
                                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                <div class="relative w-full h-full max-w-2xl md:h-auto">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-start justify-between p-4 border-b rounded-t border-zinc-200">
                                            <h3 class="text-xl font-bold">
                                                Tambah Nomor Akun
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-zinc-200 hover:text-citrablack rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                                data-modal-hide="editCoaModal-{{ $loop->iteration }}">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('umkm.coa.update', $coa) }}"
                                            id="editcoa-{{ $loop->iteration }}" method="post">@csrf @method('PATCH')
                                        </form>
                                        <!-- Modal body -->
                                        <div class="p-6 space-y-6">
                                            <div class="flex space-x-16 items-center">
                                                <label for="code" class="w-32">Kode Akun</label>
                                                <x-text-input form="editcoa-{{ $loop->iteration }}" id="code"
                                                    class="block w-full" type="text" name="code" :value="$coa->code"
                                                    required autofocus autocomplete="code" />
                                            </div>

                                            <div class="flex space-x-16 items-center">
                                                <label for="name" class="w-32">Nama</label>
                                                <x-text-input form="editcoa-{{ $loop->iteration }}" id="name"
                                                    class="block w-full" type="text" name="name" :value="$coa->name"
                                                    required autofocus autocomplete="name" />
                                            </div>


                                            <div class="flex space-x-16 items-center">
                                                <label for="category_id" class="w-32">Kategori</label>
                                                <select form="editcoa-{{ $loop->iteration }}" id="category_id"
                                                    class="border-b-1 w-full border-r-0 border-t-0 border-l-0 border-gray-300 focus:border-citragreen-500 focus:ring-citragreen-500 block mt-1"
                                                    type="text" name="category_id" required>
                                                    <option hidden value="{{ $coa->category->id }}">
                                                        {{ $coa->category->name }}
                                                    </option>
                                                    @foreach ($coaCategories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <!-- Modal footer -->
                                        <div
                                            class="flex justify-end items-center p-6 space-x-2 border-t border-zinc-200 rounded-b">

                                            <button data-modal-hide="editCoaModal-{{ $loop->iteration }}"
                                                type="button"
                                                class="inline-flex items-center px-4 py-2 bg-zinc-200 border border-transparent rounded-md font-bold text-xs text-zinc-500 hover:bg-zinc-300 focus:bg-zinc-400 active:bg-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                Batal
                                            </button>
                                            <x-primary-button form="editcoa-{{ $loop->iteration }}" class="ml-2">
                                                Simpan
                                            </x-primary-button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete modal -->
                            <div id="deleteCoaModal-{{ $loop->iteration }}" tabindex="-1" aria-hidden="true"
                                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                <div class="relative w-full h-full max-w-2xl md:h-auto">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-start justify-between p-4 border-b rounded-t border-zinc-200">
                                            <h3 class="text-xl font-bold">
                                                Hapus Kode Akun
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-zinc-200 hover:text-citrablack rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                                data-modal-hide="deleteCoaModal-{{ $loop->iteration }}">
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
                                                <button data-modal-hide="deleteCoaModal-{{ $loop->iteration }}"
                                                    type="button"
                                                    class="inline-flex items-center px-4 py-2 bg-zinc-200 border border-transparent rounded-md font-bold text-xs text-zinc-500 hover:bg-zinc-300 focus:bg-zinc-400 active:bg-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                    Batal
                                                </button>
                                                <form action="{{ route('umkm.coa.destroy', $coa) }}" method="post">
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
                        {{ $coas->links('vendor.pagination.default') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add modal -->
    <div id="addCoaModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
        <div class="relative w-full h-full max-w-2xl md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t border-zinc-200">
                    <h3 class="text-xl font-bold">
                        Tambah Nomor Akun
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-zinc-200 hover:text-citrablack rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                        data-modal-hide="addCoaModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form action="{{ route('umkm.coa.store') }}" id="addcoa" method="post">@csrf</form>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <div class="flex space-x-16 items-center">
                        <label for="code" class="w-32">Kode Akun</label>
                        <x-text-input form="addcoa" id="code" class="block w-full" type="text"
                            name="code" :value="old('code')" required autofocus autocomplete="code" />
                    </div>

                    <div class="flex space-x-16 items-center">
                        <label for="name" class="w-32">Nama</label>
                        <x-text-input form="addcoa" id="name" class="block w-full" type="text"
                            name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>


                    <div class="flex space-x-16 items-center">
                        <label for="category_id" class="w-32">Kategori</label>
                        <select form="addcoa" id="category_id"
                            class="border-b-1 w-full border-r-0 border-t-0 border-l-0 border-gray-300 focus:border-citragreen-500 focus:ring-citragreen-500 block mt-1"
                            type="text" name="category_id" required>
                            @foreach ($coaCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <!-- Modal footer -->
                <div class="flex justify-end items-center p-6 space-x-2 border-t border-zinc-200 rounded-b">

                    <button data-modal-hide="addCoaModal" type="button"
                        class="inline-flex items-center px-4 py-2 bg-zinc-200 border border-transparent rounded-md font-bold text-xs text-zinc-500 hover:bg-zinc-300 focus:bg-zinc-400 active:bg-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Batal
                    </button>
                    <x-primary-button form="addcoa" class="ml-2">
                        Simpan
                    </x-primary-button>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
