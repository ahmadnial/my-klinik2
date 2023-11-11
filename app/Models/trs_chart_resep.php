<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class trs_chart_resep extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'trs_chart_resep';

    protected $fillable = [
        'kd_trs',
        'kd_resep',
        'chart_id',
        'tgl_trs',
        'layanan',
        'kd_reg',
        'mr_pasien',
        'nm_pasien',
        'ch_kd_obat',
        'ch_nm_obat',
        'ch_qty_obat',
        'ch_satuan_obat',
        'ch_signa',
        'ch_cara_pakai',
        'ch_hrg_jual',
    ];
}
