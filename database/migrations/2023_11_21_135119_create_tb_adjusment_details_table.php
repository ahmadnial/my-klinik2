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
        Schema::create('tb_adjusment_detail', function (Blueprint $table) {
            $table->id();
            $table->string('kd_adj');
            $table->string('kd_obat');
            $table->string('nm_obat');
            $table->string('satuan');
            $table->string('qty_awal');
            $table->string('qty_sebenarnya');
            $table->string('koreksi_adj');
            $table->string('nilai_hpp');
            $table->string('sub_total_adjusment');
            $table->string('user');
            $table->string('keterangan1')->nullable();
            $table->string('keterangan2')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_adjusment_detail');
    }
};
