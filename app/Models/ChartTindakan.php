<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChartTindakan extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'chart_tindakan';
    protected $fillable = [
        'chart_id',
        'chart_tgl_trs',
        'chart_kd_reg',
        'chart_mr',
        'chart_nm_pasien',
        'chart_layanan',
        'chart_dokter',
        'user',
        'chart_S',
        'chart_O',
        'chart_A',
        'chart_A_diagnosa',
        'chart_P',
        'chart_P_resep',
        'chart_P_tindakan',
        'ttv_BW',
        'ttv_BH',
        'ttv_BPs',
        'ttv_BPd',
        'ttv_BT',
        'ttv_HR',
        'ttv_RR',
        'ttv_SN',
        'ttv_SPO2'
    ];


    public function trstdk(): HasMany
    {
        return $this->hasMany(trs_chart::class, 'chart_id', 'chart_id');
    }

    public function resep()
    {
        return $this->hasMany(trs_chart_resep::class, 'chart_id', 'chart_id');
    }

    public function obatpulang()
    {
        return $this->hasMany(tp_hdr::class, 'no_mr', 'chart_mr');
    }

    public function arsipobatpulang()
    {
        return $this->hasMany(t_label_timeline::class, 'kdReg', 'chart_kd_reg');
    }

    public function images()
    {
        return $this->hasMany(chart_images::class, 'chart_noRm', 'chart_mr');
    }
}
