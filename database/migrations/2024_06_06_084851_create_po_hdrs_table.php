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
        Schema::create('po_hdr', function (Blueprint $table) {
            $table->string('po_hdr_kd')->unique();
            $table->string('po_tgl_trs')->unique();
            $table->string('po_hdr_no_faktur')->unique();
            $table->string('po_jenis_pembelian')->nullable();
            $table->string('po_hdr_supplier');
            $table->string('po_hdr_tgl_tempo');
            $table->string('po_hdr_lokasi_stock')->nullable();
            $table->string('po_hdr_total_faktur');
            $table->string('user');
            $table->timestamps();
            $table->softDeletes();
            $table->primary('po_hdr_kd');
        });

        Schema::table('po_detail_item', function ($table) {
            $table->foreign('po_hdr_kd')
                ->references('po_hdr_kd')
                ->on('po_hdr')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('po_hdr');
    }
};
