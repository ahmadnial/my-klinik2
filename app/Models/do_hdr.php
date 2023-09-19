<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class do_hdr extends Model
{
    use HasFactory;

    protected $table = 'do_hdr';
    protected $fillable = [
        'do_hdr_kd',
        'do_hdr_no_faktur',
        'do_hdr_supplier',
        'do_hdr_tgl_tempo',
        'do_hdr_lokasi_stock',
        'do_hdr_total_faktur',
        'user'
    ];

    public function do_detail_item()
    {
        return $this->hasMany('App\Models\do_detail_item');
    }
}
