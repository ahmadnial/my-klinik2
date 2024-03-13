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
        Schema::create('ta_registrasi_keluar_hdr', function (Blueprint $table) {
            $table->id();
            $table->string('kd_trs_reg_out')->nullable();
            $table->string('kp_kd_reg');
            $table->string('kp_tgl_keluar');
            $table->string('kp_nm_pasien');
            $table->string('kp_no_mr');
            $table->string('kp_layanan');
            $table->string('kp_dokter');
            $table->string('nm_tarif_dasar');
            $table->string('kp_nilai_total');
            $table->string('user')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ta_registrasi_keluar_hdr');
    }
};
