<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class satuan_pemeriksaan_lab extends Model
{
     use HasFactory;

    protected $table = 'satuan_pemeriksaan_lab';
    protected $fillable = ['kd_satuan', 'nm_satuan', 'reference'];
}
