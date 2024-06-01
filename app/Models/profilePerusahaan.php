<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profilePerusahaan extends Model
{
    use HasFactory;

    protected $table = 'profile_perusahaan';
    protected $fillable = [
        'nmPerusahaan',
        'pemilikPerusahaan',
        'pjPerusahaan',
        'alamat',
        'tipePerusahaan',
        'NIB',
        'kd_faskes',
        'noTlp',
        'email',
        'website',
        'NPWP',
        'logo',
    ];
}
