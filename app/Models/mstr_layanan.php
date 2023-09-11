<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class mstr_layanan extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'mstr_layanan';
    protected $fillable = [
        'fm_kd_layanan',
        'fm_nm_layanan',
    ];
}
