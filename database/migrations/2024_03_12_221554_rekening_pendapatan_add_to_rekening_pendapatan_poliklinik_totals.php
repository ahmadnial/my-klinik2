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
        Schema::table('rekening_pendapatan_poliklinik_total', function (Blueprint $table) {
            $table->string('rk_pasienName');
            $table->string('rk_session_poli');
            $table->string('rk_dokter');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rekening_pendapatan_poliklinik_total', function (Blueprint $table) {
            //
        });
    }
};
