@extends('layouts.pdf')
@section('content')
    <div class="text-center">
        <h1 class="text-2xl font-bold">
            Laporan Neraca
        </h1>
        <p class="text-lg">
            Perusahaan {{ Auth::user()->umkm->name }}
        </p>
    </div>
    <table class="w-full mt-10">
        <tr>
            <td class="font-bold">Tanggal</td>
            <td class="font-bold text-right">{{ $date }}</td>
        </tr>
    </table>
    <table class="mt-4 w-full">
        <tr class="font-bold">
            <td>
                Aset
            </td>
        </tr>
        <tr class="font-bold">
            <td>
                <span>&nbsp;&nbsp;&nbsp;</span>
                Aset Lancar
            </td>
        </tr>
        @foreach ($aset_lancar as $al)
            <tr>
                <td>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    {{ $al->code }}
                    <span class="ml-4">
                        {{ $al->name }}
                    </span>
                </td>
                <td class="text-right">
                    {{ AppHelper::rp($al->balance() ?? 0) }}
                </td>
            </tr>
        @endforeach
    </table>

    <hr class="my-3">

    <table class="w-full">
        <tr class="font-bold">
            <td>
                Total Aset Lancar
            </td>
            <td class="text-right">
                {{ AppHelper::rp($aset_lancar->map->balance()->sum() ?? 0) }}
            </td>
        </tr>
    </table>
    <table class="mt-4 w-full">
        <tr class="font-bold">
            <td>
                <span>&nbsp;&nbsp;&nbsp;</span>
                Aset Tetap
            </td>
        </tr>
        @foreach ($aset_tetap as $at)
            <tr>
                <td>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    {{ $at->code }}
                    <span class="ml-4">
                        {{ $at->name }}
                    </span>
                </td>
                <td class="text-right">
                    {{ AppHelper::rp($at->balance() ?? 0) }}
                </td>
            </tr>
        @endforeach
    </table>

    <hr class="my-3">

    <table class="w-full">
        <tr class="font-bold">
            <td>
                <span>&nbsp;&nbsp;&nbsp;</span>
                Total Aset Tetap
            </td>
            <td class="text-right">
                {{ AppHelper::rp($aset_tetap->map->balance()->sum() ?? 0) }}
            </td>
        </tr>
    </table>

    <hr class="my-3">

    <table class="w-full">
        <tr class="font-bold">
            <td>
                Total Aset
            </td>
            <td class="text-right">
                {{ AppHelper::rp($aset_lancar->map->balance()->sum() + $aset_tetap->map->balance()->sum() ?? 0) }}
            </td>
        </tr>
    </table>

    <table class="mt-4 w-full">
        <tr class="font-bold">
            <td>
                Liabilitas dan Modal
            </td>
        </tr>
        <tr class="font-bold">
            <td>
                <span>&nbsp;&nbsp;&nbsp;</span>
                Liabilitas Jangka Pendek
            </td>
        </tr>
        @foreach ($liabilitas_pendek as $lp)
            <tr>
                <td>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    {{ $lp->code }}
                    <span class="ml-4">
                        {{ $lp->name }}
                    </span>
                </td>
                <td class="text-right">
                    {{ AppHelper::rp($lp->balance() ?? 0) }}
                </td>
            </tr>
        @endforeach

    </table>

    <hr class="my-3">

    <table class="w-full">
        <tr class="font-bold">
            <td>
                <span>&nbsp;&nbsp;&nbsp;</span>
                Liabilitas Jangka Pendek
            </td>
            <td class="text-right">
                {{ AppHelper::rp($liabilitas_pendek->map->balance()->sum() ?? 0) }}
            </td>
        </tr>
    </table>

    <hr class="my-3">

    <table class="w-full">
        <tr class="font-bold">
            <td>
                <span>&nbsp;&nbsp;&nbsp;</span>
                Total Liabilitas
            </td>
            <td class="text-right">
                {{ AppHelper::rp($liabilitas_pendek->map->balance()->sum() ?? 0) }}
            </td>
        </tr>
    </table>

    <div class="mt-10">
        <table class="w-full">
            <tr class="font-bold">
                <td>
                    <span>&nbsp;&nbsp;&nbsp;</span>
                    Modal Pemilik
                </td>
            </tr>
            @foreach ($modal_saham as $ms)
                <tr>
                    <td>
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        {{ $ms->code }}
                        <span class="ml-4">
                            {{ $ms->name }}
                        </span>
                    </td>
                    <td class="text-right">
                        {{ AppHelper::rp($ms->balance() ?? 0) }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td class="">
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <span class="ml-5">Pendapatan lain</span>
                </td>
                <td class="text-right">
                    {{ AppHelper::rp($pendapatan_lain->map->balance()->sum() ?? 0) }}
                </td>
            </tr>
            <tr>
                <td>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <span class="ml-5">Pendapatan tahun lalu</span>
                </td>
                <td class="text-right">
                    Rp. 0,-
                </td>
            </tr>
            <tr>
                <td>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <span class="ml-5">Pendapatan periode ini</span>
                </td>
                <td class="text-right">
                    {{ AppHelper::rp($labarugi ?? 0) }}
                </td>
            </tr>
        </table>
    </div>

    <hr class="my-3">

    <table class="w-full">
        <tr class="font-bold">
            <td>
                Total Modal Pemilik
            </td>
            <td class="text-right">
                {{ AppHelper::rp($modal_saham->map->balance()->sum() + $labarugi ?? 0) }}
            </td>
        </tr>
    </table>

    <hr class="my-3">

    <table class="w-full">
        <tr class="font-bold">
            <td>
                Total Liabilitas dan Modal
            </td>
            <td class="text-right">
                {{ AppHelper::rp($liabilitas_pendek->map->balance()->sum() + $modal_saham->map->balance()->sum() + $labarugi ?? 0) }}
            </td>
        </tr>
    </table>
@endsection
