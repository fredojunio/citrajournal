<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Boxicons --}}
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">

        <div class="flex gap-0">
            <div
                class="w-1/4 flex flex-col items-center py-6 px-6 relative bg-white shadow-md min-h-screen overflow-y-auto z-10">
                <div class="flex gap-2 items-center">
                    <img src="{{ asset('images/logo.svg') }}" class="w-8" alt="">
                    <h1 class="text-2xl font-bold">
                        {{ config('app.name') }}
                    </h1>
                </div>

                <!-- User -->
                <div class="mt-6 flex justify-content-start w-full">
                    <a href="" class="w-full flex gap-2 items-center">
                        <i class="bx bxs-user-circle text-citradark-500 text-4xl"></i>
                        <p class="font-bold">{{ Auth::user()->name }}</p>
                    </a>
                </div>

                <!-- Dashboard -->
                <div class="mt-6 flex justify-content-start w-full">
                    <a href="" class="w-full flex justify-between items-center">
                        <div class="flex gap-2 items-center">
                            <i class="bx bxs-dashboard text-citradark-500 text-3xl"></i>
                            <p class="">Dasbor</p>
                        </div>
                        <i class="bx bx-chevron-right text-2xl"></i>
                    </a>
                </div>

                <!-- Laporan -->
                <div class="mt-4 flex justify-content-start w-full">
                    <a href="" class="w-full flex justify-between items-center">
                        <div class="flex gap-2 items-center">
                            <i class="bx bxs-bar-chart-square text-citradark-500 text-3xl"></i>
                            <p class="">Laporan</p>
                        </div>
                        <i class="bx bx-chevron-right text-2xl"></i>
                    </a>
                </div>

                <!-- Kas -->
                <div class="mt-6 flex justify-content-start w-full">
                    <a href="" class="w-full flex justify-between items-center">
                        <div class="flex gap-2 items-center">
                            <i class="bx bxs-bank text-citradark-500 text-3xl"></i>
                            <p class="">Kas</p>
                        </div>
                        <i class="bx bx-chevron-right text-2xl"></i>
                    </a>
                </div>

                <!-- Sale -->
                <div class="mt-4 flex justify-content-start w-full">
                    <a href="" class="w-full flex justify-between items-center">
                        <div class="flex gap-2 items-center">
                            <i class="bx bxs-purchase-tag text-citradark-500 text-3xl"></i>
                            <p class="">Penjualan</p>
                        </div>
                        <i class="bx bx-chevron-right text-2xl"></i>
                    </a>
                </div>

                <!-- Purchase -->
                <div class="mt-4 flex justify-content-start w-full">
                    <a href="" class="w-full flex justify-between items-center">
                        <div class="flex gap-2 items-center">
                            <i class="bx bxs-cart text-citradark-500 text-3xl"></i>
                            <p class="">Pembelian</p>
                        </div>
                        <i class="bx bx-chevron-right text-2xl"></i>
                    </a>
                </div>

                <!-- Cost -->
                <div class="mt-4 flex justify-content-start w-full">
                    <a href="" class="w-full flex justify-between items-center">
                        <div class="flex gap-2 items-center">
                            <i class="bx bxs-credit-card-front text-citradark-500 text-3xl"></i>
                            <p class="">Biaya</p>
                        </div>
                        <i class="bx bx-chevron-right text-2xl"></i>
                    </a>
                </div>

                <!-- Contact -->
                <div class="mt-6 flex justify-content-start w-full">
                    <a href="" class="w-full flex justify-between items-center">
                        <div class="flex gap-2 items-center">
                            <i class="bx bxs-contact text-citradark-500 text-3xl"></i>
                            <p class="">Kontak</p>
                        </div>
                        <i class="bx bx-chevron-right text-2xl"></i>
                    </a>
                </div>

                <!-- Product -->
                <div class="mt-4 flex justify-content-start w-full">
                    <a href="" class="w-full flex justify-between items-center">
                        <div class="flex gap-2 items-center">
                            <i class="bx bxs-package text-citradark-500 text-3xl"></i>
                            <p class="">Produk</p>
                        </div>
                        <i class="bx bx-chevron-right text-2xl"></i>
                    </a>
                </div>

                <!-- Asset -->
                <div class="mt-4 flex justify-content-start w-full">
                    <a href="" class="w-full flex justify-between items-center">
                        <div class="flex gap-2 items-center">
                            <i class="bx bxs-building-house text-citradark-500 text-3xl"></i>
                            <p class="">Aset</p>
                        </div>
                        <i class="bx bx-chevron-right text-2xl"></i>
                    </a>
                </div>

                <!-- COA -->
                <div class="mt-4 flex justify-content-start w-full">
                    <a href="" class="w-full flex justify-between items-center">
                        <div class="flex gap-2 items-center">
                            <i class="bx bxs-food-menu text-citradark-500 text-3xl"></i>
                            <p class="">Akun (COA)</p>
                        </div>
                        <i class="bx bx-chevron-right text-2xl"></i>
                    </a>
                </div>


            </div>
            <div class="w-full">
                <div class="flex justify-between bg-white shadow-md">
                    <!-- Page Heading -->
                    @if (isset($header))
                        <header class="">
                            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                <div class="flex items-center gap-1">
                                    <i class="bx bx-menu text-2xl"></i>
                                    {{ $header }}
                                </div>
                            </div>
                        </header>
                    @endif

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-bold rounded-md text-citrablack focus:outline-none transition ease-in-out duration-150">
                                    <i class="bx bxs-home-smile text-2xl text-citragreen-500 mr-1"></i>
                                    <div>{{ Auth::user()->umkm->name }}</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
</body>

</html>
