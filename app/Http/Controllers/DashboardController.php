<?php

namespace App\Http\Controllers;

use App\Models\do_hdr;
use App\Models\HutangSupplier;
use App\Models\tp_detail_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Termwind\Components\Raw;

class DashboardController extends Controller
{
    public function index()
    {
        $dateNow = Carbon::now()->format("Y-m-d");
        $monthNow = Carbon::now()->format("m");
        $yearNow = Carbon::now()->format("Y");
        // $isListPenjualan = tp_hdr::whereyear('tgl_trs', '=', $yearNow)->whereMonth('tgl_trs', '=', $monthNow)->orderBy('created_at', 'desc')->get();
        $isFakturTempo = HutangSupplier::whereyear('hs_tanggal_tempo', '=', $yearNow)->whereMonth('hs_tanggal_tempo', '=', $monthNow)->where('isLunas', '=', '0')->orderBy('hs_tanggal_tempo', 'desc')->get();

        $isDefacta = DB::table('tb_stock')
            ->where('qty', '<=', 20)
            ->leftJoin('mstr_obat', 'tb_stock.kd_obat', 'mstr_obat.fm_kd_obat')
            // ->leftJoin('tp_detail_item', 'tb_stock.kd_obat', 'mstr_obat.fm_kd_obat')
            ->get();

        $getMonthSales = tp_detail_item::select(DB::raw("SUM(sub_total)as monthSales"))
            // ->whereYear('tgl_trs', date('Y'))
            ->whereNull('kd_reg')
            ->GroupBy(DB::Raw("Month(tgl_trs)"))
            ->pluck('monthSales');
        // dd($getMonthSales);

        $bulanPenjualan = tp_detail_item::Select(DB::raw("MONTHNAME(tgl_trs) as month"))
            ->groupBy(DB::raw("MONTHNAME(tgl_trs)"))
            ->pluck('month');

        // dd($bulanPenjualan);

        return view('Pages.index', [
            'isFakturTempo' => $isFakturTempo,
            'isDefacta' => $isDefacta,
            'getMonthSales' => $getMonthSales,
            'bulanPenjualan' => $bulanPenjualan
        ]);
    }
}
