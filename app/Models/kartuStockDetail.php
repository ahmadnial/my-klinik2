<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kartuStockDetail extends Model
{
    use HasFactory;

    protected $table = 'kartu_stock_detail';
    protected $fillable = [
        'tanggal_trs',
        'kd_obat',
        'nm_obat',
        'kd_trs',
        'supplier',
        'no_batch',
        'expired_date',
        'qty_awal',
        'qty_masuk',
        'qty_keluar',
        'qty_akhir',
        'hpp_satuan'
    ];
}
