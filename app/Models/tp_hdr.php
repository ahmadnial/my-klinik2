<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tp_hdr extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tp_hdr';

    protected $fillable = [
        'kd_trs',
        'kd_order_resep',
        'layanan_order',
        'dokter',
        'sip_dokter',
        'jaminan',
        'lokasi_stock',
        'kd_reg',
        'no_mr',
        'nm_pasien',
        'alamat',
        'jenis_kelamin',
        'tgl_lahir',
        'tipe_tarif',
        'total_penjualan',
        'tgl_trs'
    ];

    public function tpdetail()
    {
        return $this->hasMany(tp_detail_item::class, 'kd_reg', 'kd_reg');
    }
}
