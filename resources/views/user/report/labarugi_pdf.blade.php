@extends('layouts.pdf')
@section('content')
    <div class="text-center">
        <h1 class="text-2xl font-bold">
            Laporan Laba Rugi
        </h1>
        <p class="text-lg">
            Perusahaan {{ Auth::user()->umkm->name }}
        </p>
    </div>
    <table class="w-full mt-10">
        <tr>
            <td class="font-bold">Tanggal Periode</td>
            <td class="font-bold text-right">{{ $date }}-{{ $due_date }}</td>
        </tr>
    </table>
    <table class="mt-4 w-full">
        <tr class="font-bold">
            <td>
                Pendapatan
            </td>
        </tr>
        @foreach ($pendapatan as $p)
            <tr>
                <td>
                    <span>&nbsp;&nbsp;&nbsp;</span>
                    {{ $p->code }}
                    <span class="ml-4">{{ $p->name }}</span>
                </td>
                <td class="text-right">
                    {{ AppHelper::rp($p->balance()) }}
                </td>
            </tr>
        @endforeach
    </table>
    <hr class="my-3">
    <table class="w-full">
        <tr>
            <td>
                <span>&nbsp;&nbsp;&nbsp;</span>
                Total Pendapatan
            </td>
            <td class="text-right font-bold">
                {{ AppHelper::rp($pendapatan->map->balance()->sum() ?? 0) }}
            </td>
        </tr>
    </table>
    <table class="mt-4 w-full">
        <tr class="font-bold">
            <td>
                Beban Pendapatan
            </td>
        </tr>
        @foreach ($beban_pendapatan as $bp)
            <tr>
                <td>
                    <span>&nbsp;&nbsp;&nbsp;</span>

                    {{ $bp->code }}
                    <span class="ml-4">{{ $bp->name }}</span>
                </td>
                <td class="text-right">
                    {{ AppHelper::rp($bp->balance() ?? 0) }}
                </td>
            </tr>
        @endforeach
    </table>
    <hr class="my-3">
    <table class="w-full">
        <tr>
            <td>
                <span>&nbsp;&nbsp;&nbsp;</span>

                Total Beban Pendapatan
            </td>
            <td class="font-bold text-right">
                {{ AppHelper::rp($beban_pendapatan->map->balance()->sum() ?? 0) }}
            </td>
        </tr>

    </table>
    <hr class="my-3">
    <table class="w-full">
        <tr>
            <td class="font-bold">
                Laba Kotor
            </td>
            <td class="font-bold text-right">
                {{ AppHelper::rp($pendapatan->map->balance()->sum() - $beban_pendapatan->map->balance()->sum() ?? 0) }}
            </td>
        </tr>
    </table>
    <table class="mt-4 w-full">
        <tr class="font-bold">
            <td>
                Biaya Usaha
            </td>
        </tr>
        @foreach ($beban_operasional as $bp)
            <tr>
                <td>
                    <span>&nbsp;&nbsp;&nbsp;</span>
                    {{ $bp->code }}
                    <span class="ml-4"> {{ $bp->name }}</span>
                </td>
                <td class="text-right">
                    {{ AppHelper::rp($bp->balance() ?? 0) }}
                </td>
            </tr>
        @endforeach
    </table>
    <hr class="my-3">
    <table class="w-full">
        <tr>
            <td>
                <span>&nbsp;&nbsp;&nbsp;</span>
                Total Biaya Usaha
            </td>
            <td class="font-bold text-right">
                {{ AppHelper::rp($beban_operasional->map->balance()->sum() ?? 0) }}
            </td>
        </tr>
    </table>
    <hr class="my-3">
    <table class="w-full">
        <tr>
            <td class="font-bold">
                Laba Operasional
            </td>
            <td class="font-bold text-right">
                {{ AppHelper::rp($pendapatan->map->balance()->sum() - $beban_pendapatan->map->balance()->sum() - $beban_operasional->map->balance()->sum() ?? 0) }}
            </td>
        </tr>
    </table>
    <table class="mt-4 w-full">
        <tr class="font-bold">
            <td>
                Pendapatan dan Biaya Diluar Usaha
            </td>
        </tr>
        <tr>
            <td>
                <span>&nbsp;&nbsp;&nbsp;</span>
                Pendapatan Diluar Usaha
            </td>
            <td class="text-right">
                {{ AppHelper::rp($pendapatan_lain->map->balance()->sum() ?? 0) }}
            </td>
        </tr>
        <tr>
            <td>
                <span>&nbsp;&nbsp;&nbsp;</span>
                Biaya Diluar Usaha
            </td>
            <td class="text-right">
                {{ AppHelper::rp($beban_lain->map->balance()->sum() ?? 0) }}
            </td>
        </tr>
    </table>
    <hr class="my-3">
    <table class="w-full">
        <tr>
            <td>
                <span>&nbsp;&nbsp;&nbsp;</span>
                Total Pendapatan (Biaya Diluar Usaha)
            </td>
            <td class="font-bold text-right">
                {{ AppHelper::rp($pendapatan_lain->map->balance()->sum() - $beban_lain->map->balance()->sum() ?? 0) }}
            </td>
        </tr>
    </table>
    <hr class="my-3">
    <table class="w-full">
        <tr class="font-bold">
            <td>
                Laba (Rugi)
            </td>
            <td class="text-right">
                {{ AppHelper::rp(
                    $pendapatan->map->balance()->sum() -
                        $beban_pendapatan->map->balance()->sum() -
                        $beban_operasional->map->balance()->sum() +
                        ($pendapatan_lain->map->balance()->sum() - $beban_lain->map->balance()->sum()) ??
                        0,
                ) }}
            </td>
        </tr>
    </table>
@endsection
