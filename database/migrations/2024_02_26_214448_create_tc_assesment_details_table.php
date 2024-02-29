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

            $table->string('fs_keluhan_utama')->nullable()->default('');
            $table->string('fs_anamnesis')->nullable()->default('');
            $table->string('fs_rwyt_penyakit')->nullable()->default('');
            $table->string('fs_rwyt_skt_klrg')->nullable()->default('');
            $table->string('fs_rwyt_obt_sebelum')->nullable()->default('');
            $table->string('fs_rwyt_alergi_1')->nullable()->default('');
            $table->string('fs_rwyt_alergi_2')->nullable()->default('');
            $table->string('fs_rwyt_alergi_3')->nullable()->default('');
            $table->string('fs_rwyt_alergi_4')->nullable()->default('');
            $table->string('fs_gcs_e')->nullable()->default('');
            $table->string('fs_gcs_V')->nullable()->default('');
            $table->string('fs_gcs_m')->nullable()->default('');
            $table->string('fs_td')->nullable()->default('');
            $table->string('fs_N_1')->nullable()->default('');
            $table->string('fs_R_1')->nullable()->default('');
            $table->string('fs_S_1')->nullable()->default('');

            $table->string('fs_kepala')->nullable()->default('');
            $table->string('fs_leher')->nullable()->default('');
            $table->string('fs_thorax')->nullable()->default('');
            $table->string('fs_abdomen')->nullable()->default('');
            $table->string('fs_ekstremitas')->nullable()->default('');
            $table->string('fs_genetalia')->nullable()->default('');

            $table->string('fs_periksa_penunjang')->nullable()->default('');
            $table->string('fs_diag_banding')->nullable()->default('');
            $table->string('fs_diag_kerja')->nullable()->default('');
            $table->string('fs_mslh_medis')->nullable()->default('');
            $table->string('fb_disposisi')->nullable()->default('');
            $table->string('fb_disposisi2')->nullable()->default('');
            $table->string('fb_disposisi3')->nullable()->default('');
            $table->string('fb_disposisi6')->nullable()->default('');
            $table->string('fb_disposisi7')->nullable()->default('');
            $table->string('fs_instruksi_medis')->nullable()->default('');
            $table->string('fs_kontrol_klinik')->nullable()->default('');
            $table->string('fs_rujuk')->nullable()->default('');
            $table->string('fs_meninggal')->nullable()->default('');

            $table->string('fs_pasien')->nullable()->default('');
            $table->string('fs_klrg_pasien')->nullable()->default('');
            $table->string('fs_tdk_dpt_edu')->nullable()->default('');
            $table->string('fd_tgl_ttd')->nullable()->default('');
            $table->string('fs_jam_ttd')->nullable()->default('');
            $table->string('fs_dokter_assessment')->nullable()->default('');

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
