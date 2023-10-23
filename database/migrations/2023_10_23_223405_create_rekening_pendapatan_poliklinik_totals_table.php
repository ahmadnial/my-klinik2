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
        Schema::create('rekening_pendapatan_poliklinik_total', function (Blueprint $table) {
            $table->id();
            $table->string('rk_kd_reg');
            $table->string('rk_tgl_regout');
            $table->string('rk_no_mr');
            $table->string('rk_layanan');
            $table->string('rk_nilai');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekening_pendapatan_poliklinik_total');
    }
};
