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
        // 1
        $category = new TransactionCategory();
        $category->name = "Sale";
        $category->save();

        // 2
        $category = new TransactionCategory();
        $category->name = "Purchase";
        $category->save();

        // 3
        $category = new TransactionCategory();
        $category->name = "Cost";
        $category->save();

        // 4
        $category = new TransactionCategory();
        $category->name = "Bank Transfer";
        $category->save();

        // 5
        $category = new TransactionCategory();
        $category->name = "Bank Deposit";
        $category->save();

        // 6
        $category = new TransactionCategory();
        $category->name = "Bank Withdrawal";
        $category->save();

        // 7
        $category = new TransactionCategory();
        $category->name = "Receive Payment";
        $category->save();

        // 8
        $category = new TransactionCategory();
        $category->name = "Purchase Payment";
        $category->save();
    }
}
