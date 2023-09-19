<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class do_detail_item extends Model
{
    use HasFactory;

    protected $table = 'do_detail_item';
    protected $fillable = [
        'do_obat',
        'do_satuan_pembelian',
        'do_diskon',
        'do_qty',
        'do_isi_pembelian',
        'do_satuan_jual',
        'do_hrg_beli',
        'do_pajak',
        'do_tgl_exp',
        'do_batch_number',
        'do_sub_total',
        'do_hdr_kd'
    ];

    public function do_hdr()
    {
        return $this->belongsTo('App\Models\do_hdr');
    }
}
