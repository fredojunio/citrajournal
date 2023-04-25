<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Keuangan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white overflow-hidden shadow-md sm:rounded-md">
                    <div class="px-4 py-4">
                        <h3 class="font-bold">Laporan Laba Rugi</h3>
                        <p class="mt-2">Laporan laba rugi merupakan laporan yang berisi pos pendapatan dan beban, laba
                            atau rugi yang
                            dimiliki oleh suatu perusahaan dalam periode tertentu.</p>
                        <form action="{{ route('umkm.report.labarugi') }}" method="get">
                            <x-primary-button class="mt-4">
                                Lihat Laporan
                            </x-primary-button>
                        </form>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-md sm:rounded-md">
                    <div class="px-4 py-4">
                        <h3 class="font-bold">Laporan Posisi Keuangan (neraca)</h3>
                        <p class="mt-2">Laporan posisi keuangan (neraca) merupakan laporan yang berisi tentang aset,
                            liabilitas, dan ekuitas dari suatu perusahaan pada akhir periode tertentu.</p>
                        <form action="{{ route('umkm.report.neraca') }}" method="get">
                            <x-primary-button class="mt-4">
                                Lihat Laporan
                            </x-primary-button>
                        </form>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-md sm:rounded-md">
                    <div class="px-4 py-4">
                        <h3 class="font-bold">Rekomendasi terkait Kesehatan UMKM (Altman Z-Score)</h3>
                        <p class="mt-2">Dapatkan rekomendasi terkait kondisi kesehatan UMKM milikmu saat ini
                            berdasarkan analisis kesehatan menggunakan Altman Z-Score. Saran
                            ini dapat kamu terapkan untuk memperbaiki kinerja UMKM.</p>
                        <form action="{{ route('umkm.report.healthanalysis') }}" method="get">
                            <x-primary-button class="mt-4">
                                Lihat Laporan
                            </x-primary-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
