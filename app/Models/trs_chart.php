<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class trs_chart extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'trs_chart';
    protected $fillable = [
        'kd_trs',
        'kd_resep',
        'chart_id',
        'tgl_trs',
        'layanan',
        'kd_reg',
        'mr_pasien',
        'nm_pasien',
        'nm_tarif',
        'resep',
        'nm_tarif_dasar',
        'nm_dokter_jm',
        'sub_total',
        'tgl_void',
        'user_void',
        'user',
    ];
}
