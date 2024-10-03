<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trs_order_lab extends Model
{
    use HasFactory;

    protected $table = 'trs_order_lab';
    protected $fillable = [
        'kd_trs',
        'chart_id',
        'tgl_trs',
        'layanan',
        'kd_reg',
        'mr_pasien',
        'nm_pasien',
        'kd_lab',
        'nm_dokter_jm',
        'user',
        'isImplementasi',
        'isVerifikasi'
    ];
}
