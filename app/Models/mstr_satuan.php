<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class mstr_satuan extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'mstr_satuan';
    protected $fillable = ['fm_nm_satuan'];
}
