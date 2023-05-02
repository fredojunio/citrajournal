<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('UMKM ' . $umkm->name) }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="px-4 pt-4 pb-10">
                    <h1 class="text-xl font-bold">
                        Informasi UMKM
                    </h1>
                    <div class="w-2/3 mt-4">
                        <form method="POST" action="{{ route('umkm.update', $umkm) }}">
                            @csrf
                            @method('patch')

                            <!-- Name -->
                            <div>
                                <x-input-label for="name" :value="__('Nama Perusahaan')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                    :value="$umkm->name" required autocomplete="name"
                                    placeholder="Masukkan nama perusahaan" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Email Address -->
                            <div class="mt-8">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                    :value="$umkm->email" required autocomplete="username"
                                    placeholder="Masukkan email perusahaan" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Phone -->
                            <div class="mt-8">
                                <x-input-label for="phone" :value="__('Nomor Telepon')" />
                                <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone"
                                    :value="$umkm->phone" autocomplete="phone" placeholder="Masukkan nomor telepon" />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>

                            <!-- Address -->
                            <div class="mt-8">
                                <x-input-label for="address" :value="__('Alamat')" />
                                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                                    :value="$umkm->address" autocomplete="address" placeholder="Masukkan alamat" />
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>

                            <!-- Type -->
                            <div class="mt-8">
                                <x-input-label for="type" :value="__('Jenis Usaha')" />
                                <select id="type"
                                    class="border-b-1 border-r-0 border-t-0 border-l-0 border-gray-300 focus:border-citragreen-500 focus:ring-citragreen-500 block mt-1 w-full"
                                    type="text" name="type" required>
                                    <option hidden value="{{ $umkm->type }}">{{ $umkm->type }}</option>
                                    <option value="Makanan dan Minuman">Makanan dan Minuman</option>
                                    <option value="Mini Market/Kelontong/Retail">Mini Market/Kelontong/Retail</option>
                                    <option value="Pakaian dan Aksesoris">Pakaian dan Aksesoris</option>
                                    <option value="Salon dan Barbershop">Salon dan Barbershop</option>
                                    <option value="Olahraga dan Hobi">Olahraga dan Hobi</option>
                                    <option value="Kesehatan dan Kecantikan">Kesehatan dan Kecantikan</option>
                                    <option value="Toko Elektronik, Selular, dan Produk Digital">Toko Elektronik,
                                        Selular,
                                        dan
                                        Produk Digital</option>
                                    <option value="Makanan Segar">Makanan Segar</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>

                            <!-- Employees -->
                            <div class="mt-8">
                                <x-input-label for="employees" :value="__('Jumlah Karyawan')" />
                                <x-text-input id="employees" class="block mt-1 w-full" type="number" name="employees"
                                    :value="$umkm->employees" autocomplete="employees"
                                    placeholder="Masukkan jumlah karyawan" />
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>

                            <!-- Hidden -->
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                            <x-primary-button class="mt-8">
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
