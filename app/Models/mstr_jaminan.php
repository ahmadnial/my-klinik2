<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mstr_jaminan extends Model
{
    use HasFactory;

    protected $table = 'mstr_jaminan';
    protected $fillable = [
        'fm_kd_jaminan',
        'fm_nm_jaminan',
    ];
}
