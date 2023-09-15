<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class mstr_jenis_obat extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'mstr_jenis_obat';
    protected $fillable = ['fm_nm_jenis_obat'];
}
