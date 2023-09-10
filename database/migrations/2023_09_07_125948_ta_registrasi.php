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
        Schema::create('ta_registrasi', function (Blueprint $table) {
            $table->bigInteger('fr_kd_reg');
            $table->string('fr_mr');
            $table->string('fr_nama');
            $table->string('fr_tgl_lahir');
            $table->string('fr_jenis_kelamin');
            $table->string('fr_alamat');
            $table->string('fr_no_hp');
            $table->string('fr_layanan');
            $table->string('fr_medis');
            $table->string('fr_jaminan');
            $table->string('fr_bb');
            $table->string('fr_alergi');
            $table->string('fr_user')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
