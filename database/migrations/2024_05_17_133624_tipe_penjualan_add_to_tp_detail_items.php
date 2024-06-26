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
        Schema::table('tp_detail_item', function (Blueprint $table) {
            $table->string('tipeTarif')->default('');
            $table->string('resepDari')->default('');
            $table->string('noResep')->default('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tp_detail_item', function (Blueprint $table) {
            //
        });
    }
};
