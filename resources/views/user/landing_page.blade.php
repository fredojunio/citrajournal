<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('images/icon.png') }}" type="image/x-icon">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body class="font-sans antialiased">

    <div class="min-h-screen bg-white">
        <header class="bg-white shadow">
            <div class="container mx-auto px-4">
                <nav class="flex justify-between items-center py-4">
                    <a href="#" class="flex gap-2 items-center">
                        <img src="{{ asset('images/logo.svg') }}" class="w-8" alt="">
                        <h1 class="text-2xl font-bold">
                            {{ config('app.name') }}
                        </h1>
                    </a>
                    <ul class="flex">
                        <li><a href="#fitur" class="text-gray-800 hover:text-citragreen-500 px-4">Fitur</a></li>
                        <li><a href="#keuntungan" class="text-gray-800 hover:text-citragreen-500 px-4">Keuntungan</a>
                        </li>
                        <li><a href="{{ route('register') }}" class="text-gray-800 hover:text-citragreen-500 px-4">Coba
                                Sekarang</a></li>
                        <li><a href="{{ route('login') }}"
                                class="text-gray-800 hover:text-citragreen-500 px-4 ml-6">Login</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <section class="py-20">
            <div class="container mx-auto px-4">
                <div class="flex flex-wrap items-center -mx-4">
                    <div class="w-full lg:w-1/2 px-4 mb-8 lg:mb-0">
                        <h2 class="text-4xl font-bold mb-4">Pembuat Laporan Keuangan UMKM</h2>
                        <p class="text-gray-700 leading-loose mb-8">Citrajournal membantu UMKM untuk mendapatkan laporan
                            keuangan dengan mudah dan cepat. Dengan fitur pencatatan transaksi harian, melihat laporan
                            laba rugi, melihat laporan neraca, serta dapat melihat analisa kesehatan UMKM yang dibantu
                            dengan metode Altman Z-Score.</p>
                        <a href="{{ route('register') }}"
                            class="inline-block bg-citradark-500 hover:bg-citradark-700 text-white font-semibold px-6 py-3 rounded">Daftar
                            Sekarang</a>
                    </div>
                    <div class="w-full lg:w-1/2 px-4">
                        <img src="https://images.unsplash.com/photo-1591696205602-2f950c417cb9?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80"
                            alt="Citrajournal" class="rounded-lg shadow-lg">
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-gray-100 py-20" id="fitur">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl mx-auto text-center mb-12">
                    <h2 class="text-3xl font-bold mb-4">Fitur Utama</h2>
                    <p class="text-gray-700">Citrajournal memiliki beberapa fitur utama yang dapat membantu UMKM untuk
                        mengelola keuangannya.</p>
                </div>
                <div class="flex flex-wrap -mx-4">
                    <div class="w-full md:w-1/3 px-4 mb-8">
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <h3 class="text-xl font-bold mb-4">Pencatatan Transaksi Harian</h3>
                            <p class="text-gray-700 leading-loose mb-4">Citrajournal memudahkan UMKM untuk mencatat
                                transaksi harian mereka sehingga mereka dapat dengan mudah mengelola keuangannya.</p>
                        </div>
                    </div>
                    <div class="w-full md:w-1/3 px-4 mb-8">
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <h3 class="text-xl font-bold mb-4">Laporan Laba Rugi</h3>
                            <p class="text-gray-700 leading-loose mb-4">Citrajournal dapat menghasilkan laporan laba
                                rugi secara otomatis sehingga UMKM dapat mengetahui kinerja keuangannya dengan mudah.
                            </p>
                        </div>
                    </div>
                    <div class="w-full md:w-1/3 px-4 mb-8">
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <h3 class="text-xl font-bold mb-4">Laporan Neraca</h3>
                            <p class="text-gray-700 leading-loose mb-4">Citrajournal juga dapat menghasilkan laporan
                                neraca sehingga UMKM dapat mengetahui aset dan liabilitas mereka dengan mudah.</p>
                        </div>
                    </div>
                    <div class="w-full md:w-1/3 px-4 mb-8">
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <h3 class="text-xl font-bold mb-4">Analisa Kesehatan UMKM</h3>
                            <p class="text-gray-700 leading-loose mb-4">Citrajournal dapat melakukan analisa kesehatan
                                UMKM dengan metode Altman Z-Score sehingga UMKM dapat mengetahui seberapa sehat
                                keuangannya.</p>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <a href="{{ route('register') }}"
                        class="bg-citradark-500 hover:bg-citradark-700 text-white font-bold py-3 px-6 rounded-lg inline-block mt-8">Coba
                        Gratis Sekarang</a>
                </div>

            </div>
        </section>

        <section class="bg-white py-8" id="keuntungan">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold mb-8 text-center">Mengapa Citrajournal?</h2>
                <div class="flex flex-wrap -mx-4">
                    <div class="w-full md:w-1/3 px-4 mb-8">
                        <div class="bg-white rounded-lg shadow-lg p-6 h-full">
                            <div class="flex justify-between items-end">
                                <h3 class="text-xl font-bold mb-4">
                                    Hemat Waktu
                                </h3>
                                <div class="text-5xl text-citragreen-500">
                                    <i class="bx bx-target-lock"></i>
                                </div>
                            </div>
                            <p class="text-gray-700 leading-loose mb-4">Dengan Citrajournal, UMKM dapat menghemat waktu
                                dalam mengelola keuangan mereka, sehingga dapat fokus pada pengembangan bisnis.</p>
                        </div>
                    </div>
                    <div class="w-full md:w-1/3 px-4 mb-8">
                        <div class="bg-white rounded-lg shadow-lg p-6 h-full">
                            <div class="flex justify-between items-end">

                                <h3 class="text-xl font-bold mb-4">Akurasi Data</h3>
                                <div class="text-5xl text-citragreen-500">
                                    <i class="bx bx-timer"></i>
                                </div>

                            </div>
                            <p class="text-gray-700 leading-loose mb-4">Citrajournal dapat memastikan akurasi data
                                keuangan UMKM dengan menggunakan teknologi terkini dalam pencatatan dan pengolahan data.
                            </p>
                        </div>
                    </div>
                    <div class="w-full md:w-1/3 px-4 mb-8">
                        <div class="bg-white rounded-lg shadow-lg p-6 h-full">
                            <div class="flex justify-between items-end">
                                <h3 class="text-xl font-bold mb-4">Keamanan Data</h3>
                                <div class="text-5xl text-citragreen-500">
                                    <i class="bx bx-check-shield"></i>
                                </div>
                            </div>
                            <p class="text-gray-700 leading-loose mb-4">Citrajournal mengutamakan keamanan data keuangan
                                UMKM dengan menggunakan enkripsi dan sistem keamanan terkini.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <section class="bg-gray-100 py-8">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold mb-8 text-center">Coba Sekarang</h2>
                <div class="flex flex-wrap -mx-4">
                    <div class="w-full md:w-1/2 px-4">
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <h3 class="text-xl font-bold mb-4">Daftar Sekarang</h3>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <!-- Name -->
                                <div>
                                    <x-input-label for="name" :value="__('Nama')" />
                                    <x-text-input id="name" class="block mt-1 w-full" type="text"
                                        name="name" :value="old('name')" required autocomplete="name" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <!-- Phone -->
                                <div class="mt-4">
                                    <x-input-label for="phone" :value="__('Nomor Telepon')" />
                                    <x-text-input id="phone" class="block mt-1 w-full" type="tel"
                                        name="phone" :value="old('phone')" autocomplete="phone" />
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>

                                <!-- Address -->
                                <div class="mt-4">
                                    <x-input-label for="address" :value="__('Alamat')" />
                                    <x-text-input id="address" class="block mt-1 w-full" type="text"
                                        name="address" :value="old('address')" autocomplete="address" />
                                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                </div>



                                <!-- Email Address -->
                                <div class="mt-4">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="email"
                                        name="email" :value="old('email')" required autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- Password -->
                                <div class="mt-4">
                                    <x-input-label for="password" :value="__('Password')" />

                                    <x-text-input id="password" class="block mt-1 w-full" type="password"
                                        name="password" required autocomplete="new-password" />

                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <!-- Confirm Password -->
                                <div class="mt-4">
                                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                        type="password" name="password_confirmation" required
                                        autocomplete="new-password" />

                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>

                                <div class="mt-10">
                                    <x-long-primary-button>
                                        {{ __('Register') }}
                                    </x-long-primary-button>

                                    <div class="flex justify-center">
                                        <a class="mt-3 underline text-xs text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                            href="{{ route('login') }}">
                                            {{ __('Sudah punya akun? log in disini') }}
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 px-4">
                        <h3 class="text-xl font-bold mb-4">Apa yang Kamu Dapatkan?</h3>
                        <ul class="list-inside">
                            <li class="flex gap-2">
                                <i class="bx bx-check text-citragreen-500"></i>
                                <p>Fitur pencatatan transaksi harian untuk memudahkan kamu dalam mencatat keuangan
                                    usahamu</p>
                            </li>
                            <li class="flex gap-2">
                                <i class="bx bx-check text-citragreen-500"></i>
                                <p>Laporan laba rugi untuk mengetahui performa usahamu secara keseluruhan</p>
                            </li>
                            <li class="flex gap-2">
                                <i class="bx bx-check text-citragreen-500"></i>
                                <p>Laporan neraca untuk mengetahui posisi keuangan usahamu saat ini</p>
                            </li>
                            <li class="flex gap-2">
                                <i class="bx bx-check text-citragreen-500"></i>
                                <p>Analisis kesehatan usaha yang dibantu dengan metode Altman Z-score</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <footer class="bg-citradark-700 text-white py-8">
            <div class="container mx-auto px-4">
                <p class="text-center">&copy; 2023 Citrajournal. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>

</body>

</html>
