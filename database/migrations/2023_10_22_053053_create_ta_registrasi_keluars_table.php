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
        Schema::create('ta_registrasi_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('kd_trs_reg_out')->nullable();
            $table->string('trs_kp_kd_reg');
            $table->string('trs_kp_tgl_keluar');
            $table->string('trs_kp_nm_pasien');
            $table->string('trs_kp_no_mr');
            $table->string('trs_kp_layanan');
            $table->string('trs_kp_dokter');
            $table->string('nm_tarif_dasar');
            $table->string('user')->nullable();
            $table->string('trs_kp_kd_trs_chart')->default('');
            $table->string('trs_kp_nm_tarif')->default('');
            $table->string('trs_kp_nilai_tarif')->default('');
            $table->string('trs_kp_nilai_total');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ta_registrasi_keluar');
    }
};
