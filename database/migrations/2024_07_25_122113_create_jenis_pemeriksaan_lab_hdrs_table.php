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
        Schema::create('jenis_pemeriksaan_lab_hdr', function (Blueprint $table) {
            $table->id();
            $table->string('kd_jenis_pemeriksaan_lab')->unique();
            $table->string('nm_jenis_pemeriksaan_lab');
            $table->string('satuan_hasil');
            $table->string('grup_periksa_sub')->nullable();
            $table->string('metode_uji')->nullable();
            $table->string('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_pemeriksaan_lab_hdr');
    }
};
