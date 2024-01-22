<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class t_label_timeline extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 't_label_timeline';
    protected $fillable = [
        'reffID',
        'Tgl',
        'labelType',
        'pasienID',
        'layananID',
        'kdReg',
        'pasienName',
        'userID',
        'ketFile',
        'ketHTML'
    ];
}
