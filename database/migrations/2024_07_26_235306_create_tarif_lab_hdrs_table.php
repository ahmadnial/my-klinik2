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
        Schema::create('tarif_lab_hdr', function (Blueprint $table) {
            $table->id();
            $table->string('kd_tarif');
            $table->string('nm_tarif');
            $table->string('rekap_cetak')->nullable();
            $table->string('nilai_tarif');
            $table->string('keterangan_tarif');
            $table->string('tgl_expired')->default('3000-01-01');
            $table->string('isActive')->nullable();
            $table->string('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarif_lab_hdr');
    }
};
