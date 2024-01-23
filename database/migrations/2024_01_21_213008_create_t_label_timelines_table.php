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
        Schema::create('t_label_timeline', function (Blueprint $table) {
            $table->id();
            $table->string('reffID', 80);
            $table->string('Tgl', 30);
            $table->string('labelType', 100);
            $table->string('pasienID', 50);
            $table->string('layananID', 30);
            $table->string('kdReg', 50);
            $table->string('pasienName', 70);
            $table->string('userID', 50);
            $table->text('ketFile')->nullable();
            $table->longText('ketHTML');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_label_timeline');
    }
};
