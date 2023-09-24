<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChartTindakan extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'chart_tindakan';
    protected $fillable = [
        'chart_id',
        'chart_tgl_trs',
        'chart_kd_reg',
        'chart_mr',
        'chart_nm_pasien',
        'chart_layanan',
        'chart_dokter',
        'user',
        'chart_S',
        'chart_O',
        'chart_A',
        'chart_A_diagnosa',
        'chart_P',
        'chart_P_resep',
        'chart_P_tindakan'
    ];
}
