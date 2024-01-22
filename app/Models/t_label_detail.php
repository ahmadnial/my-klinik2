<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class t_label_detail extends Model
{
    use HasFactory;

    protected $table = 't_label_detail';
    protected $fillable = [
        'reffID',
        'Tgl',
        'pasienID',
        'kd_obat',
        'nm_obat',
        'qty_obat',
        'satuan_obat',
        'cara_pakai',
        'tindakan',
        'keteranganHTML'
    ];
}
