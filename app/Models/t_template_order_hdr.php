<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_template_order_hdr extends Model
{
    use HasFactory;

    protected $table = 't_template_order_hdr';
    protected $fillable = [
        'kd_to',
        'nm_to',
        'to_user',
    ];
}
