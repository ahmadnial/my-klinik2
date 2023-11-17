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
            $table->string('fm_hrg_jual_non_resep_persen');
            $table->string('fm_hrg_jual_resep_persen');
            $table->string('fm_hrg_jual_nakes_persen');
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
