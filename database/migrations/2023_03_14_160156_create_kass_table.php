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
        Schema::create('kass', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('coa_id')->index();
            $table->foreign('coa_id')->references('id')->on('coas');
            $table->double('balance');
            $table->unsignedBigInteger('umkm_id')->index();
            $table->foreign('umkm_id')->references('id')->on('umkms')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kass');
    }
};
