<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pelunasanHutangSupplier extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pelunasan_hutang_supplier';

    protected $fillable = [
        'pl_kd_hutang',
        'pl_kd_pelunasan',
        'pl_kd_hutang_buat',
        'pl_no_kuitansi',
        'pl_no_faktur',
        'pl_supplier',
        'pl_kd_rekening',
        'pl_nilai_hutang',
        'pl_pembayaran',
        'pl_potongan',
        'pl_hutang_akhir',
        'pl_tanggal_trs',
        'pl_tanggal_hutang',
        'pl_tanggal_tempo',
        'pl_tanggal_pelunasan',
        'pl_cara_bayar',
        'pl_kd_pelunasan',
        'user'
    ];
}
