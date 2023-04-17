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
        // 1
        $category = new CoaCategory();
        $category->name = "Kas & Bank";
        $category->save();

        // 2
        $category = new CoaCategory();
        $category->name = "Akun Piutang";
        $category->save();

        // 3
        $category = new CoaCategory();
        $category->name = "Persediaan";
        $category->save();

        // 4
        $category = new CoaCategory();
        $category->name = "Aktiva Lancar Lainnya";
        $category->save();

        // 5
        $category = new CoaCategory();
        $category->name = "Aktiva Tetap";
        $category->save();

        // 6
        $category = new CoaCategory();
        $category->name = "Depresiasi & Amortisasi";
        $category->save();

        // 7
        $category = new CoaCategory();
        $category->name = "Aktiva Lainnya";
        $category->save();

        // 8
        $category = new CoaCategory();
        $category->name = "Akun Hutang";
        $category->save();

        // 9
        $category = new CoaCategory();
        $category->name = "Kewajiban Lancar Lainnya";
        $category->save();

        // 10
        $category = new CoaCategory();
        $category->name = "Kewajiban Jangka Panjang";
        $category->save();

        // 11
        $category = new CoaCategory();
        $category->name = "Ekuitas";
        $category->save();

        // 12
        $category = new CoaCategory();
        $category->name = "Pendapatan";
        $category->save();

        // 13
        $category = new CoaCategory();
        $category->name = "Harga Pokok Penjualan";
        $category->save();

        // 14
        $category = new CoaCategory();
        $category->name = "Beban";
        $category->save();

        // 15
        $category = new CoaCategory();
        $category->name = "Pendapatan Lainnya";
        $category->save();

        // 16
        $category = new CoaCategory();
        $category->name = "Beban Lainnya";
        $category->save();
    }
}
