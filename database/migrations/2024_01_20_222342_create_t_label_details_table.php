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
        Schema::create('t_label_detail', function (Blueprint $table) {
            $table->id();
            $table->string('reffID');
            $table->string('Tgl');
            $table->string('pasienID');
            $table->string('kd_obat');
            $table->string('nm_obat');
            $table->string('qty_obat');
            $table->string('satuan_obat');
            $table->string('cara_pakai')->default('');
            $table->string('tindakan')->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_label_detail');
    }
};
