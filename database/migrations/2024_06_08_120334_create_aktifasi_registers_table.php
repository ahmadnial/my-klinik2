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
        Schema::create('aktifasi_register', function (Blueprint $table) {
            $table->string('kd_aktifasi');
            $table->string('tgl_trs_aktifasi');
            $table->string('tgl_aktifasi_aktif');
            $table->string('user_aktifasi');
            $table->string('layanan_aktifasi');
            $table->string('reg_aktifasi');
            $table->string('nm_pasien_aktifasi');
            $table->string('mr_aktifasi');
            $table->string('tgl_deaktif')->default('3000-01-01');
            $table->string('user_deaktifasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktifasi_register');
    }
};
