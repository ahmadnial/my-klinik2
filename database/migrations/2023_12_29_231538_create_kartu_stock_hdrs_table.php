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
        Schema::create('kartu_stock_hdr', function (Blueprint $table) {
            $table->id();
            $table->string('ksh_kd_obat', 10);
            $table->string('ksh_nm_obat', 120);
            $table->string('ksh_satuan', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kartu_stock_hdr');
    }
};
