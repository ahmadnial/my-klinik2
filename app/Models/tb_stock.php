<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_stock extends Model
{
    use HasFactory;

    protected $table = 'tb_stock';
    protected $fillable = [
        'kd_obat',
        'nm_obat',
        'qty',
        'satuan',
    ];
    protected $cast = [
        'kd_obat',
        'qty' => 'integer',
    ];
}
