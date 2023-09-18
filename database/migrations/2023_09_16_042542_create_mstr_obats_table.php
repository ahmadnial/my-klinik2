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
        Schema::create('mstr_obat', function (Blueprint $table) {
            $table->string('fm_kd_obat')->unique();
            $table->string('fm_nm_obat');
            $table->string('fm_kategori');
            $table->string('fm_supplier');
            $table->string('fm_satuan_pembelian');
            $table->string('fm_isi_satuan_pembelian');
            $table->string('fm_hrg_beli');
            $table->string('fm_hrg_beli_detail');
            $table->string('fm_satuan_jual');
            $table->string('fm_hrg_jual_non_resep');
            $table->string('fm_hrg_jual_resep');
            $table->string('fm_hrg_jual_nakes');
            $table->boolean('isActive');
            $table->boolean('isOpenPrice');
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
        Schema::dropIfExists('mstr_obat');
    }
};
