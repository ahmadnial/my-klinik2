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
        Schema::table('trs_chart', function (Blueprint $table) {
            $table->string('ch_kd_obat');
            $table->string('ch_nm_obat');
            $table->string('ch_qty_obat');
            $table->string('ch_satuan_obat');
            $table->string('ch_signa')->nullable();
            $table->string('ch_cara_pakai')->nullable();
            $table->string('ch_hrg_jual')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trs_chart', function (Blueprint $table) {
            //
        });
    }
};
