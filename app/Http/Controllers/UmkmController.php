<?php

namespace App\Http\Controllers;

use App\Models\Coa;
use App\Models\Umkm;
use App\Models\User_Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $umkms = Umkm::where('user_id', Auth::user()->id)->get();
        if (!empty($umkms[0])) {
            return view('user.umkm.umkm', compact('umkms'));
        }

        return view('user.umkm.create_umkm');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.umkm.create_umkm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . Umkm::class],
        ]);

        $umkm = Umkm::create($request->all());
        $this->generateCoa($umkm->id);

        return redirect()->route('umkm.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Umkm $umkm)
    {
        return view('user.umkm.show_umkm', compact('umkm'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Umkm $umkm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Umkm $umkm)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $umkm->update($request->all());
        return redirect()->route('umkm.show', $umkm);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Umkm $umkm)
    {
        //
    }

    public function save_umkm(Request $request)
    {
        $manage_umkm = User_Umkm::where('user_id', Auth::user()->id)->get();
        if (!empty($manage_umkm[0])) {
            $manage_umkm[0]->update([
                'umkm_id' => $request->umkm_id
            ]);
        } else {
            User_Umkm::create([
                'user_id' => Auth::user()->id,
                'umkm_id' => $request->umkm_id
            ]);
        }

        return redirect()->route('umkm.dashboard');
    }

    public function generateCoa($umkm_id): void
    {
        Coa::create([
            'code' => '1-10001',
            'name' => 'Kas',
            'category_id' => 1,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10002',
            'name' => 'Rekening Bank',
            'category_id' => 1,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10100',
            'name' => 'Piutang Usaha',
            'category_id' => 2,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10101',
            'name' => 'Piutang Belum Ditagih',
            'category_id' => 2,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10200',
            'name' => 'Persediaan Barang',
            'category_id' => 3,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10300',
            'name' => 'Piutang Lainnya',
            'category_id' => 4,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10301',
            'name' => 'Piutang Karyawan',
            'category_id' => 4,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10400',
            'name' => 'Dana Belum Disetor',
            'category_id' => 4,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10401',
            'name' => 'Aset Lancar Lainnya',
            'category_id' => 4,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10402',
            'name' => 'Biaya Dibayar Di Muka',
            'category_id' => 4,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10403',
            'name' => 'Uang Muka',
            'category_id' => 4,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10500',
            'name' => 'PPN Masukan',
            'category_id' => 4,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10501',
            'name' => 'Pajak Dibayar Di Muka - PPh 22',
            'category_id' => 4,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10502',
            'name' => 'Pajak Dibayar Di Muka - PPh 23',
            'category_id' => 4,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10503',
            'name' => 'Pajak Dibayar Di Muka - PPh 25',
            'category_id' => 4,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10700',
            'name' => 'Aset Tetap - Tanah',
            'category_id' => 5,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10701',
            'name' => 'Aset Tetap - Bangunan',
            'category_id' => 5,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10702',
            'name' => 'Aset Tetap - Building Improvements',
            'category_id' => 5,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10703',
            'name' => 'Aset Tetap - Kendaraan',
            'category_id' => 5,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10704',
            'name' => 'Aset Tetap - Mesin & Peralatan',
            'category_id' => 5,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10705',
            'name' => 'Aset Tetap - Perlengkapan Kantor',
            'category_id' => 5,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10706',
            'name' => 'Aset Tetap - Aset Sewa Guna Usaha',
            'category_id' => 5,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10707',
            'name' => 'Aset Tak Berwujud',
            'category_id' => 5,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10751',
            'name' => 'Akumulasi Penyusutan - Bangunan',
            'category_id' => 6,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10752',
            'name' => 'Akumulasi Penyusutan - Building Improvements',
            'category_id' => 6,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10753',
            'name' => 'Akumulasi penyusutan - Kendaraan',
            'category_id' => 6,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10754',
            'name' => 'Akumulasi Penyusutan - Mesin & Peralatan',
            'category_id' => 6,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10755',
            'name' => 'Akumulasi Penyusutan - Peralatan Kantor',
            'category_id' => 6,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10756',
            'name' => 'Akumulasi Penyusutan - Aset Sewa Guna Usaha',
            'category_id' => 6,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10757',
            'name' => 'Akumulasi Amortisasi',
            'category_id' => 6,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '1-10800',
            'name' => 'Investasi',
            'category_id' => 7,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '2-20100',
            'name' => 'Hutang Usaha',
            'category_id' => 8,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '2-20101',
            'name' => 'Hutang Belum Ditagih',
            'category_id' => 8,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '2-20200',
            'name' => 'Hutang Lain Lain',
            'category_id' => 9,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '2-20201',
            'name' => 'Hutang Gaji',
            'category_id' => 9,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '2-20202',
            'name' => 'Hutang Deviden',
            'category_id' => 9,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '2-20203',
            'name' => 'Pendapatan Diterima Di Muka',
            'category_id' => 9,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '2-20301',
            'name' => 'Sarana Kantor Terhutang',
            'category_id' => 9,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '2-20302',
            'name' => 'Bunga Terhutang',
            'category_id' => 9,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '2-20399',
            'name' => 'Biaya Terhutang Lainnya',
            'category_id' => 9,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '2-20400',
            'name' => 'Hutang Bank',
            'category_id' => 9,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '2-20500',
            'name' => 'PPN Keluaran',
            'category_id' => 9,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '2-20501',
            'name' => 'Hutang Pajak - PPh 21',
            'category_id' => 9,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '2-20502',
            'name' => 'Hutang Pajak - PPh 22',
            'category_id' => 9,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '2-20503',
            'name' => 'Hutang Pajak - PPh 23',
            'category_id' => 9,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '2-20504',
            'name' => 'Hutang Pajak - PPh 29',
            'category_id' => 9,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '2-20599',
            'name' => 'Hutang Pajak Lainnya',
            'category_id' => 9,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '2-20600',
            'name' => 'Hutang dari Pemegang Saham',
            'category_id' => 9,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '2-20601',
            'name' => 'Kewajiban Lancar Lainnya',
            'category_id' => 9,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '2-20700',
            'name' => 'Kewajiban Manfaat Karyawan',
            'category_id' => 10,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '3-30000',
            'name' => 'Modal Saham',
            'category_id' => 11,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '3-30001',
            'name' => 'Tambahan Modal Disetor',
            'category_id' => 11,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '3-30100',
            'name' => 'Laba Ditahan',
            'category_id' => 11,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '3-30200',
            'name' => 'Deviden',
            'category_id' => 11,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '3-30300',
            'name' => 'Pendapatan Komprehensif Lainnya',
            'category_id' => 11,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '3-30999',
            'name' => 'Ekuitas Saldo Awal',
            'category_id' => 11,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '4-40000',
            'name' => 'Pendapatan',
            'category_id' => 12,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '4-40100',
            'name' => 'Diskon Penjualan',
            'category_id' => 12,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '4-40200',
            'name' => 'Retur Penjualan',
            'category_id' => 12,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '4-40201',
            'name' => 'Pendapatan Belum Ditagih',
            'category_id' => 12,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '5-50000',
            'name' => 'Beban Pokok Pendapatan',
            'category_id' => 13,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '5-50100',
            'name' => 'Diskon Pembelian',
            'category_id' => 13,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '5-50200',
            'name' => 'Retur Pembelian',
            'category_id' => 13,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '5-50300',
            'name' => 'Pengiriman & Pengangkutan',
            'category_id' => 13,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '5-50400',
            'name' => 'Biaya Impor',
            'category_id' => 13,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '5-50500',
            'name' => 'Biaya Produksi',
            'category_id' => 13,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60000',
            'name' => 'Biaya Penjualan',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60001',
            'name' => 'Iklan & Promosi',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60002',
            'name' => 'Komisi & Fee',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60003',
            'name' => 'Bensin, Tol dan Parkir - Penjualan',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60004',
            'name' => 'Perjalanan Dinas - Penjualan',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60005',
            'name' => 'Komunikasi - Penjualan',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60006',
            'name' => 'Marketing Lainnya',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60100',
            'name' => 'Biaya Umum & Administratif',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60101',
            'name' => 'Gaji',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60102',
            'name' => 'Upah',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60103',
            'name' => 'Makanan & Transportasi',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60104',
            'name' => 'Lembur',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60105',
            'name' => 'Pengobatan',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60106',
            'name' => 'THR & Bonus',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60107',
            'name' => 'Jamsostek',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60108',
            'name' => 'Insentif',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60109',
            'name' => 'Pesangon',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60110',
            'name' => 'Manfaat dan Tunjangan Lain',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60200',
            'name' => 'Donasi',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60201',
            'name' => 'Hiburan',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60203',
            'name' => 'Perbaikan & Pemeliharaan',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60204',
            'name' => 'Perjalanan Dinas - Umum',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60205',
            'name' => 'Makanan',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60206',
            'name' => 'Komunikasi - Umum',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60207',
            'name' => 'Iuran & Langganan',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60208',
            'name' => 'Asuransi',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60209',
            'name' => 'Legal & Profesional',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60210',
            'name' => 'Beban Manfaat Karyawan',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60211',
            'name' => 'Sarana Kantor',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60212',
            'name' => 'Pelatihan & Pengembangan',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60213',
            'name' => 'Beban Piutang Tak Tertagih',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60214',
            'name' => 'Pajak dan Perizinan',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60215',
            'name' => 'Denda',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60300',
            'name' => 'Beban Kantor',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60301',
            'name' => 'Alat Tulis Kantor & Printing',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60302',
            'name' => 'Bea Materai',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60303',
            'name' => 'Keamanan dan Kebersihan',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60304',
            'name' => 'Supplies dan Material',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60305',
            'name' => 'Pemborong',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60400',
            'name' => 'Biaya Sewa - Bangunan',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60401',
            'name' => 'Biaya Sewa - Kendaraan',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60402',
            'name' => 'Biaya Sewa - Operasional',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60403',
            'name' => 'Biaya Sewa - Lain - lain',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60500',
            'name' => 'Penyusutan - Bangunan',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60501',
            'name' => 'Penyusutan - Perbaikan Bangunan',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60502',
            'name' => 'Penyusutan - Kendaraan',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60503',
            'name' => 'Penyusutan - Mesin & Peralatan',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60504',
            'name' => 'Penyusutan - Peralatan Kantor',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60599',
            'name' => 'Penyusutan - Aset Sewa Guna Usaha',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '6-60216',
            'name' => 'Pengeluaran Barang Rusak',
            'category_id' => 14,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '7-70000',
            'name' => 'Pendapatan Bunga - Bank',
            'category_id' => 15,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '7-70001',
            'name' => 'Pendapatan Bunga - Deposito',
            'category_id' => 15,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '7-70001',
            'name' => 'Pendapatan Bunga - Deposito',
            'category_id' => 15,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '7-70099',
            'name' => 'Pendapatan Lain - lain',
            'category_id' => 15,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '8-80000',
            'name' => 'Beban Bunga',
            'category_id' => 16,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '8-80001',
            'name' => 'Provisi',
            'category_id' => 16,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '8-80002',
            'name' => '(Laba)/Rugi Pelepasan Aset Tetap',
            'category_id' => 16,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '8-80100',
            'name' => 'Penyesuaian Persediaan',
            'category_id' => 16,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '8-80999',
            'name' => 'Beban Lain - lain',
            'category_id' => 16,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '9-90000',
            'name' => 'Beban Pajak - Kini',
            'category_id' => 16,
            'umkm_id' => $umkm_id
        ]);

        Coa::create([
            'code' => '9-90001',
            'name' => 'Beban Pajak - Tangguhan',
            'category_id' => 16,
            'umkm_id' => $umkm_id
        ]);
    }
}
