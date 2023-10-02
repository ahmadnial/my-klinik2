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
        Schema::create('mstr_nilai_tindakan', function (Blueprint $table) {
            $table->id();
            $table->string('id_tindakan');
            $table->string('nm_tindakan');
            $table->string('nilai_tarif');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mstr_nilai_tindakan');
    }
};
