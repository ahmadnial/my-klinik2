<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tp_detail_item extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tp_detail_item';

    protected $fillable = [
        'kd_trs',
        'kd_reg',
        'kd_obat',
        'nm_obat',
        // 'dosis',
        'hrg_obat',
        'qty',
        'diskon',
        'satuan',
        'tax',
        // 'tulsah',
        // 'embalase',
        'sub_total',
        // 'etiket',
        'signa',
        'cara_pakai',
        'tgl_trs',
        'user',
        'tuslah',
        'embalase'
    ];
}
