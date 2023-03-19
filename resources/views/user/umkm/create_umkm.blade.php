<x-guest-layout>

    <div class="flex sm:justify-center min-h-screen">
        <div class="mt-28 w-full sm:max-w-xl px-10 py-10 bg-white shadow-lg overflow-hidden sm:rounded-t-xl">
            <h2 class="font-bold mb-4 text-center">Lengkapi Data Perusahaanmu</h2>
            <form method="POST" action="{{ route('umkm.store') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nama Perusahaan')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" placeholder="Masukkan nama perusahaan" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autocomplete="username" placeholder="Masukkan email perusahaan" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Phone -->
                <div class="mt-4">
                    <x-input-label for="phone" :value="__('Nomor Telepon')" />
                    <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone"
                        :value="old('phone')" required autofocus autocomplete="phone"
                        placeholder="Masukkan nomor telepon" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <!-- Address -->
                <div class="mt-4">
                    <x-input-label for="address" :value="__('Alamat')" />
                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                        :value="old('address')" required autofocus autocomplete="address" placeholder="Masukkan alamat" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <!-- Type -->
                <div class="mt-4">
                    <x-input-label for="type" :value="__('Jenis Usaha')" />
                    <select id="type"
                        class="border-b-1 border-r-0 border-t-0 border-l-0 border-gray-300 focus:border-citragreen-500 focus:ring-citragreen-500 block mt-1 w-full"
                        type="text" name="type" required>
                        <option hidden value="">Pilih Kategori</option>
                        <option value="">Pilih Kategori</option>
                        <option value="Makanan dan Minuman">Makanan dan Minuman</option>
                        <option value="Mini Market/Kelontong/Retail">Mini Market/Kelontong/Retail</option>
                        <option value="Pakaian dan Aksesoris">Pakaian dan Aksesoris</option>
                        <option value="Salon dan Barbershop">Salon dan Barbershop</option>
                        <option value="Olahraga dan Hobi">Olahraga dan Hobi</option>
                        <option value="Kesehatan dan Kecantikan">Kesehatan dan Kecantikan</option>
                        <option value="Toko Elektronik, Selular, dan Produk Digital">Toko Elektronik, Selular, dan
                            Produk Digital</option>
                        <option value="Makanan Segar">Makanan Segar</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <!-- Employees -->
                <div class="mt-4">
                    <x-input-label for="employees" :value="__('Jumlah Karyawan')" />
                    <x-text-input id="employees" class="block mt-1 w-full" type="number" name="employees"
                        :value="old('employees')" required autofocus autocomplete="employees"
                        placeholder="Masukkan jumlah karyawan" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <!-- Hidden -->
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                <div class="mt-10">
                    <x-long-primary-button>
                        {{ __('Buat Perusahaan') }}
                    </x-long-primary-button>
                </div>
            </form>
        </div>
    </div>

</x-guest-layout>
