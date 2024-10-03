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
        Schema::create('trs_order_lab', function (Blueprint $table) {
            $table->string('kd_trs');
            $table->string('chart_id');
            $table->string('tgl_trs')->nullable();
            $table->string('layanan');
            $table->string('kd_reg');
            $table->string('mr_pasien');
            $table->string('nm_pasien');
            $table->string('kd_lab')->nullable();
            $table->string('nm_dokter_jm')->nullable();
            $table->string('user')->nullable();
            $table->string('isImplementasi')->default(0);
            $table->string('isVerifikasi')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trs_order_lab');
    }
};
