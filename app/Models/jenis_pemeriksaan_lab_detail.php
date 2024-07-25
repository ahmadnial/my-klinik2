<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis_pemeriksaan_lab_detail extends Model
{
    use HasFactory;

    protected $table = 'jenis_pemeriksaan_lab_detail';

    protected $fillable = [
            'kd_jenis_pemeriksaan_lab',
            'jenis_kelamin',
            'batas_atas',
            'batas_bawah',
            'ket_normal',
    ];
}
