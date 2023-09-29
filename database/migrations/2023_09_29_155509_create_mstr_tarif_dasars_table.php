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
        Schema::create('mstr_tarif_dasar', function (Blueprint $table) {
            $table->id();
            $table->string('nm_tarif_dasar');
            $table->string('ket_tarif_dasar');
            $table->string('nilai_tarif_dasar');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mstr_tarif_dasar');
    }
};
