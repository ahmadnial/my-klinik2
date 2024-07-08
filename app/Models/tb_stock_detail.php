<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_stock_detail extends Model
{
    use HasFactory;

    protected $table = 'tb_stock_detail';

    protected $fillable = [
        'kd_trs',
        'kd_obat',
        'nm_obat',
        'layanan',
        'qty',
        'hpp',
        'kd_po',
        'kd_do',
        'tgl_do',
        'kd_mutasi',
        'tgl_mutasi',
        'tgl_ed',
        'no_batch',
        'satuan',
    ];
}
