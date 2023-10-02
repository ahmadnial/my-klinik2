<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class mstr_nilai_tindakan extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'mstr_nilai_tindakan';
    protected $fillable = [
        'id_tindakan',
        // 'nm_tindakan',
        'nilai_tarif',
    ];
}
