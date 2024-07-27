<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tarif_lab_detail', function (Blueprint $table) {
            $table->id();
            $table->string('kd_tarif');
            $table->string('nm_tarif');
            $table->string('kd_jenis_pemeriksaan_lab');
            $table->string('jenis_kelamin');
            $table->string('batas_bawah');
            $table->string('batas_atas');
            $table->string('ket_normal');
            $table->string('satuan_hasil');
            $table->string('tgl_expired')->default('3000-01-01');
            $table->string('isActive')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarif_lab_detail');
    }
};
