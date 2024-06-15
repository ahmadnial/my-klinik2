<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class po_hdr extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'po_hdr';
    protected $fillable = [
        'po_hdr_kd',
        'po_tgl_trs',
        'po_jenis_pembelian',
        'po_hdr_supplier',
        'po_hdr_kategori',
        'po_hdr_total_faktur',
        'user'
    ];

    public function hdrToDetail()
    {
        return $this->hasMany(po_detail_item::class, 'po_hdr_kd', 'po_hdr_kd');
    }
}
