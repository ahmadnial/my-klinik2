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
        Schema::create('profile_perusahaan', function (Blueprint $table) {
            $table->string('nmPerusahaan')->default('');
            $table->string('pemilikPerusahaan')->nullable();
            $table->string('pjPerusahaan')->nullable();
            $table->string('alamat')->nullable();
            $table->string('tipePerusahaan')->nullable();
            $table->string('NIB')->nullable();
            $table->string('kd_faskes')->nullable();
            $table->string('noTlp')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('NPWP')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_perusahaan');
    }
};
