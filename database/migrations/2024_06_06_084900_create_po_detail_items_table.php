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
        Schema::create('po_detail_item', function (Blueprint $table) {
            $table->id();
            $table->string('po_hdr_kd');
            $table->string('po_tgl_trs');
            $table->string('po_obat');
            $table->string('po_nm_obat');
            $table->string('po_satuan_pembelian');
            $table->string('po_diskon')->nullable();
            $table->string('po_diskon_prosen')->nullable();
            $table->string('po_qty');
            $table->string('po_isi_pembelian');
            $table->string('po_satuan_jual');
            $table->string('po_hrg_beli');
            $table->string('po_pajak')->nullable();
            $table->string('po_tgl_exp');
            $table->string('po_batch_number')->nullable();
            $table->string('po_sub_total');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('po_detail_items');
    }
};
