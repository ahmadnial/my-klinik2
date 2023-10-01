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
            $table->string('tgl_trs');
            $table->string('layanan');
            $table->string('kd_reg');
            $table->string('mr_pasien');
            $table->string('nm_pasien');
            $table->string('nm_tarif');
            $table->string('nm_dokter_jm');
            $table->string('sub_total');
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
        Schema::dropIfExists('trs_chart');
    }
};
