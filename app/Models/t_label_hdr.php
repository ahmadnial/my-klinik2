<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class t_label_hdr extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 't_label_hdr';
    protected $fillable = [
        'reffID',
        'Tgl',
        'labelType',
        'pasienID',
        'layananID',
        'kdReg',
        'pasienName',
    ];

    public function resep()
    {
        return $this->hasMany(t_label_detail::class, 'pasienID', 'pasienID');
    }
}
