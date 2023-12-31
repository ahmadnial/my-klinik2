<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class do_hdr extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'do_hdr';
    protected $fillable = [
        'tanggal_trs',
        'do_hdr_kd',
        'do_hdr_no_faktur',
        'do_hdr_supplier',
        'do_hdr_tgl_tempo',
        // 'do_hdr_lokasi_stock',
        'do_hdr_total_faktur',
        'user'
    ];

    public function hdrToDetail()
    {
        return $this->hasMany(do_detail_item::class, 'do_hdr_kd', 'do_hdr_kd');
    }

    // public function trstdk(): HasMany
    // {
    //     return $this->hasMany(trs_chart::class, 'chart_id', 'chart_id');
    // }
}
