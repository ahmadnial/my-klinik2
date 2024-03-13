<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ta_registrasi_keluar extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ta_registrasi_keluar';
    protected $fillable = [
        'kd_trs_reg_out',
        'trs_kp_kd_reg',
        'trs_kp_tgl_keluar',
        'trs_kp_nm_pasien',
        'trs_kp_no_mr',
        'trs_kp_layanan',
        'trs_kp_dokter',
        'nm_tarif_dasar',
        'trs_kp_kd_trs_chart',
        'trs_kp_nm_tarif',
        'trs_kp_nilai_tarif',
        'user',
        // 'trs_kp_kd_trs_chart',
        // 'trs_kp_nm_tarif',
        // 'trs_kp_nilai_tarif',
        'trs_kp_nilai_total'
    ];

    public function tindakan()
    {
        return $this->hasMany(trs_chart::class, 'kd_trs', 'trs_kp_kd_trs_chart');
    }
}
