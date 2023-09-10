<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class registrasiCreate extends Model
{
    use HasFactory;

    protected $table = 'ta_registrasi';

    protected $fillable = [
        'fr_kd_reg',
        'fr_mr',
        'fr_nama',
        'fr_tgl_lahir',
        'fr_jenis_kelamin',
        'fr_alamat',
        'fr_no_hp',
        'fr_layanan',
        'fr_medis',
        'fr_jaminan',
        'fr_bb',
        'fr_alergi',
        'fr_user'
    ];
}
