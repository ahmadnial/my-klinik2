<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ta_registrasi', function (Blueprint $table) {
            $table->string('fr_kd_reg')->unique();
            $table->string('fr_mr');
            $table->string('fr_nama');
            $table->string('fr_tgl_lahir');
            $table->string('fr_jenis_kelamin');
            $table->string('fr_alamat');
            $table->string('fr_no_hp')->nullable();
            $table->string('fr_layanan');
            $table->string('fr_dokter');
            $table->string('fr_session_poli');
            $table->string('fr_jaminan');
            $table->string('fr_bb')->nullable();
            $table->string('fr_alergi')->nullable();
            $table->string('fr_tgl_void')->nullable()->default('');
            $table->string('fr_user_void')->nullable()->default('');
            $table->string('fr_tgl_keluar')->nullable()->default('');
            $table->string('fr_jam_keluar')->nullable()->default('');
            $table->string('fr_user')->nullable();
            $table->softDeletes();
            $table->timestamps();
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
