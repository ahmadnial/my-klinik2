<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class registrasiCreate extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ta_registrasi';

    protected $fillable = [
        'fr_kd_reg',
        'fr_mr',
        'fr_nama',
        'fr_tgl_lahir',
        'fr_tgl_reg',
        'fr_jenis_kelamin',
        'fr_alamat',
        'fr_no_hp',
        'fr_layanan',
        'fr_dokter',
        'fr_jaminan',
        'fr_session_poli',
        'fr_bb',
        'fr_alergi',
        'fr_user',
        'keluhan_utama',
        'ttv_BW',
        'ttv_BH',
        'ttv_BPs',
        'ttv_BPd',
        'ttv_BT',
        'ttv_HR',
        'ttv_RR',
        'ttv_SN',
        'ttv_SPO2',
        'deleted_at'
    ];

    public function tcmr()
    {
        return $this->hasOne(dataSosialCreate::class, 'fs_mr', 'fr_mr');
    }
}
