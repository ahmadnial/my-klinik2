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
            $table->string('tanggal_trs', 50);
            $table->string('kd_obat', 50);
            $table->string('nm_obat', 150);
            $table->string('kd_trs', 50);
            $table->string('supplier', 50);
            $table->string('no_batch', 50);
            $table->string('expired_date', 50);
            $table->string('qty_awal', 50);
            $table->string('qty_masuk', 50);
            $table->string('qty_keluar', 50);
            $table->string('qty_akhir', 50);
            $table->string('hpp_satuan', 50);
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
