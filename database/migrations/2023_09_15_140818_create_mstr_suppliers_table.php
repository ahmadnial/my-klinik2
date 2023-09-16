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
        Schema::create('mstr_supplier', function (Blueprint $table) {
            $table->string('fm_kd_supplier');
            $table->string('fm_nm_supplier');
            $table->string('fm_email');
            $table->string('fm_no_tlp');
            $table->string('fm_alamat');
            $table->string('fm_kota');
            $table->string('fm_kd_pos');
            $table->string('fm_npwp');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mstr_supplier');
    }
};
