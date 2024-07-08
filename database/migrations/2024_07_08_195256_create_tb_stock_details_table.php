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
        Schema::create('tb_stock_detail', function (Blueprint $table) {
            $table->id();
            $table->string('kd_trs');
            $table->string('kd_obat');
            $table->string('nm_obat');
            $table->string('layanan');
            $table->string('qty')->default('0');
            $table->string('hpp');
            $table->string('kd_po')->nullable();
            $table->string('kd_do');
            $table->string('tgl_do');
            $table->string('kd_mutasi')->nullable();
            $table->string('tgl_mutasi')->nullable();
            $table->string('tgl_ed');
            $table->string('no_batch');
            $table->string('satuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_stock_detail');
    }
};
