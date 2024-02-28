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
        Schema::create('tc_assesment_hdr', function (Blueprint $table) {
            $table->string('assId')->unique();
            $table->string('assLabel');
            $table->string('tglTrs');
            $table->string('jamTrs');
            $table->string('kdReg');
            $table->string('noMr');
            $table->string('pasienName');
            $table->string('jeniskelamin');
            $table->string('dokter');
            $table->string('tglLahir')->nullable();
            $table->string('umur')->default('');
            $table->string('layanan');
            $table->string('tglVoid')->default('3000-01-01');
            $table->string('user');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_assesment_hdr');
    }
};
