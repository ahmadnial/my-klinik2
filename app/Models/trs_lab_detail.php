<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trs_lab_detail extends Model
{
    use HasFactory;

    protected $table='trs_lab_detail';

    protected $fillable = [
        'kd_trs',
        'kd_reg',
        'tl_tgl_trs',
        'kd_tarif',
        'nm_tarif',
        'hasil',
        'satuan_hasil',
        'nilai_rujukan_normal', 
        'sub_total',
        'user',
        'isVerifikasi'
    ];
}
