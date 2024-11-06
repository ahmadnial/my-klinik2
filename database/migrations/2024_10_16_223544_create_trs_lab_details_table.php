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
        Schema::create('trs_lab_detail', function (Blueprint $table) {
            $table->id();
            $table->string('kd_trs', 50);
            $table->string('kd_reg', 50);
            $table->string('no_mr', 60);
            $table->string('tl_tgl_trs', 20);
            $table->string('kd_tarif', 50);
            $table->string('nm_tarif', 20);
            $table->string('hasil');
            $table->string('satuan_hasil');
            $table->string('nilai_rujukan_normal', 100);
            $table->string('sub_total');
            $table->string('user');
            $table->string('isVerifikasi')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trs_lab_detail');
    }
};
