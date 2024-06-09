<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class aktifasiRegister extends Model
{
    use HasFactory;

    protected $table = 'aktifasi_register';
    protected $fillable = [
        'kd_aktifasi',
        'tgl_trs_aktifasi',
        'tgl_aktifasi_aktif',
        'user_aktifasi',
        'layanan_aktifasi',
        'reg_aktifasi',
        'mr_aktifasi',
        'nm_pasien_aktifasi',
        'tgl_deaktif',
    ];
}
