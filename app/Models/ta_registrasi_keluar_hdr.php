<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ta_registrasi_keluar_hdr extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ta_registrasi_keluar_hdr';
    protected $fillable = [
        'kd_trs_reg_out',
        'kp_kd_reg',
        'kp_tgl_keluar',
        'kp_nm_pasien',
        'kp_no_mr',
        'kp_layanan',
        'kp_dokter',
        'nm_tarif_dasar',
        'user',
        'kp_nilai_total'
    ];

    public function tindakan()
    {
        return $this->hasMany(trs_chart::class, 'kd_trs', 'kp_kd_trs_chart');
    }

    public function regoutDetail()
    {
        return $this->hasMany(ta_registrasi_keluar::class, 'kd_trs_reg_out', 'kd_trs_reg_out');
    }
}
