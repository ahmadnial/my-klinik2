<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class ta_trs_chart extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'ta_trs_chart';
    protected $fillable = [
        'kd_trs',
        'tgl_trs',
        'layanan',
        'kd_reg',
        'mr_pasien',
        'nm_pasien',
        'nm_tarif',
        'nm_dokter_jm',
        'sub_total',
        'user',
    ];
}
