<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tarif_lab_detail extends Model
{
    use HasFactory;

    protected $table = 'tarif_lab_detail';

    protected $fillable = ['kd_tarif', 'nm_tarif', 'kd_jenis_pemeriksaan_lab', 'jenis_kelamin', 'batas_bawah', 'batas_atas', 'ket_normal', 'tgl_expired', 'isActive','satuan_hasil'];
}
