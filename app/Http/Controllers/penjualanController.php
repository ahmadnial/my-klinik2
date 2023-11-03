<?php

namespace App\Http\Controllers;

use App\Models\mstr_obat;
use Illuminate\Http\Request;

class penjualanController extends Controller
{
    public function penjualan()
    {
        return view('Pages.penjualan');
    }

    public function getListObatReguler()
    {
        // $true = 'Amoxcillin 500mg';
        $isObatReguler = mstr_obat::select("fm_kd_obat", "fm_nm_obat", "fm_satuan_jual", "fm_hrg_beli", "fm_hrg_jual_non_resep")->get();
        // dd($isdata2);
        return response()->json($isObatReguler);
    }
}
