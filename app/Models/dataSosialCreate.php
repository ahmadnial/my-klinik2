<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dataSosialCreate extends Model
{
    use HasFactory;

    protected $table = 'tc_mr';

    protected $fillable = [
        'fs_mr',
        'fs_nama',
        'fs_tgl_lahir',
        'fs_jenis_kelamin',
        'fs_alamat',
        'fs_no_hp',
        'fs_user'
    ];
}
