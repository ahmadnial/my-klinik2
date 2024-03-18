<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class lapAccountingController extends Controller
{
    public function laporanLaba()
    {
        return view('pages.laporan.accounting.laporan-laba');
    }


    public function laporanLR(Request $request)
    {
        if ($request->ajax()) {
            $isDataLR = DB::table('tp_detail_item')
                ->leftJoin('mstr_obat', 'tp_detail_item.kd_obat', 'mstr_obat.fm_kd_obat')
                ->select('tp_detail_item.*', 'mstr_obat.fm_hrg_beli_detail')
                // ->select('tp_detail_item.sub_total', 'mstr_obat.fm_hrg_beli_detail', DB::raw('SUM(tp_detail_item.sub_total) AS ttlAll'))
                ->whereBetween('tp_detail_item.tgl_trs', [$request->date1, $request->date2])
                ->whereNull('kd_reg')
                ->sum('tp_detail_item.sub_total');
            // ->groupBy('tp_detail_item.sub_total', 'mstr_obat.fm_hrg_beli_detail')
            // ->get();
        }
        return response()->json($isDataLR);
    }
}
