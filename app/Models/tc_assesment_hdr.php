<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tc_assesment_hdr extends Model
{
    use HasFactory;

    protected $table = 'tc_assesment_hdr';

    protected $fillable = [
        'assId',
        'assLabel',
        'tglTrs',
        'jamTrs',
        'kdReg',
        'noMr',
        'pasienName',
        'jeniskelamin',
        'dokter',
        'tglLahir',
        'umur',
        'layanan',
        'tglVoid',
        'user'
    ];
}
