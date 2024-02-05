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
        Schema::table('tp_hdr', function (Blueprint $table) {
            $table->string('kd_trs')->unique()->change();
        });
    }

    //     Schema::table('users', function (Blueprint $table) {
    //     $table->string('name', 50)->change();
    // });

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
