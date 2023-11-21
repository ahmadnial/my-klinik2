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
        Schema::create('tb_adjusment_hdr', function (Blueprint $table) {
            $table->id();
            $table->string('kd_adj');
            $table->string('tgl_trs');
            $table->string('tgl_void')->default('3000-00-00');
            $table->string('periode_adjusment');
            $table->string('nilai_total_adjusment');
            $table->text('keterangan');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_adjusment_hdr');
    }
};
