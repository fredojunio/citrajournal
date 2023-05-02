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

    <div class="min-h-screen bg-gray-100">
        <div class="flex gap-0 relative">
            <div
                class="fixed left-0 w-1/5 flex flex-col items-center py-6 bg-white shadow-md min-h-screen overflow-y-auto z-10">
                <div class="flex gap-2 items-center">
                    <img src="{{ asset('images/logo.svg') }}" class="w-8" alt="">
                    <h1 class="text-2xl font-bold">
                        {{ config('app.name') }}
                    </h1>
                </div>

                <!-- User -->
                <div class="px-6 mt-6 flex justify-content-start w-full">
                    <a href="{{ route('umkm.show', Auth::user()->umkm) }}"
                        class="w-full flex gap-2 items-center {{ request()->routeIs('umkm.show') ? 'text-citragreen-500' : '' }}">
                        <i
                            class="bx bxs-home-smile {{ request()->routeIs('umkm.show') ? 'text-citragreen-500' : 'text-citradark-500' }} text-4xl"></i>
                        <p class="font-bold">{{ Auth::user()->umkm->name }}</p>
                    </a>
                </div>

                <!-- Dashboard -->
                <div class="relative px-6 mt-6 py-1 flex justify-content-start w-full">
                    <div
                        class="{{ request()->routeIs('umkm.dashboard') ? 'w-full -left-3 top-0 h-full bg-citragreen-500 absolute rounded-r-full' : '' }}">
                    </div>
                    <a href="{{ route('umkm.dashboard') }}"
                        class="w-full flex justify-between items-center z-10 group">
                        <div class="flex gap-2 items-center">
                            <i
                                class="bx bxs-dashboard {{ request()->routeIs('umkm.dashboard') ? 'text-white' : 'text-citradark-500 group-hover:text-citragreen-500' }} text-3xl"></i>
                            <p
                                class="{{ request()->routeIs('umkm.dashboard') ? 'text-white' : 'group-hover:text-citragreen-500' }}">
                                Dasbor</p>
                        </div>
                        <i
                            class="bx bx-chevron-right text-2xl {{ request()->routeIs('umkm.dashboard') ? 'text-white' : 'group-hover:text-citragreen-500' }}"></i>
                    </a>
                </div>

                <!-- Laporan -->
                <div class="relative px-6 mt-3 py-1 flex justify-content-start w-full">
                    <div
                        class="{{ request()->routeIs('umkm.report.index') || request()->routeIs('umkm.report.labarugi') || request()->routeIs('umkm.report.neraca') || request()->routeIs('umkm.report.healthanalysis') ? 'w-full -left-3 top-0 h-full bg-citragreen-500 absolute rounded-r-full' : '' }}">
                    </div>
                    <a href="{{ route('umkm.report.index') }}"
                        class="w-full flex justify-between items-center z-10 group">
                        <div class="flex gap-2 items-center">
                            <i
                                class="bx bxs-bar-chart-square {{ request()->routeIs('umkm.report.index') || request()->routeIs('umkm.report.labarugi') || request()->routeIs('umkm.report.neraca') || request()->routeIs('umkm.report.healthanalysis') ? 'text-white' : 'text-citradark-500 group-hover:text-citragreen-500' }} text-3xl"></i>
                            <p
                                class="{{ request()->routeIs('umkm.report.index') || request()->routeIs('umkm.report.labarugi') || request()->routeIs('umkm.report.neraca') || request()->routeIs('umkm.report.healthanalysis') ? 'text-white' : 'group-hover:text-citragreen-500' }}">
                                Laporan</p>
                        </div>
                        <i
                            class="bx bx-chevron-right text-2xl {{ request()->routeIs('umkm.report.index') || request()->routeIs('umkm.report.labarugi') || request()->routeIs('umkm.report.neraca') || request()->routeIs('umkm.report.healthanalysis') ? 'text-white' : 'group-hover:text-citragreen-500' }}"></i>
                    </a>
                </div>

                <!-- Kas -->
                <div class="relative px-6 mt-6 py-1 flex justify-content-start w-full">
                    <div
                        class="{{ request()->routeIs('umkm.kas.send_money') || request()->routeIs('umkm.kas.transfer_fund') || request()->routeIs('umkm.kas.receive_money') || request()->routeIs('umkm.kas.index') || request()->routeIs('umkm.kas.create') || request()->routeIs('umkm.kas.edit') ? 'w-full -left-3 top-0 h-full bg-citragreen-500 absolute rounded-r-full' : '' }}">
                    </div>
                    <a href="{{ route('umkm.kas.index') }}"
                        class="w-full flex justify-between items-center z-10 group">
                        <div class="flex gap-2 items-center">
                            <i
                                class="bx bxs-bank {{ request()->routeIs('umkm.kas.send_money') || request()->routeIs('umkm.kas.transfer_fund') || request()->routeIs('umkm.kas.receive_money') || request()->routeIs('umkm.kas.index') || request()->routeIs('umkm.kas.create') || request()->routeIs('umkm.kas.edit') ? 'text-white' : 'text-citradark-500 group-hover:text-citragreen-500' }} text-3xl"></i>
                            <p
                                class="{{ request()->routeIs('umkm.kas.send_money') || request()->routeIs('umkm.kas.transfer_fund') || request()->routeIs('umkm.kas.receive_money') || request()->routeIs('umkm.kas.index') || request()->routeIs('umkm.kas.create') || request()->routeIs('umkm.kas.edit') ? 'text-white' : 'group-hover:text-citragreen-500' }}">
                                Kas</p>
                        </div>
                        <i
                            class="bx bx-chevron-right text-2xl {{ request()->routeIs('umkm.kas.send_money') || request()->routeIs('umkm.kas.transfer_fund') || request()->routeIs('umkm.kas.receive_money') || request()->routeIs('umkm.kas.index') || request()->routeIs('umkm.kas.create') || request()->routeIs('umkm.kas.edit') ? 'text-white' : 'group-hover:text-citragreen-500' }}"></i>
                    </a>
                </div>

                <!-- Sale -->
                <div class="relative px-6 mt-3 py-1 flex justify-content-start w-full">
                    <div
                        class="{{ request()->routeIs('umkm.sale.index') || request()->routeIs('umkm.sale.show') || request()->routeIs('umkm.sale.create') || request()->routeIs('umkm.sale.edit') ? 'w-full -left-3 top-0 h-full bg-citragreen-500 absolute rounded-r-full' : '' }}">
                    </div>
                    <a href="{{ route('umkm.sale.index') }}"
                        class="w-full flex justify-between items-center z-10 group">
                        <div class="flex gap-2 items-center">
                            <i
                                class="bx bxs-purchase-tag {{ request()->routeIs('umkm.sale.index') || request()->routeIs('umkm.sale.show') || request()->routeIs('umkm.sale.create') || request()->routeIs('umkm.sale.edit') ? 'text-white' : 'text-citradark-500 group-hover:text-citragreen-500' }} text-3xl"></i>
                            <p
                                class="{{ request()->routeIs('umkm.sale.index') || request()->routeIs('umkm.sale.show') || request()->routeIs('umkm.sale.create') || request()->routeIs('umkm.sale.edit') ? 'text-white' : 'group-hover:text-citragreen-500' }}">
                                Penjualan</p>
                        </div>
                        <i
                            class="bx bx-chevron-right text-2xl {{ request()->routeIs('umkm.sale.index') || request()->routeIs('umkm.sale.show') || request()->routeIs('umkm.sale.create') || request()->routeIs('umkm.sale.edit') ? 'text-white' : 'group-hover:text-citragreen-500' }}"></i>
                    </a>
                </div>

                <!-- Purchase -->
                <div class="relative px-6 mt-3 py-1 flex justify-content-start w-full">
                    <div
                        class="{{ request()->routeIs('umkm.purchase.index') || request()->routeIs('umkm.purchase.show') || request()->routeIs('umkm.purchase.create') || request()->routeIs('umkm.purchase.edit') ? 'w-full -left-3 top-0 h-full bg-citragreen-500 absolute rounded-r-full' : '' }}">
                    </div>
                    <a href="{{ route('umkm.purchase.index') }}"
                        class="w-full flex justify-between items-center z-10 group">
                        <div class="flex gap-2 items-center">
                            <i
                                class="bx bxs-cart {{ request()->routeIs('umkm.purchase.index') || request()->routeIs('umkm.purchase.show') || request()->routeIs('umkm.purchase.create') || request()->routeIs('umkm.purchase.edit') ? 'text-white' : 'text-citradark-500 group-hover:text-citragreen-500' }} text-3xl"></i>
                            <p
                                class="{{ request()->routeIs('umkm.purchase.index') || request()->routeIs('umkm.purchase.show') || request()->routeIs('umkm.purchase.create') || request()->routeIs('umkm.purchase.edit') ? 'text-white' : 'group-hover:text-citragreen-500' }}">
                                Pembelian</p>
                        </div>
                        <i
                            class="bx bx-chevron-right text-2xl {{ request()->routeIs('umkm.purchase.index') || request()->routeIs('umkm.purchase.show') || request()->routeIs('umkm.purchase.create') || request()->routeIs('umkm.purchase.edit') ? 'text-white' : 'group-hover:text-citragreen-500' }}"></i>
                    </a>
                </div>

                <!-- Cost -->
                <div class="relative px-6 mt-3 py-1 flex justify-content-start w-full">
                    <div
                        class="{{ request()->routeIs('umkm.cost.index') || request()->routeIs('umkm.cost.show') || request()->routeIs('umkm.cost.create') || request()->routeIs('umkm.cost.edit') ? 'w-full -left-3 top-0 h-full bg-citragreen-500 absolute rounded-r-full' : '' }}">
                    </div>
                    <a href="{{ route('umkm.cost.index') }}"
                        class="w-full flex justify-between items-center z-10 group">
                        <div class="flex gap-2 items-center">
                            <i
                                class="bx bxs-credit-card-front {{ request()->routeIs('umkm.cost.index') || request()->routeIs('umkm.cost.show') || request()->routeIs('umkm.cost.create') || request()->routeIs('umkm.cost.edit') ? 'text-white' : 'text-citradark-500 group-hover:text-citragreen-500' }} text-3xl"></i>
                            <p
                                class="{{ request()->routeIs('umkm.cost.index') || request()->routeIs('umkm.cost.show') || request()->routeIs('umkm.cost.create') || request()->routeIs('umkm.cost.edit') ? 'text-white' : 'group-hover:text-citragreen-500' }}">
                                Biaya</p>
                        </div>
                        <i
                            class="bx bx-chevron-right text-2xl {{ request()->routeIs('umkm.cost.index') || request()->routeIs('umkm.cost.show') || request()->routeIs('umkm.cost.create') || request()->routeIs('umkm.cost.edit') ? 'text-white' : 'group-hover:text-citragreen-500' }}"></i>
                    </a>
                </div>

                <!-- Contact -->
                <div class="relative px-6 mt-6 py-1 flex justify-content-start w-full">
                    <div
                        class="{{ request()->routeIs('umkm.contact.index') || request()->routeIs('umkm.contact.create') || request()->routeIs('umkm.contact.edit') ? 'w-full -left-3 top-0 h-full bg-citragreen-500 absolute rounded-r-full' : '' }}">
                    </div>
                    <a href="{{ route('umkm.contact.index') }}"
                        class="w-full flex justify-between items-center z-10 group">
                        <div class="flex gap-2 items-center">
                            <i
                                class="bx bxs-contact {{ request()->routeIs('umkm.contact.index') || request()->routeIs('umkm.contact.create') || request()->routeIs('umkm.contact.edit') ? 'text-white' : 'text-citradark-500 group-hover:text-citragreen-500' }} text-3xl"></i>
                            <p
                                class="{{ request()->routeIs('umkm.contact.index') || request()->routeIs('umkm.contact.create') || request()->routeIs('umkm.contact.edit') ? 'text-white' : 'group-hover:text-citragreen-500' }}">
                                Kontak</p>
                        </div>
                        <i
                            class="bx bx-chevron-right text-2xl {{ request()->routeIs('umkm.contact.index') || request()->routeIs('umkm.contact.create') || request()->routeIs('umkm.contact.edit') ? 'text-white' : 'group-hover:text-citragreen-500' }}"></i>
                    </a>
                </div>

                <!-- Product -->
                <div class="relative px-6 mt-3 py-1 flex justify-content-start w-full">
                    <div
                        class="{{ request()->routeIs('umkm.product.index') || request()->routeIs('umkm.product.create') || request()->routeIs('umkm.product.edit') ? 'w-full -left-3 top-0 h-full bg-citragreen-500 absolute rounded-r-full' : '' }}">
                    </div>
                    <a href="{{ route('umkm.product.index') }}"
                        class="w-full flex justify-between items-center z-10 group">
                        <div class="flex gap-2 items-center">
                            <i
                                class="bx bxs-package {{ request()->routeIs('umkm.product.index') || request()->routeIs('umkm.product.create') || request()->routeIs('umkm.product.edit') ? 'text-white' : 'text-citradark-500 group-hover:text-citragreen-500' }} text-3xl"></i>
                            <p
                                class="{{ request()->routeIs('umkm.product.index') || request()->routeIs('umkm.product.create') || request()->routeIs('umkm.product.edit') ? 'text-white' : 'group-hover:text-citragreen-500' }}">
                                Produk</p>
                        </div>
                        <i
                            class="bx bx-chevron-right text-2xl {{ request()->routeIs('umkm.product.index') || request()->routeIs('umkm.product.create') || request()->routeIs('umkm.product.edit') ? 'text-white' : 'group-hover:text-citragreen-500' }}"></i>
                    </a>
                </div>

                <!-- Asset -->
                <div class="relative px-6 mt-3 py-1 flex justify-content-start w-full">
                    <div
                        class="{{ request()->routeIs('umkm.asset.index') || request()->routeIs('umkm.asset.create') || request()->routeIs('umkm.asset.edit') ? 'w-full -left-3 top-0 h-full bg-citragreen-500 absolute rounded-r-full' : '' }}">
                    </div>
                    <a href="{{ route('umkm.asset.index') }}"
                        class="w-full flex justify-between items-center z-10 group">
                        <div class="flex gap-2 items-center">
                            <i
                                class="bx bxs-building-house {{ request()->routeIs('umkm.asset.index') || request()->routeIs('umkm.asset.create') || request()->routeIs('umkm.asset.edit') ? 'text-white' : 'text-citradark-500 group-hover:text-citragreen-500' }} text-3xl"></i>
                            <p
                                class="{{ request()->routeIs('umkm.asset.index') || request()->routeIs('umkm.asset.create') || request()->routeIs('umkm.asset.edit') ? 'text-white' : 'group-hover:text-citragreen-500' }}">
                                Aset</p>
                        </div>
                        <i
                            class="bx bx-chevron-right text-2xl {{ request()->routeIs('umkm.asset.index') || request()->routeIs('umkm.asset.create') || request()->routeIs('umkm.asset.edit') ? 'text-white' : 'group-hover:text-citragreen-500' }}"></i>
                    </a>
                </div>

                <!-- COA -->
                <div class="relative px-6 mt-3 py-1 flex justify-content-start w-full">
                    <div
                        class="{{ request()->routeIs('umkm.coa.index') || request()->routeIs('umkm.coa.show') || request()->routeIs('umkm.coa.create') || request()->routeIs('umkm.coa.edit') ? 'w-full -left-3 top-0 h-full bg-citragreen-500 absolute rounded-r-full' : '' }}">
                    </div>
                    <a href="{{ route('umkm.coa.index') }}"
                        class="w-full flex justify-between items-center z-10 group">
                        <div class="flex gap-2 items-center">
                            <i
                                class="bx bxs-food-menu {{ request()->routeIs('umkm.coa.index') || request()->routeIs('umkm.coa.show') || request()->routeIs('umkm.coa.create') || request()->routeIs('umkm.coa.edit') ? 'text-white' : 'text-citradark-500 group-hover:text-citragreen-500' }} text-3xl"></i>
                            <p
                                class="{{ request()->routeIs('umkm.coa.index') || request()->routeIs('umkm.coa.show') || request()->routeIs('umkm.coa.create') || request()->routeIs('umkm.coa.edit') ? 'text-white' : 'group-hover:text-citragreen-500' }}">
                                Akun (COA)</p>
                        </div>
                        <i
                            class="bx bx-chevron-right text-2xl {{ request()->routeIs('umkm.coa.index') || request()->routeIs('umkm.coa.show') || request()->routeIs('umkm.coa.create') || request()->routeIs('umkm.coa.edit') ? 'text-white' : 'group-hover:text-citragreen-500' }}"></i>
                    </a>
                </div>

                <!-- Daftar Transaksi -->
                <div class="relative px-6 mt-6 py-1 flex justify-content-start w-full">
                    <div
                        class="{{ request()->routeIs('umkm.alltransactions') || request()->routeIs('umkm.showtransaction') ? 'w-full -left-3 top-0 h-full bg-citragreen-500 absolute rounded-r-full' : '' }}">
                    </div>
                    <a href="{{ route('umkm.alltransactions') }}"
                        class="w-full flex justify-between items-center z-10 group">
                        <div class="flex gap-2 items-center">
                            <i
                                class="bx bxs-book-content {{ request()->routeIs('umkm.alltransactions') || request()->routeIs('umkm.showtransaction') ? 'text-white' : 'text-citradark-500 group-hover:text-citragreen-500' }} text-3xl"></i>
                            <p
                                class="{{ request()->routeIs('umkm.alltransactions') || request()->routeIs('umkm.showtransaction') ? 'text-white' : 'group-hover:text-citragreen-500' }}">
                                Daftar Transaksi</p>
                        </div>
                        <i
                            class="bx bx-chevron-right text-2xl {{ request()->routeIs('umkm.alltransactions') || request()->routeIs('umkm.showtransaction') ? 'text-white' : 'group-hover:text-citragreen-500' }}"></i>
                    </a>
                </div>


            </div>
            <div class="w-1/4"></div>
            <div class="w-full">
                <div class="w-4/5 z-10 fixed right-0 flex justify-between bg-white shadow-md">
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
                                    <i class="bx bxs-user-circle text-2xl text-citragreen-500 mr-1"></i>
                                    <div class="text-base">{{ Auth::user()->name }}</div>

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
                <main class="mt-20">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $('#menu-toggle').click(function() {
                $('#thisisnav').toggleClass('hidden');
                $('div').toggleClass('w-16 sm:w-48');
            });
        });
    </script>

</body>

</html>
