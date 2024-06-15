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
            $table->string('po_tgl_trs');
            $table->string('po_jenis_pembelian');
            $table->string('po_hdr_supplier');
            $table->string('po_hdr_kategori');
            $table->string('po_hdr_lokasi_stock')->nullable();
            $table->string('po_hdr_total_faktur');
            $table->string('user');
            $table->timestamps();
            $table->softDeletes();
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
