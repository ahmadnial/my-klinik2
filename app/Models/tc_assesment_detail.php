<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tc_assesment_detail extends Model
{
    use HasFactory;

    protected $table = 'tc_assesment_detail';
    protected $fillable = [
        'assId',
        'tglTrs',
        'jamTrs',
        'kdReg',
        'noMr',
        'user',
        'fs_keluhan_utama',
        'fs_anamnesis',
        'fs_rwyt_penyakit',
        'fs_rwyt_skt_klrg',
        'fs_rwyt_obt_sebelum',
        'fs_rwyt_alergi_1',
        'fs_rwyt_alergi_2',
        'fs_rwyt_alergi_3',
        'fs_rwyt_alergi_4',
        'fs_gcs_e',
        'fs_gcs_V',
        'fs_gcs_m',
        'fs_td',
        'fs_N_1',
        'fs_R_1',
        'fs_S_1',
        'fs_kepala',
        'fs_leher',
        'fs_thorax',
        'fs_abdomen',
        'fs_ekstremitas',
        'fs_genetalia',
        'fs_periksa_penunjang',
        'fs_diag_banding',
        'fs_diag_kerja',
        'fs_mslh_medis',
        'fs_instruksi_medis',
        'fb_disposisi',
        'fb_disposisi2',
        'fb_disposisi3',
        'fb_disposisi6',
        'fb_disposisi7',
        'fs_kontrol_klinik',
        'fs_rujuk',
        'fs_meninggal',
        'fs_pasien',
        'fs_klrg_pasien',
        'fs_tdk_dpt_edu',
        'fd_tgl_ttd',
        'fs_jam_ttd',
        'fs_dokter_assessment',
    ];
}
