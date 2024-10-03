<?php

namespace App\Http\Controllers;

use App\Models\trs_order_lab;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class trsLabController extends Controller
{
    public function pemeriksaanLab() {
        $listOrderLab = trs_order_lab::select("kd_trs", "chart_id", "kd_reg", "mr_pasien", "nm_pasien")->distinct()->where('isImplementasi', '=', '0')->get();
        return view('pages.laborat.pemeriksaan-lab', ['isListOrderLab' => $listOrderLab]);
    }

     public function getListOrderLab(Request $kd_trs)
    {
        $isListOrderLab = DB::table('trs_order_lab')
            ->leftJoin('tc_mr', 'trs_order_lab.mr_pasien', 'tc_mr.fs_mr')
            ->leftJoin('tarif_lab_hdr', 'trs_order_lab.kd_lab', 'tarif_lab_hdr.kd_tarif')
            ->leftJoin('tarif_lab_detail', 'trs_order_lab.kd_lab', 'tarif_lab_detail.kd_tarif')
            ->select('trs_order_lab.*', 'tc_mr.*', 'tarif_lab_hdr.nilai_tarif', 'tarif_lab_detail.*')
            ->distinct()
            ->where('trs_order_lab.kd_trs', $kd_trs->kd_trs)
            ->where('isimplementasi', '=', '0')
            ->get();
        return response()->json($isListOrderLab);
    }
}
