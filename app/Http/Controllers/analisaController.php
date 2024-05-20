<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class analisaController extends Controller
{
    public function laporanProdukTerlaris()
    {
        $isUser = DB::table('users')->get();
        return view('Pages.analisa.produk-terlaris', ['isUser' => $isUser]);
    }

    public function getLaporanProdukTerlaris(Request $request)
    {
        // SELECT kd_obat,nm_obat, SUM(qty) qty FROM tp_detail_item where kd_reg is NULL
        // GROUP BY kd_obat,nm_obat ORDER BY qty DESC 
        // $t = $request->all();
        // dd($t);
        if ($request->user == '' && $request->tipeTarif == '') {
            $isDataLaporanDetail = DB::table('tp_detail_item')
                ->leftJoin('mstr_obat', 'tp_detail_item.kd_obat', 'mstr_obat.fm_kd_obat')
                ->select('kd_obat', 'nm_obat', 'hrg_obat', 'satuan', 'fm_hrg_beli_detail', DB::raw('sum(qty) as total'))
                ->whereBetween('tgl_trs', [$request->date1, $request->date2])
                ->whereNull('kd_reg')
                ->groupBy('kd_obat', 'nm_obat', 'hrg_obat', 'satuan')
                ->orderBy('total', 'DESC')
                ->get();
        } else if ($request->user != '' && $request->tipeTarif == '') {
            $isDataLaporanDetail = DB::table('tp_detail_item')
                ->leftJoin('mstr_obat', 'tp_detail_item.kd_obat', 'mstr_obat.fm_kd_obat')
                ->select('kd_obat', 'nm_obat', 'hrg_obat', 'satuan', 'fm_hrg_beli_detail', DB::raw('sum(qty) as total'))
                ->whereBetween('tgl_trs', [$request->date1, $request->date2])
                ->whereNull('kd_reg')
                ->where('tp_detail_item.user', $request->user)
                ->groupBy('kd_obat', 'nm_obat', 'hrg_obat', 'satuan')
                ->get();
        } else if ($request->user == '' && $request->tipeTarif != '') {
            $isDataLaporanDetail = DB::table('tp_detail_item')
                ->leftJoin('mstr_obat', 'tp_detail_item.kd_obat', 'mstr_obat.fm_kd_obat')
                ->select('kd_obat', 'nm_obat', 'hrg_obat', 'satuan', 'fm_hrg_beli_detail', DB::raw('sum(qty) as total'))
                ->whereBetween('tgl_trs', [$request->date1, $request->date2])
                ->whereNull('kd_reg')
                ->where('tp_detail_item.tipeTarif', $request->tipeTarif)
                ->groupBy('kd_obat', 'nm_obat', 'hrg_obat', 'satuan')
                ->get();
        } else if ($request->user != '' && $request->tipeTarif != '') {
            $isDataLaporanDetail = DB::table('tp_detail_item')
                ->leftJoin('mstr_obat', 'tp_detail_item.kd_obat', 'mstr_obat.fm_kd_obat')
                ->select('kd_obat', 'nm_obat', 'hrg_obat', 'satuan', 'fm_hrg_beli_detail', DB::raw('sum(qty) as total'))
                ->whereBetween('tgl_trs', [$request->date1, $request->date2])
                ->whereNull('kd_reg')
                ->where('tp_detail_item.user', $request->user)
                ->where('tp_detail_item.tipeTarif', $request->tipeTarif)
                ->groupBy('kd_obat', 'nm_obat', 'hrg_obat', 'satuan')
                ->get();
        }
        return response()->json($isDataLaporanDetail);
    }
}
