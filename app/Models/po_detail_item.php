<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class po_detail_item extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'po_detail_item';
    protected $fillable = [
        'po_hdr_kd',
        'po_tgl_trs',
        'po_obat',
        'po_nm_obat',
        'po_satuan_pembelian',
        'po_diskon',
        'po_diskon_prosen',
        'po_qty',
        'po_isi_pembelian',
        'po_satuan_jual',
        'po_hrg_beli',
        'po_pajak',
        'po_tgl_exp',
        'po_batch_number',
        'po_sub_total'
    ];

    public function toHdr()
    {
        return $this->hasOne(po_hdr::class, 'po_hdr_kd', 'po_hdr_kd');
    }
}
