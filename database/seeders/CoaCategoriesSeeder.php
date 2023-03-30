<?php

namespace Database\Seeders;

use App\Models\CoaCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoaCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = new CoaCategory();
        $category->name = "Kas & Bank";
        $category->save();

        $category = new CoaCategory();
        $category->name = "Akun Piutang";
        $category->save();

        $category = new CoaCategory();
        $category->name = "Persediaan";
        $category->save();

        $category = new CoaCategory();
        $category->name = "Aktiva Lancar Lainnya";
        $category->save();

        $category = new CoaCategory();
        $category->name = "Aktiva Tetap";
        $category->save();

        $category = new CoaCategory();
        $category->name = "Depresiasi & Amortisasi";
        $category->save();

        $category = new CoaCategory();
        $category->name = "Aktiva Lainnya";
        $category->save();

        $category = new CoaCategory();
        $category->name = "Akun Hutang";
        $category->save();

        $category = new CoaCategory();
        $category->name = "Kewajiban Lancar Lainnya";
        $category->save();

        $category = new CoaCategory();
        $category->name = "Kewajiban Jangka Panjang";
        $category->save();

        $category = new CoaCategory();
        $category->name = "Ekuitas";
        $category->save();

        $category = new CoaCategory();
        $category->name = "Pendapatan";
        $category->save();

        $category = new CoaCategory();
        $category->name = "Harga Pokok Penjualan";
        $category->save();

        $category = new CoaCategory();
        $category->name = "Beban";
        $category->save();

        $category = new CoaCategory();
        $category->name = "Pendapatan Lainnya";
        $category->save();

        $category = new CoaCategory();
        $category->name = "Beban Lainnya";
        $category->save();
    }
}
