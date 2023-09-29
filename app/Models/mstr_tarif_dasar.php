<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class mstr_tarif_dasar extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'mstr_tarif_dasar';
    protected $fillable = [
        'nm_tarif_dasar',
        'ket_tarif_dasar',
        'nilai_tarif_dasar',
    ];
}
