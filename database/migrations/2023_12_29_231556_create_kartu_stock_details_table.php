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
        Schema::create('kartu_stock_detail', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal_trs');
            $table->string('kd_trs');
            $table->string('supplier');
            $table->string('no_batch');
            $table->string('expired_date');
            $table->string('qty_awal');
            $table->string('qty_masuk');
            $table->string('qty_keluar');
            $table->string('qty_akhir');
            $table->string('hpp_satuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kartu_stock_detail');
    }
};
