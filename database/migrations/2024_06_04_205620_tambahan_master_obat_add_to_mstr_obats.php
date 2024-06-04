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
        Schema::table('mstr_obat', function (Blueprint $table) {
            $table->string('fm_jenis_pembelian')->nullable();
            $table->string('fm_kandungan_obat')->nullable();
            $table->string('fm_stok_minimal')->nullable();
            $table->string('fm_zat_prekursor')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mstr_obat', function (Blueprint $table) {
            //
        });
    }
};
