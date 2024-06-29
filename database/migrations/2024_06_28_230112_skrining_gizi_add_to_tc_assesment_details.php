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
        Schema::table('tc_assesment_detail', function (Blueprint $table) {
            $table->string('fs_sg_bb')->nullable()->default('');
            $table->string('fs_sg_tb')->nullable()->default('');
            $table->string('fs_sg_imt')->nullable()->default('');
            $table->string('fs_sg_imt_note')->nullable()->default('');
            $table->string('fs_sg_masalah_gizi')->nullable()->default('');
            $table->string('fs_sg_masalah_gizi_note')->nullable()->default('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tc_assesment_detail', function (Blueprint $table) {
            //
        });
    }
};
