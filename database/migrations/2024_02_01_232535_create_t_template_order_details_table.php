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
        Schema::create('t_template_order_detail', function (Blueprint $table) {
            $table->id();
            $table->string('kd_to', 30);
            $table->string('kd_obat_to', 30);
            $table->string('nm_obat_to', 30);
            $table->string('hrg_obat_to', 30);
            $table->string('qty_to', 100)->default('1');
            $table->string('satuan_to', 30);
            $table->string('signa_to', 30)->default('');
            $table->string('cara_pakai_to', 100)->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_template_order_detail');
    }
};
