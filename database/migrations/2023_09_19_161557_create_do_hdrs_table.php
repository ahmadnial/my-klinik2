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
        Schema::create('do_hdr', function (Blueprint $table) {
            $table->string('do_hdr_kd')->unique();
            $table->string('do_hdr_no_faktur')->unique();
            $table->string('do_hdr_supplier');
            $table->string('do_hdr_tgl_tempo');
            $table->string('do_hdr_lokasi_stock')->nullable();
            $table->string('do_hdr_total_faktur');
            $table->string('user');
            $table->timestamps();
            $table->softDeletes();
            $table->primary('do_hdr_kd');
        });

        Schema::table('do_detail_item', function ($table) {
            $table->foreign('do_hdr_kd')
                ->references('do_hdr_kd')
                ->on('do_hdr')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('do_hdr');
    }
};
