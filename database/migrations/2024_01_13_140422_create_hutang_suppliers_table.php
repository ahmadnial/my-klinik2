<?php

use Illuminate\Database\Eloquent\SoftDeletes;
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
        Schema::create('hutang_supplier', function (Blueprint $table) {
            $table->id();
            $table->string('hs_kd_hutang');
            $table->string('hs_kd_hutang_buat');
            $table->string('hs_no_faktur');
            $table->string('hs_supplier');
            $table->string('hs_kd_rekening')->default('');
            $table->string('hs_nilai_hutang');
            $table->string('hs_pembayaran');
            $table->string('hs_potongan');
            $table->string('hs_hutang_akhir');
            $table->string('hs_tanggal_trs');
            $table->string('hs_tanggal_hutang');
            $table->string('hs_tanggal_tempo');
            $table->string('hs_tanggal_pelunasan');
            $table->string('hs_keterangan')->default('');
            $table->string('isLunas')->default('0');
            $table->string('user');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hutang_supplier');
    }
};
