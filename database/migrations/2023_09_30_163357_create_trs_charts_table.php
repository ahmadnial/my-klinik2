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
        Schema::create('trs_chart', function (Blueprint $table) {
            $table->string('kd_trs');
            $table->string('kd_resep')->nullable();
            $table->string('chart_id');
            $table->string('tgl_trs')->nullable();
            $table->string('layanan');
            $table->string('kd_reg');
            $table->string('mr_pasien');
            $table->string('nm_pasien');
            $table->string('nm_tarif')->nullable();
            $table->string('resep')->nullable();
            $table->string('nm_tarif_dasar');
            $table->string('nm_nilai_tarif')->nullable();
            $table->string('nm_dokter_jm')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('tgl_void')->nullable();
            $table->string('user_void')->nullable();
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
        Schema::dropIfExists('trs_chart');
    }
};
