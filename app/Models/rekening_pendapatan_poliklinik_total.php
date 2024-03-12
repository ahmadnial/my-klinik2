<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class rekening_pendapatan_poliklinik_total extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rekening_pendapatan_poliklinik_total';
    protected $fillable = [
        'rk_kd_reg',
        'rk_tgl_regout',
        'rk_no_mr',
        'rk_layanan',
        'rk_nilai',
        'rk_pasienName',
        'rk_session_poli',
        'rk_dokter',
    ];
}
