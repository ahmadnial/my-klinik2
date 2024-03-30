<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chart_images extends Model
{
    use HasFactory;

    protected $table = 'chart_images';
    protected $fillable = [
        'chart_id',
        'chart_noRm',
        'chart_kd_reg',
        'chart_imageName',
        'chart_tglTrs',
        'chart_imageLabel',
        'chart_note',
    ];
}
