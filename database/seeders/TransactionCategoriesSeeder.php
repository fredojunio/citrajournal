<?php

namespace Database\Seeders;

use App\Models\TransactionCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = new TransactionCategory();
        $category->name = "Sale";
        $category->save();

        $category = new TransactionCategory();
        $category->name = "Purchase";
        $category->save();

        $category = new TransactionCategory();
        $category->name = "Cost";
        $category->save();

        $category = new TransactionCategory();
        $category->name = "Bank Transfer";
        $category->save();

        $category = new TransactionCategory();
        $category->name = "Receive Payment";
        $category->save();

        $category = new TransactionCategory();
        $category->name = "Bank Withdrawal";
        $category->save();
    }
}
