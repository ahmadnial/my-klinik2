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
        Schema::create('tc_assesment_detail', function (Blueprint $table) {
            $table->string('assId');
            $table->string('tglTrs');
            $table->string('jamTrs');
            $table->string('kdReg');
            $table->string('noMr');
            $table->string('user');

            $table->string('fs_keluhan_utama')->default('');
            $table->string('fs_anamnesis')->default('');
            $table->string('fs_rwyt_penyakit')->default('');
            $table->string('fs_rwyt_skt_klrg')->default('');
            $table->string('fs_rwyt_obt_sebelum')->default('');
            $table->string('fs_rwyt_alergi_1')->default('');
            $table->string('fs_rwyt_alergi_2')->default('');
            $table->string('fs_rwyt_alergi_3')->default('');
            $table->string('fs_rwyt_alergi_4')->default('');
            $table->string('fs_gcs_e')->default('');
            $table->string('fs_gcs_V')->default('');
            $table->string('fs_gcs_m')->default('');
            $table->string('fs_td')->default('');
            $table->string('fs_N_1')->default('');
            $table->string('fs_R_1')->default('');
            $table->string('fs_S_1')->default('');

            $table->string('fs_kepala')->default('');
            $table->string('fs_leher')->default('');
            $table->string('fs_thorax')->default('');
            $table->string('fs_abdomen')->default('');
            $table->string('fs_ekstremitas')->default('');
            $table->string('fs_genetalia')->default('');

            $table->string('fs_periksa_penunjang')->default('');
            $table->string('fs_diag_banding')->default('');
            $table->string('fs_diag_kerja')->default('');
            $table->string('fs_mslh_medis')->default('');
            $table->string('fs_instruksi_medis')->default('');
            $table->string('fs_kontrol_klinik')->default('');
            $table->string('fs_rujuk')->default('');
            $table->string('fs_meninggal')->default('');
            $table->string('fs_pasien')->default('');
            $table->string('fs_klrg_pasien')->default('');
            $table->string('fs_tdk_dpt_edu')->default('');
            $table->string('fd_tgl_ttd')->default('');
            $table->string('fs_jam_ttd')->default('');
            $table->string('fs_dokter_assessment')->default('');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_assesment_detail');
    }
};
