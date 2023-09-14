<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mstr_jenis_obat extends Model
{
    use HasFactory;

    private $table = 'mstr_jenis_obat';
    private $fillable = ['fm_nm_jenis_obat'];
}
