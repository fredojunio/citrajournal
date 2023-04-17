<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id')->index();
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->unsignedBigInteger('coa_id')->index()->nullable();
            $table->foreign('coa_id')->references('id')->on('coas');
            $table->unsignedBigInteger('product_id')->index()->nullable();
            $table->foreign('product_id')->references('id')->on('products');
            $table->unsignedBigInteger('paid_id')->index()->nullable();
            $table->foreign('paid_id')->references('id')->on('transactions');

            $table->string('description')->nullable();
            $table->double('price');
            $table->integer('quantity')->nullable();
            $table->integer('tax');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
