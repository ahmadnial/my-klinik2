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
        Schema::create('pelunasan_hutang_supplier', function (Blueprint $table) {
            $table->id();
            $table->string('pl_kd_hutang');
            $table->string('pl_kd_hutang_buat');
            $table->string('pl_no_kuitansi')->default('');
            $table->string('pl_no_faktur');
            $table->string('pl_supplier');
            $table->string('pl_kd_rekening')->default('');
            $table->string('pl_nilai_hutang');
            $table->string('pl_pembayaran');
            $table->string('pl_potongan')->default('');
            $table->string('pl_hutang_akhir');
            $table->string('pl_tanggal_trs');
            $table->string('pl_tanggal_hutang');
            $table->string('pl_tanggal_tempo');
            $table->string('pl_tanggal_pelunasan');
            $table->string('pl_cara_bayar')->default('');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelunasan_hutang_supplier');
    }
};
