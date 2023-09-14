<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mstr_kategori_produk extends Model
{
    use HasFactory;

    protected $table = 'mstr_kategori_produk';
    protected $fillable = ['fm_nm_kategori_produk'];
}
