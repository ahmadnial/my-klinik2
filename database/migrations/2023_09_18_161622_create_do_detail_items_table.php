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
        Schema::create('do_detail_item', function (Blueprint $table) {
            $table->id();
            $table->string('do_obat');
            // $table->string('nm_obat');
            $table->string('do_satuan_pembelian');
            $table->string('do_diskon')->nullable();
            $table->string('do_qty');
            $table->string('do_isi_pembelian');
            $table->string('do_satuan_jual');
            $table->string('do_hrg_beli');
            $table->string('do_pajak')->nullable();
            $table->string('do_tgl_exp');
            $table->string('do_batch_number')->nullable();
            $table->string('do_sub_total');
            $table->string('do_hdr_kd');
            $table->string('do_hdr_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('do_detail_item');
    }
};
