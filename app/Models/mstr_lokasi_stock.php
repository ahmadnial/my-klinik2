<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class mstr_lokasi_stock extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'mstr_lokasi_stock';
    protected $fillable = ['fm_nm_lokasi_stock'];
}
