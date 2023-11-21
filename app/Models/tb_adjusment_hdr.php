<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tb_adjusment_hdr extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_adjusment_hdr';

    protected $fillable = [
        'kd_adj',
        'tgl_trs',
        'tgl_void',
        'periode_adjusment',
        'nilai_total_adjusment',
        'keterangan'
    ];
}
