<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('chart_tindakan', function (Blueprint $table) {
            $table->string('chart_id')->unique();
            $table->string('chart_tgl_trs');
            $table->string('chart_tgl_void')->nullable();
            $table->string('chart_kd_reg');
            $table->string('chart_mr');
            $table->string('chart_nm_pasien');
            $table->string('chart_layanan');
            $table->string('chart_dokter');
            $table->string('user');
            $table->string('user_void')->default('');
            $table->longText('chart_S')->default('');
            $table->longText('chart_O')->default('');
            $table->longText('chart_A')->default('');
            $table->mediumText('chart_A_diagnosa')->default('');
            $table->longText('chart_P')->default('');
            $table->longText('chart_P_resep')->default('');
            $table->longText('chart_P_tindakan')->default('');
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
