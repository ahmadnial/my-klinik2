<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mstr_dokter extends Model
{
    use HasFactory;

    protected $table = 'mstr_dokter';
    protected $fillable = [
        'fm_kd_medis',
        'fm_nm_medis',
        'fm_sip_medis',
        'fm_kadaluarsa_sip',
        'fm_layanan',
    ];
}
