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
        Schema::table('tc_mr', function (Blueprint $table) {
            $table->string('fs_last_tarif_dasar')->nullable()->default('');
            $table->string('fs_note')->nullable()->default('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tc_mr', function (Blueprint $table) {
            //
        });
    }
};
