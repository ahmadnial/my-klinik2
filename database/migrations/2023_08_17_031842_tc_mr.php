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
        Schema::create('tc_mr', function (Blueprint $table) {
            $table->string('fs_mr')->unique();
            $table->string('fs_nama');
            $table->string('fs_tempat_lahir');
            $table->string('fs_tgl_lahir');
            $table->string('fs_nm_ibu_kandung')->nullable()->default('');
            $table->string('provinsi')->nullable()->default('');
            $table->string('kota')->nullable()->default('');
            $table->string('kecamatan')->nullable()->default('');
            $table->string('desa')->nullable()->default('');
            $table->string('fs_jenis_kelamin');
            $table->string('fs_jenis_identitas')->nullable()->default('');
            $table->string('fs_no_identitas')->nullable()->default('');
            $table->string('fs_alamat')->nullable()->default('');
            $table->string('fs_suku')->nullable()->default('');
            $table->string('fs_bahasa')->nullable()->default('');
            $table->string('fs_agama')->nullable()->default('');
            $table->string('fs_pekerjaan')->nullable()->default('');
            $table->string('fs_pendidikan')->nullable()->default('');
            $table->string('fs_status_kawin')->nullable()->default('');
            $table->string('fs_no_hp')->nullable()->default('');
            $table->string('fs_alergi')->nullable()->default('');
            $table->string('fs_tgl_kunjungan_terakhir')->nullable()->default('');
            $table->string('fs_layanan_kunjungan_terakhir')->nullable()->default('');
            $table->string('fs_tanggal_meninggal')->nullable()->default('');
            $table->string('fs_user')->nullable()->default('');
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
