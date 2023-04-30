@extends('layouts.pdf')
@section('content')
    <div class="text-center">
        <h1 class="text-2xl font-bold">
            Analisa Kesehatan Keuangan Altman Z-Score
        </h1>
        <p class="text-lg">
            Perusahaan {{ Auth::user()->umkm->name }}
        </p>
    </div>
    <div class="mt-10">
        <p class="text-lg font-bold">
            Nilai Z-Score:
            {{ AppHelper::decimal($zscore) }}
        </p>
        <div class="mt-2">
            <p>
                kondisi kesehatan UMKM berdasarkan periode,
            </p>
            @if ($zscore > 2.6)
                <h1 class="text-2xl font-semibold text-citragreen-500">
                    Sehat
                </h1>
            @elseif ($zscore < 1.8)
                <h1 class="text-2xl font-semibold text-citrared-500">
                    Bangkrut
                </h1>
            @else
                <h1 class="text-2xl font-semibold text-citrayellow-500">
                    Berpotensi Bangkrut
                </h1>
            @endif
        </div>
        <div class="mt-2">
            <h2 class="text-lg font-bold">
                Rekomendasi
            </h2>
            <p>
                Rekomendasi terkait kesehatan rasio keuangan UMKM milik anda.
            </p>
            <div class="mt-3 flex flex-col gap-3">
                @foreach ($advices as $advice)
                    <ul class="p-2 list-disc ml-5">
                        <li>{{ $advice }}</li>
                    </ul>
                @endforeach
            </div>
        </div>
    </div>


    <h2 class="text-lg mt-4 font-bold">
        Rincian Perhitungan Perhitungan Analisis Rasio Keuangan
    </h2>
    <table class="mt-4 w-full">
        <tr class="font-bold">
            <td>
                Tanggal
            </td>
            <td class="text-right">
                {{ $date }}-{{ $due_date }}
            </td>
        </tr>
    </table>
    <table class="mt-4 w-full">
        <tr class="font-bold">
            <td>
                6.56 X1
            </td>
        </tr>
        <tr>
            <td>
                <span>&nbsp;&nbsp;&nbsp;</span>
                Aset lancar
            </td>
            <td class="text-right">
                {{ AppHelper::rp($aset_lancar ?? 0) }}
            </td>
        </tr>
        <tr>
            <td>
                <span>&nbsp;&nbsp;&nbsp;</span>
                Liabilitas jangka pendek
            </td>
            <td class="text-right">
                {{ AppHelper::rp($liabilitas_pendek ?? 0) }}
            </td>
        </tr>
        <tr>
            <td>
                <span>&nbsp;&nbsp;&nbsp;</span>
                Modal Kerja
            </td>
            <td class="text-right">
                {{ AppHelper::rp($aset_lancar - $liabilitas_pendek ?? 0) }}
            </td>
        </tr>
        <tr>
            <td>
                <span>&nbsp;&nbsp;&nbsp;</span>
                Total Aset
            </td>
            <td class="text-right">
                {{ AppHelper::rp($total_aset ?? 0) }}
            </td>
        </tr>
        <tr>
            <td>
                <span>&nbsp;&nbsp;&nbsp;</span>
                X1 (Modal Kerja/Total Aset)
            </td>
            <td class="text-right">
                {{ AppHelper::decimal($total_aset != 0 ? ($aset_lancar - $liabilitas) / $total_aset : 0) }}
            </td>
        </tr>
    </table>

    <hr class="my-3">

    <table class="w-full">
        <tr>
            <td class="font-bold">
                6.56 X1
            </td>
            <td class="font-bold text-right">
                {{ AppHelper::decimal($total_aset != 0 ? (($aset_lancar - $liabilitas) / $total_aset) * 6.56 : 0) }}
            </td>
        </tr>
    </table>

    <hr class="my-3">

    <table class="w-full">
        <tr class="font-bold">
            <td>
                3.26 X2
            </td>
        </tr>
        <tr>
            <td>
                <span>&nbsp;&nbsp;&nbsp;</span>
                Laba Ditahan
            </td>
            <td class="text-right">
                {{ AppHelper::rp($laba_ditahan ?? 0) }}
            </td>
        </tr>
        <tr>
            <td>
                <span>&nbsp;&nbsp;&nbsp;</span>
                Total Aset
            </td>
            <td class="text-right">
                {{ AppHelper::rp($total_aset ?? 0) }}
            </td>
        </tr>
        <tr>
            <td>
                <span>&nbsp;&nbsp;&nbsp;</span>
                X2 (Laba Operasional/Total Aset)
            </td>
            <td class="text-right">
                {{ AppHelper::decimal($total_aset != 0 ? $laba_ditahan / $total_aset : 0) }}
            </td>
        </tr>
    </table>

    <hr class="my-3">

    <table class="w-full">
        <tr class="font-bold">
            <td>
                <span>&nbsp;&nbsp;&nbsp;</span>
                3.26 X2
            </td>
            <td class="text-right">
                {{ AppHelper::decimal($total_aset != 0 ? 3.26 * ($laba_operasional / $total_aset) : 0) }}
            </td>
        </tr>
    </table>

    <hr class="my-3">

    <table class="w-full">
        <tr class="font-bold">
            <td>
                6.72 X3
            </td>
        </tr>
        <tr>
            <td>
                <span>&nbsp;&nbsp;&nbsp;</span>
                Laba Operasional
            </td>
            <td class="text-right">
                {{ AppHelper::rp($laba_operasional ?? 0) }}
            </td>
        </tr>
        <tr>
            <td>
                <span>&nbsp;&nbsp;&nbsp;</span>
                Total Aset
            </td>
            <td class="text-right">
                {{ AppHelper::rp($total_aset ?? 0) }}
            </td>
        </tr>
        <tr>
            <td>
                <span>&nbsp;&nbsp;&nbsp;</span>
                X3 (Laba Operasional/Total Aset)
            </td>
            <td class="text-right">
                {{ AppHelper::decimal($total_aset != 0 ? $laba_operasional / $total_aset : 0) }}
            </td>
        </tr>
    </table>

    <hr class="my-3">

    <table class="w-full">
        <tr class="font-bold">
            <td>
                <span>&nbsp;&nbsp;&nbsp;</span>
                6.72 X3
            </td>
            <td class="text-right">
                {{ AppHelper::decimal($total_aset != 0 ? 6.72 * ($laba_operasional / $total_aset) : 0) }}
            </td>
        </tr>
    </table>

    <hr class="my-3">

    <table class="w-full">
        <tr class="font-bold">
            <td>
                1.05 X4
            </td>
        </tr>
        <tr>
            <td>
                <span>&nbsp;&nbsp;&nbsp;</span>
                Modal Disetor
            </td>
            <td class="text-right">
                {{ AppHelper::rp($modal_disetor ?? 0) }}
            </td>
        </tr>
        <tr>
            <td>
                <span>&nbsp;&nbsp;&nbsp;</span>
                Total Liabilitas
            </td>
            <td class="text-right">
                {{ AppHelper::rp($liabilitas ?? 0) }}
            </td>
        </tr>
        <tr>
            <td>
                X4 (Modal Disetor/Total Liabilitas)
            </td>
            <td class="text-right">
                {{ AppHelper::decimal($liabilitas != 0 ? $modal_disetor / $liabilitas : 0) }}
            </td>
        </tr>
    </table>

    <hr class="my-3">

    <table class="w-full">
        <tr class="font-bold">
            <td>
                <span>&nbsp;&nbsp;&nbsp;</span>
                1.05 X4
            </td>
            <td class="text-right">
                {{ AppHelper::decimal($liabilitas != 0 ? 1.05 * ($modal_disetor / $liabilitas) : 0) }}
            </td>
        </tr>
    </table>

    <hr class="my-3">

    <table class="w-full">
        <tr class="font-bold">
            <td>
                Z-Score
            </td>
        </tr>
        <tr>
            <td class="italic">
                <span>&nbsp;&nbsp;&nbsp;</span>
                6.56 X1
            </td>
            <td class="text-right">
                {{ AppHelper::decimal($x1) }}
            </td>
        </tr>
        <tr>
            <td class="italic">
                <span>&nbsp;&nbsp;&nbsp;</span>
                3.26 X2
            </td>
            <td class="text-right">
                {{ AppHelper::decimal($x2) }}
            </td>
        </tr>
        <tr>
            <td class="italic">
                <span>&nbsp;&nbsp;&nbsp;</span>
                6.72 X3
            </td>
            <td class="text-right">
                {{ AppHelper::decimal($x3) }}
            </td>
        </tr>
        <tr>
            <td class="italic">
                <span>&nbsp;&nbsp;&nbsp;</span>
                1.05 X4
            </td>
            <td class="text-right">
                {{ AppHelper::decimal($x4) }}
            </td>
        </tr>
    </table>

    <hr class="my-3">

    <table class="w-full">
        <tr class="font-bold">
            <td>
                Z-Score
            </td>
            <td class="text-right">
                {{ AppHelper::decimal($zscore) }}
            </td>
        </tr>
    </table>
@endsection
