<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_template_order_detail extends Model
{
    use HasFactory;

    protected $table = 't_template_order_detail';
    protected $fillable = [
        'kd_to',
        'kd_obat_to',
        'nm_obat_to',
        'hrg_obat_to',
        'qty_to',
        'satuan_to',
        'signa_to',
        'cara_pakai_to',
    ];
}
