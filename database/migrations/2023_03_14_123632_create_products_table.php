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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('coa_id')->index();
            $table->foreign('coa_id')->references('id')->on('coas');
            $table->integer('harga_beli')->nullable();
            $table->integer('pajak_beli')->nullable();
            $table->integer('harga_jual')->nullable();
            $table->integer('pajak_jual')->nullable();
            $table->unsignedBigInteger('umkm_id')->index();
            $table->foreign('umkm_id')->references('id')->on('umkms');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};