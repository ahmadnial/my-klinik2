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
            $table->string('st_isi_pembelian');
            $table->string('st_hrg_beli_per1');
            $table->string('st_hrg_beli_per2');
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
