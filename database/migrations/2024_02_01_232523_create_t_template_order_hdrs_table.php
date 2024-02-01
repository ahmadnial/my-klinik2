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
        Schema::create('t_template_order_hdr', function (Blueprint $table) {
            $table->id();
            $table->string('kd_to', 30);
            $table->string('nm_to', 100);
            $table->string('to_user', 100)->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_template_order_hdr');
    }
};
