<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HutangSupplier extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'hutang_supplier';
    protected $fillable = [
        'hs_kd_hutang',
        'hs_kd_hutang_buat',
        'hs_no_faktur',
        'hs_supplier',
        'hs_kd_rekening',
        'hs_nilai_hutang',
        'hs_pembayaran',
        'hs_potongan',
        'hs_hutang_akhir',
        'hs_tanggal_trs',
        'hs_tanggal_hutang',
        'hs_tanggal_tempo',
        'hs_tanggal_pelunasan',
        'isLunas',
        'user'
    ];
}
