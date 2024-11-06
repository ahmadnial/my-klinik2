<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trs_lab_hdr extends Model
{
    use HasFactory;

    protected $table = 'trs_lab_hdr';

    protected $fillable = ['kd_trs', 'tl_kd_reg', 'tl_tgl_trs', 'tl_layanan', 'tl_dokter_pengirim', 'tl_no_mr', 'tl_nama', 'tl_alamat', 'tl_jenis_kelamin', 'tl_tgl_lahir', 'user', 'isVerifikasi', 'tl_total_tarif'];
}
