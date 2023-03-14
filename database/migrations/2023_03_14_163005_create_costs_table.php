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
        Schema::create('costs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contact_id')->index()->nullable();
            $table->foreign('contact_id')->references('id')->on('contacts');
            $table->string('description')->nullable();
            $table->double('price');
            $table->integer('tax');
            $table->unsignedBigInteger('kas_id')->index();
            $table->foreign('kas_id')->references('id')->on('kass');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costs');
    }
};
