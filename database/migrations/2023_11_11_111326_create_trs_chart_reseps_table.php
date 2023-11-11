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
        Schema::create('trs_chart_resep', function (Blueprint $table) {
            $table->string('kd_trs');
            $table->string('kd_resep')->nullable();
            $table->string('chart_id');
            $table->string('tgl_trs');
            $table->string('layanan');
            $table->string('kd_reg');
            $table->string('mr_pasien');
            $table->string('nm_pasien');
            $table->string('ch_kd_obat');
            $table->string('ch_nm_obat');
            $table->string('ch_qty_obat');
            $table->string('ch_satuan_obat');
            $table->string('ch_signa')->nullable();
            $table->string('ch_cara_pakai')->nullable();
            $table->string('ch_hrg_jual')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trs_chart_resep');
    }
};
