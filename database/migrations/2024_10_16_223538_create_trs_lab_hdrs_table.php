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
        Schema::create('trs_lab_hdr', function (Blueprint $table) {
            $table->id();
            $table->string('kd_trs', 10)->unique();
            $table->string('tl_kd_reg', 30);
            $table->string('tl_tgl_trs', 20);
            $table->string('tl_layanan', 50);
            $table->string('tl_dokter_pengirim', 100);
            $table->string('tl_no_mr', 20);
            $table->string('tl_nama');
            $table->string('tl_alamat');
            $table->string('tl_jenis_kelamin', 20);
            $table->string('tl_tgl_lahir', 20);
            $table->string('user', 20);
            $table->string('isVerifikasi')->default(0);
            $table->string('tl_total_tarif', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trs_lab_hdr');
    }
};
