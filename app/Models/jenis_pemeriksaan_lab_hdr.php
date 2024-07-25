<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis_pemeriksaan_lab_hdr extends Model
{
    use HasFactory;

    protected $table = 'jenis_pemeriksaan_lab_hdr';

    protected $fillable = [
        'kd_jenis_pemeriksaan_lab',
        'nm_jenis_pemeriksaan_lab',
        'satuan_hasil',
        'grup_periksa_sub',
        'metode_uji',
        'user',
    ];
}
