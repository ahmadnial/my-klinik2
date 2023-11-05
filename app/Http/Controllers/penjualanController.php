<?php

namespace App\Http\Controllers;

use App\Models\mstr_obat;
use App\Models\penjualanFarmasi;
use App\Models\tp_hdr;
use Illuminate\Http\Request;

class penjualanController extends Controller
{
    public function penjualan()
    {
        // $num = str_pad(000001, 6, 0, STR_PAD_LEFT);
        // $Y = date("Y");
        // $M = date("m");
        // $cekid = tp_hdr::count();
        // if ($cekid == 0) {
        //     $noRef =  'TP'  . '-' . substr($Y, -2) . $M . '-' . $num;
        // } else {
        //     $continue = tp_hdr::all()->last();
        //     $de = substr($continue->do_hdr_kd, -6);
        //     $noRef = 'TP' . '-' . substr($Y, -2) . $M  . '-' . str_pad(($de + 1), 6, '0', STR_PAD_LEFT);
        // };
        // return view('Pages.penjualan', ['noRef' => $noRef]);
        return view('Pages.penjualan');
    }

    public function getListObatReguler()
    {
        $isObatReguler = mstr_obat::select("fm_kd_obat", "fm_nm_obat", "fm_satuan_jual", "fm_hrg_beli", "fm_hrg_jual_non_resep")->get();
        // dd($isdata2);
        return response()->json($isObatReguler);
    }

    public function getListObatResep()
    {
        $isObatResep = mstr_obat::select("fm_kd_obat", "fm_nm_obat", "fm_satuan_jual", "fm_hrg_beli", "fm_hrg_jual_resep")->get();
        // dd($isdata2);
        return response()->json($isObatResep);
    }

    public function getListObatNakes()
    {
        $isObatNakes = mstr_obat::select("fm_kd_obat", "fm_nm_obat", "fm_satuan_jual", "fm_hrg_beli", "fm_hrg_jual_nakes")->get();
        // dd($isdata2);
        return response()->json($isObatNakes);
    }
}
