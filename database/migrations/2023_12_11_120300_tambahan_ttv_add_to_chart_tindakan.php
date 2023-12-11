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
        Schema::table('chart_tindakan', function (Blueprint $table) {
            $table->string('ttv_BW', 20)->default('');
            $table->string('ttv_BH', 20)->default('');
            $table->string('ttv_BPs', 20)->default('');
            $table->string('ttv_BPd', 20)->default('');
            $table->string('ttv_BT', 20)->default('');
            $table->string('ttv_HR', 20)->default('');
            $table->string('ttv_RR', 20)->default('');
            $table->string('ttv_SN', 20)->default('');
            $table->string('ttv_SPO2', 20)->default('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chart_tindakan', function (Blueprint $table) {
            //
        });
    }
};
