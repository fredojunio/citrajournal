<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kontak') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="px-4 pt-4 pb-24">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold">Daftar Kontak</h2>
                        <button type="button" data-modal="addContactModal" data-modal-toggle="addContactModal"
                            class="mt-3 inline-flex items-center px-4 py-1 bg-citradark-500 border border-transparent rounded-md font-bold text-xs text-white hover:bg-citradark-700 focus:bg-citradark-400 active:bg-citradark-600 focus:outline-none focus:ring-2 focus:ring-citradark-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <i class="bx bx-plus text-xl"></i>
                            Tambah Kontak
                        </button>
                    </div>

                    <div class="mt-6">
                        <div class="flex">
                            <a href="{{ route('umkm.contact.index') }}"
                                class="{{ empty($filter) ? 'hover:text-citragreen-500 py-2 px-4 border-b-2 border-b-citragreen-500 font-bold text-citragreen-500 z-10' : 'hover:text-citragreen-500 py-2 px-4 border border-r-0 border-t-0 border-l-0 border-b-zinc-400' }}">
                                Semua
                            </a>
                            <form action="{{ route('umkm.contact.index') }}" method="get">
                                <input type="hidden" name="filter" value="Pelanggan">
                                <button href=""
                                    class="{{ !empty($filter) && $filter == 'Pelanggan' ? 'hover:text-citragreen-500 py-2 px-4 border-b-2 border-b-citragreen-500 font-bold text-citragreen-500 z-10' : 'hover:text-citragreen-500 py-2 px-4 border border-r-0 border-t-0 border-l-0 border-b-zinc-400' }}">
                                    Pelanggan
                                </button>
                            </form>
                            <form action="{{ route('umkm.contact.index') }}" method="get">
                                <input type="hidden" name="filter" value="Supplier">
                                <button href=""
                                    class="{{ !empty($filter) && $filter == 'Supplier' ? 'hover:text-citragreen-500 py-2 px-4 border-b-2 border-b-citragreen-500 font-bold text-citragreen-500 z-10' : 'hover:text-citragreen-500 py-2 px-4 border border-r-0 border-t-0 border-l-0 border-b-zinc-400' }}">
                                    Supplier
                                </button>
                            </form>
                            <form action="{{ route('umkm.contact.index') }}" method="get">
                                <input type="hidden" name="filter" value="Karyawan">
                                <button href=""
                                    class="{{ !empty($filter) && $filter == 'Karyawan' ? 'hover:text-citragreen-500 py-2 px-4 border-b-2 border-b-citragreen-500 font-bold text-citragreen-500 z-10' : 'hover:text-citragreen-500 py-2 px-4 border border-r-0 border-t-0 border-l-0 border-b-zinc-400' }}">
                                    Karyawan
                                </button>
                            </form>
                            <form action="{{ route('umkm.contact.index') }}" method="get">
                                <input type="hidden" name="filter" value="Lainnya">
                                <button href=""
                                    class="{{ !empty($filter) && $filter == 'Lainnya' ? 'hover:text-citragreen-500 py-2 px-4 border-b-2 border-b-citragreen-500 font-bold text-citragreen-500 z-10' : 'hover:text-citragreen-500 py-2 px-4 border border-r-0 border-t-0 border-l-0 border-b-zinc-400' }}">
                                    Lainnya
                                </button>
                            </form>
                            <div class="border border-r-0 border-t-0 border-l-0 border-b-zinc-400 w-full"></div>
                        </div>
                    </div>

                    <table class="mt-6 w-full border-collapse">
                        <tr
                            class="text-zinc-400 font-bold border border-b-1 border-r-0 border-t-0 border-l-0 border-zinc-400">
                            <td class="p-3">Tipe</td>
                            <td class="p-3">Nama</td>
                            <td class="p-3">Email</td>
                            <td class="p-3">Alamat</td>
                            <td class="p-3">Nomor Telepon</td>
                            <td class="p-3 text-center">Tindakan</td>
                        </tr>
                        @foreach ($contacts as $contact)
                            <tr class="border border-b-1 border-r-0 border-t-0 border-l-0 border-zinc-400">
                                <td class="p-3">{{ $contact->type }}</td>
                                <td class="p-3">{{ $contact->name }}</td>
                                <td class="p-3">{{ $contact->email }}</td>
                                <td class="p-3">{{ $contact->address }}</td>
                                <td class="p-3">{{ $contact->phone }}</td>
                                <td class="p-3 text-center">
                                    <x-dropdown align="left" width="48">
                                        <x-slot name="trigger">
                                            <button>
                                                <i class="bx bx-dots-horizontal-rounded text-xl"></i>
                                            </button>
                                        </x-slot>

                                        <x-slot name="content">
                                            <x-dropdown-link data-modal="editContactModal-{{ $loop->iteration }}"
                                                data-modal-toggle="editContactModal-{{ $loop->iteration }}">
                                                {{ __('Edit') }}
                                            </x-dropdown-link>
                                            <x-dropdown-link data-modal="deleteContactModal-{{ $loop->iteration }}"
                                                data-modal-toggle="deleteContactModal-{{ $loop->iteration }}"
                                                class="text-citrared-500">
                                                {{ __('Hapus') }}
                                            </x-dropdown-link>
                                        </x-slot>
                                    </x-dropdown>
                                </td>
                            </tr>

                            <!-- Edit modal -->
                            <div id="editContactModal-{{ $loop->iteration }}" tabindex="-1" aria-hidden="true"
                                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                <div class="relative w-full h-full max-w-2xl md:h-auto">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-start justify-between p-4 border-b rounded-t border-zinc-200">
                                            <h3 class="text-xl font-bold">
                                                Edit Kontak
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-zinc-200 hover:text-citrablack rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                                data-modal-hide="editContactModal-{{ $loop->iteration }}">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('umkm.contact.update', $contact) }}"
                                            id="editcontact-{{ $loop->iteration }}" method="post">@csrf
                                            @method('PATCH')</form>
                                        <!-- Modal body -->
                                        <div class="p-6 space-y-6">
                                            <div class="flex space-x-16 items-center">
                                                <label for="name" class="w-32">Nama</label>
                                                <x-text-input form="editcontact-{{ $loop->iteration }}" id="name"
                                                    class="block w-full" type="text" name="name"
                                                    :value="$contact->name" required autofocus autocomplete="name" />
                                            </div>

                                            <div class="flex space-x-16 items-center">
                                                <label for="type" class="w-32">Tipe Kontak</label>
                                                <div class="flex justify-between w-full">
                                                    <div class="inline-block">
                                                        <input form="editcontact-{{ $loop->iteration }}"
                                                            type="radio" name="type"
                                                            class="accent-citragreen-500" value="Pelanggan"
                                                            id="type1-{{ $loop->iteration }}"
                                                            {{ $contact->type == 'Pelanggan' ? 'checked' : '' }}>
                                                        <label for="type1-{{ $loop->iteration }}">Pelanggan</label>
                                                    </div>
                                                    <div class="inline-block">
                                                        <input form="editcontact-{{ $loop->iteration }}"
                                                            type="radio" name="type"
                                                            class="accent-citragreen-500" value="Supplier"
                                                            id="type2-{{ $loop->iteration }}"
                                                            {{ $contact->type == 'Supplier' ? 'checked' : '' }}>
                                                        <label for="type2-{{ $loop->iteration }}">Supplier</label>
                                                    </div>
                                                    <div class="inline-block">
                                                        <input form="editcontact-{{ $loop->iteration }}"
                                                            type="radio" name="type"
                                                            class="accent-citragreen-500" value="Karyawan"
                                                            id="type3-{{ $loop->iteration }}"
                                                            {{ $contact->type == 'Karyawan' ? 'checked' : '' }}>
                                                        <label for="type3-{{ $loop->iteration }}">Karyawan</label>
                                                    </div>
                                                    <div class="inline-block">
                                                        <input form="editcontact-{{ $loop->iteration }}"
                                                            type="radio" name="type"
                                                            class="accent-citragreen-500" value="Lainnya"
                                                            id="type4-{{ $loop->iteration }}"
                                                            {{ $contact->type == 'Lainnya' ? 'checked' : '' }}>
                                                        <label for="type4-{{ $loop->iteration }}">Lainnya</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="flex space-x-16 items-center">
                                                <label for="phone" class="w-32">Handphone</label>
                                                <x-text-input form="editcontact-{{ $loop->iteration }}"
                                                    id="phone" class="block w-full" type="text"
                                                    name="phone" :value="$contact->phone" autofocus autocomplete="phone" />
                                            </div>

                                            <div class="flex space-x-16 items-center">
                                                <label for="email" class="w-32">Email</label>
                                                <x-text-input form="editcontact-{{ $loop->iteration }}"
                                                    id="email" class="block w-full" type="text"
                                                    name="email" :value="$contact->email" autofocus autocomplete="email" />
                                            </div>

                                            <div class="flex space-x-16 items-center">
                                                <label for="address" class="w-32">Alamat</label>
                                                <x-text-input form="editcontact-{{ $loop->iteration }}"
                                                    id="address" class="block w-full" type="text"
                                                    name="address" :value="$contact->address" autofocus
                                                    autocomplete="address" />
                                            </div>

                                        </div>
                                        <!-- Modal footer -->
                                        <div
                                            class="flex justify-end items-center p-6 space-x-2 border-t border-zinc-200 rounded-b">

                                            <button data-modal-hide="editContactModal-{{ $loop->iteration }}"
                                                type="button"
                                                class="inline-flex items-center px-4 py-2 bg-zinc-200 border border-transparent rounded-md font-bold text-xs text-zinc-500 hover:bg-zinc-300 focus:bg-zinc-400 active:bg-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                Batal
                                            </button>
                                            <x-primary-button form="editcontact-{{ $loop->iteration }}"
                                                class="ml-2">
                                                Simpan
                                            </x-primary-button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete modal -->
                            <div id="deleteContactModal-{{ $loop->iteration }}" tabindex="-1" aria-hidden="true"
                                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                <div class="relative w-full h-full max-w-2xl md:h-auto">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-start justify-between p-4 border-b rounded-t border-zinc-200">
                                            <h3 class="text-xl font-bold">
                                                Hapus Kontak
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-zinc-200 hover:text-citrablack rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                                data-modal-hide="deleteContactModal-{{ $loop->iteration }}">
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
                                                <button data-modal-hide="deleteContactModal-{{ $loop->iteration }}"
                                                    type="button"
                                                    class="inline-flex items-center px-4 py-2 bg-zinc-200 border border-transparent rounded-md font-bold text-xs text-zinc-500 hover:bg-zinc-300 focus:bg-zinc-400 active:bg-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                    Batal
                                                </button>
                                                <form action="{{ route('umkm.contact.destroy', $contact) }}"
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
                        {{ $contacts->links('vendor.pagination.default') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add modal -->
    <div id="addContactModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
        <div class="relative w-full h-full max-w-2xl md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t border-zinc-200">
                    <h3 class="text-xl font-bold">
                        Tambah Kontak
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-zinc-200 hover:text-citrablack rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                        data-modal-hide="addContactModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form action="{{ route('umkm.contact.store') }}" id="addcontact" method="post">@csrf</form>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <div class="flex space-x-16 items-center">
                        <label for="name" class="w-32">Nama</label>
                        <x-text-input form="addcontact" id="name" class="block w-full" type="text"
                            name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>

                    <div class="flex space-x-16 items-center">
                        <label for="type" class="w-32">Tipe Kontak</label>
                        <div class="flex justify-between w-full">
                            <div class="inline-block">
                                <input form="addcontact" type="radio" name="type" class="accent-citragreen-500"
                                    value="Pelanggan" id="type1">
                                <label for="type1">Pelanggan</label>
                            </div>
                            <div class="inline-block">
                                <input form="addcontact" type="radio" name="type" class="accent-citragreen-500"
                                    value="Supplier" id="type2">
                                <label for="type2">Supplier</label>
                            </div>
                            <div class="inline-block">
                                <input form="addcontact" type="radio" name="type" class="accent-citragreen-500"
                                    value="Karyawan" id="type3">
                                <label for="type3">Karyawan</label>
                            </div>
                            <div class="inline-block">
                                <input form="addcontact" type="radio" name="type" class="accent-citragreen-500"
                                    value="Lainnya" id="type4">
                                <label for="type4">Lainnya</label>
                            </div>
                        </div>
                    </div>

                    <div class="flex space-x-16 items-center">
                        <label for="phone" class="w-32">Handphone</label>
                        <x-text-input form="addcontact" id="phone" class="block w-full" type="text"
                            name="phone" :value="old('phone')" autofocus autocomplete="phone" />
                    </div>

                    <div class="flex space-x-16 items-center">
                        <label for="email" class="w-32">Email</label>
                        <x-text-input form="addcontact" id="email" class="block w-full" type="text"
                            name="email" :value="old('email')" autofocus autocomplete="email" />
                    </div>

                    <div class="flex space-x-16 items-center">
                        <label for="address" class="w-32">Alamat</label>
                        <x-text-input form="addcontact" id="address" class="block w-full" type="text"
                            name="address" :value="old('address')" autofocus autocomplete="address" />
                    </div>

                </div>
                <!-- Modal footer -->
                <div class="flex justify-end items-center p-6 space-x-2 border-t border-zinc-200 rounded-b">

                    <button data-modal-hide="addContactModal" type="button"
                        class="inline-flex items-center px-4 py-2 bg-zinc-200 border border-transparent rounded-md font-bold text-xs text-zinc-500 hover:bg-zinc-300 focus:bg-zinc-400 active:bg-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Batal
                    </button>
                    <x-primary-button form="addcontact" class="ml-2">
                        Simpan
                    </x-primary-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
