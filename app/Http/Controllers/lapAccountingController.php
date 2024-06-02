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

    public function labaRugiPerItem()
    {
        return view('pages.laporan.accounting.laba-rugi-peritem');
    }

    public function getLabaRugiPerItem(Request $request)
    {
        // $t = $request->all();
        // dd($t);
        $isDataLaporanDetail = DB::table('tp_detail_item')
            ->leftJoin('mstr_obat', 'tp_detail_item.kd_obat', 'mstr_obat.fm_kd_obat')
            ->select('kd_obat', 'nm_obat', 'hrg_obat', 'satuan', 'fm_hrg_beli_detail', 'fm_kategori', 'fm_golongan_obat', DB::raw('sum(qty) as total'))
            ->whereBetween('tgl_trs', [$request->date1, $request->date2])
            ->whereNull('kd_reg')
            ->groupBy('kd_obat', 'nm_obat', 'hrg_obat', 'satuan')
            ->get();

        return response()->json($isDataLaporanDetail);
    }
}
