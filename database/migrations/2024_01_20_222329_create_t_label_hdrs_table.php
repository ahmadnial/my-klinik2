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
        Schema::create('t_label_hdr', function (Blueprint $table) {
            $table->id();
            $table->string('reffID');
            $table->string('Tgl');
            $table->string('labelType')->default('');
            $table->string('pasienID');
            $table->string('layananID');
            $table->string('kdReg');
            $table->string('pasienName');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_label_hdr');
    }
};
