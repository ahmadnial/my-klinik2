<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kartuStockHdr extends Model
{
    use HasFactory;

    protected $table = 'kartu_stock_hdr';
    protected $fillable = [
        'ksh_kd_obat',
        'ksh_nm_obat',
        'ksh_satuan'
    ];
}
