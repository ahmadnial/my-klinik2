<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tb_adjusment_detail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_adjusment_detail';

    protected $fillable = [
        'kd_adj',
        'kd_obat',
        'nm_obat',
        'satuan',
        'qty_awal',
        'qty_sebenarnya',
        'koreksi_adj',
        'nilai_hpp',
        'sub_total_adjusment',
        'user',
        'keterangan1',
        'keterangan2'
    ];
}
