<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mstr_dokter', function (Blueprint $table) {
            $table->id();
            $table->string('fm_kd_medis');
            $table->string('fm_nm_medis');
            $table->string('fm_sip_medis');
            $table->string('fm_kadaluarsa_sip');
            $table->string('fm_layanan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mstr_dokter');
    }
};
