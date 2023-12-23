<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class mstr_obat extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'mstr_obat';
    protected $fillable = [
        'fm_kd_obat',
        'fm_nm_obat',
        'fm_kategori',
        'fm_golongan_obat',
        'fm_supplier',
        'fm_satuan_pembelian',
        'fm_isi_satuan_pembelian',
        'fm_hrg_beli',
        'fm_hrg_beli_detail',
        'fm_satuan_jual',
        'fm_hrg_jual_non_resep',
        'fm_hrg_jual_resep',
        'fm_hrg_jual_nakes',
        'isActive',
        'isOpenPrice',
        'user',
        'st_isi_pembelian',
        'st_hrg_beli_per1',
        'st_hrg_beli_per2',
        'fm_hrg_jual_non_resep_persen',
        'fm_hrg_jual_resep_persen',
        'fm_hrg_jual_nakes_persen'
    ];
}
