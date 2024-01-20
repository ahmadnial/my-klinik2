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
        Schema::create('t_label_timelines', function (Blueprint $table) {
            $table->id();
            $table->string('reffID');
            $table->string('Tgl');
            $table->string('labelType')->default('');
            $table->string('pasienID');
            $table->string('layananID');
            $table->string('kdReg');
            $table->string('pasienName');
            $table->string('kd_obat');
            $table->string('nm_obat');
            $table->string('qty_obat');
            $table->string('satuan_obat');
            $table->string('cara_pakai')->default('');
            $table->string('tindakan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_label_timelines');
    }
};
