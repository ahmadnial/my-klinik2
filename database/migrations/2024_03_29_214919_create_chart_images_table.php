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
        Schema::create('chart_images', function (Blueprint $table) {
            $table->id();
            $table->string('chart_id');
            $table->string('chart_noRm');
            $table->string('chart_kd_reg');
            $table->string('chart_imageName');
            $table->string('chart_imageLabel');
            $table->string('chart_note');
            $table->string('chart_tglTrs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chart_images');
    }
};
