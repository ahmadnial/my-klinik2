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
        Schema::create('tp_hdr', function (Blueprint $table) {
            $table->id();
            $table->string('kd_trs');
            $table->string('kd_order_resep')->nullable();
            $table->string('layanan_order')->nullable();
            $table->string('dokter')->nullable();
            $table->string('sip_dokter')->nullable();
            $table->string('jaminan')->nullable();
            $table->string('lokasi_stock')->nullable();
            $table->string('kd_reg')->nullable();
            $table->string('no_mr')->nullable();
            $table->string('nm_pasien')->nullable();
            $table->string('alamat')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('tgl_lahir')->nullable();
            $table->string('tipe_tarif');
            $table->string('total_penjualan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tp_hdr');
    }
};
