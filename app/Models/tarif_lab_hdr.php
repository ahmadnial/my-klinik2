<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tarif_lab_hdr extends Model
{
    use HasFactory;

    protected $table = 'tarif_lab_hdr';

    protected $fillable = ['kd_tarif', 'nm_tarif', 'rekap_cetak', 'nilai_tarif', 'keterangan_tarif', 'tgl_expired', 'isActive', 'user'];
}
