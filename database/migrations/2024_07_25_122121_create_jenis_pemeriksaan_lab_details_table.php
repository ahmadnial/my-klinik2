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
        Schema::create('jenis_pemeriksaan_lab_detail', function (Blueprint $table) {
            $table->id();
            $table->string('kd_jenis_pemeriksaan_lab');
            $table->string('jenis_kelamin');
            $table->string('batas_atas');
            $table->string('batas_bawah');
            $table->string('ket_normal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_pemeriksaan_lab_detail');
    }
};
