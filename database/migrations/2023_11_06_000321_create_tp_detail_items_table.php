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
        Schema::create('tp_detail_item', function (Blueprint $table) {
            $table->id();
            $table->string('kd_trs')->unique();
            $table->string('kd_reg')->nullable();
            $table->string('kd_obat');
            $table->string('nm_obat');
            // $table->string('dosis')->nullable();
            $table->string('hrg_obat');
            $table->string('qty');
            $table->string('diskon')->nullable();
            $table->string('satuan');
            $table->string('tax')->nullable();
            // $table->string('tulsah')->nullable();
            // $table->string('embalase')->nullable();
            $table->string('sub_total');
            // $table->string('etiket')->nullable();
            // $table->string('signa')->nullable();
            // $table->string('cara_pakai')->nullable();
            $table->string('user')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tp_detail_item');
    }
};
