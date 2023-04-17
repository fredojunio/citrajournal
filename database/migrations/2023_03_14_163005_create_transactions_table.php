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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('umkm_id')->index();
            $table->foreign('umkm_id')->references('id')->on('umkms');
            $table->unsignedBigInteger('contact_id')->index()->nullable();
            $table->foreign('contact_id')->references('id')->on('contacts');
            $table->unsignedBigInteger('category_id')->index();
            $table->foreign('category_id')->references('id')->on('transaction_categories');
            $table->double('taxtotal');
            $table->double('subtotal');
            $table->double('cuttotal');
            $table->double('total');
            $table->integer('cut');
            $table->double('remaining_bill')->nullable();
            $table->string('status');
            $table->string('invoice');
            $table->date('date');
            $table->date('due_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
