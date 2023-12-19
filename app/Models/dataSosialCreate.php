<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class dataSosialCreate extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tc_mr';

    protected $fillable = [
        'fs_mr',
        'fs_nama',
        'fs_tempat_lahir',
        'fs_tgl_lahir',
        'fs_jenis_kelamin',
        'fs_jenis_identitas',
        'fs_no_identitas',
        'fs_nm_ibu_kandung',
        'fs_alamat',
        // 'provinsi',
        // 'kota',
        // 'kecamatan',
        // 'desa',
        'fs_suku',
        'fs_bahasa',
        'fs_agama',
        'fs_pekerjaan',
        'fs_pendidikan',
        'fs_status_kawin',
        'fs_no_hp',
        'fs_alergi',
        'fs_tgl_kunjungan_terakhir',
        'fs_layanan_kunjungan_terakhir',
        'fs_tanggal_meninggal',
        'fs_user'
    ];
}
