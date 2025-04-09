<?php

namespace App\Http\Controllers;

use App\Models\do_detail_item;
use App\Models\do_hdr;
use App\Models\HutangSupplier;
use App\Models\registrasiCreate;
use App\Models\tp_detail_item;
use Illuminate\Cache\RateLimiting\Limit;
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
             ->whereYear('tgl_trs', '=', $yearNow)
            ->whereNull('kd_reg')
            ->GroupBy(DB::Raw("Month(tgl_trs)"))
            ->pluck('monthSales');

        $bulanPenjualan = tp_detail_item::Select(DB::raw("MONTHNAME(tgl_trs) as month"))
            ->whereYear('tgl_trs', '=', $yearNow)
            ->groupBy(DB::raw("MONTHNAME(tgl_trs)"))
            ->pluck('month');

        $getMonthPembelian = do_detail_item::select(DB::raw("SUM(do_sub_total)as monthPembelian"))
            // ->whereYear('tgl_trs', date('Y'))
            ->whereYear('tanggal_trs', '=', $yearNow)
            ->GroupBy(DB::Raw("Month(tanggal_trs)"))
            ->pluck('monthPembelian');

        // dd($getMonthPembelian);
        $bulanPembelian = do_detail_item::Select(DB::raw("MONTHNAME(tanggal_trs) as monthView"))
            ->whereYear('tanggal_trs', '=', $yearNow)
            ->groupBy(DB::raw("MONTHNAME(tanggal_trs)"))
            ->pluck('monthView');


        $obatTerlarisQty = DB::table('tp_detail_item')
            ->leftJoin('mstr_obat', 'tp_detail_item.kd_obat', 'mstr_obat.fm_kd_obat')
            ->select('nm_obat', DB::raw('sum(qty) as total'))
            ->whereYear('tgl_trs', '=', $yearNow)
            ->whereMonth('tgl_trs', '=', $monthNow)
            ->whereNull('kd_reg')
            ->groupBy('nm_obat')
            ->orderBy('total', 'DESC')
            ->limit('10')
            ->pluck('total');
        // dd($obatTerlaris);

        $obatTerlarisName = DB::table('tp_detail_item')
            ->leftJoin('mstr_obat', 'tp_detail_item.kd_obat', 'mstr_obat.fm_kd_obat')
            ->select('nm_obat', 'hrg_obat', DB::raw('sum(qty) as total'))
            ->whereYear('tgl_trs', '=', $yearNow)
            ->whereMonth('tgl_trs', '=', $monthNow)
            ->whereNull('kd_reg')
            ->groupBy('nm_obat', 'hrg_obat')
            ->orderBy('total', 'DESC')
            ->limit('10')
            ->pluck('nm_obat');
        // dd($obatTerlarisQty);

        $kunjunganPasien = registrasiCreate::select(DB::raw("count(*)as totalPasien"))
            ->whereNotNull('fr_tgl_keluar')
            ->GroupBy(DB::Raw("Month(fr_tgl_reg)"))
            ->pluck('totalPasien');
        // dd($kunjunganPasien);

        $bulanKunjungan = registrasiCreate::Select(DB::raw("MONTHNAME(fr_tgl_reg) as month"))
            ->groupBy(DB::raw("MONTHNAME(fr_tgl_reg)"))
            ->pluck('month');
        // dd($bulanKunjungan);

        $topTenDiagnosa = DB::table('chart_tindakan')
            ->select('chart_A_diagnosa', DB::raw('count(*) as total'))
            ->whereNotNull('chart_A_diagnosa')
            ->whereYear('chart_tgl_trs', '=', $yearNow)
            ->whereMonth('chart_tgl_trs', '=', $monthNow)
            ->whereNull('chart_tgl_void')
            ->groupBy('chart_A_diagnosa')
            ->orderBy('total', 'DESC')
            ->limit('10')
            ->pluck('total');
        // dd($topTenDiagnosa);

        $topTenDiagnosaName = DB::table('chart_tindakan')
            ->select('chart_A_diagnosa', DB::raw('count(*) as total'))
            ->whereNotNull('chart_A_diagnosa')
            ->whereYear('chart_tgl_trs', '=', $yearNow)
            ->whereMonth('chart_tgl_trs', '=', $monthNow)
            ->whereNull('chart_tgl_void')
            ->groupBy('chart_A_diagnosa')
            ->orderBy('total', 'DESC')
            ->limit('10')
            ->pluck('chart_A_diagnosa');
        // dd($topTenDiagnosaName);

        return view('Pages.index', [
            'isFakturTempo' => $isFakturTempo,
            'isDefacta' => $isDefacta,
            'getMonthSales' => $getMonthSales,
            'bulanPenjualan' => $bulanPenjualan,
            'getMonthPembelian' => $getMonthPembelian,
            'bulanPembelian' => $bulanPembelian,
            'obatTerlarisQty' => $obatTerlarisQty,
            'obatTerlarisName' => $obatTerlarisName,
            'kunjunganPasien' => $kunjunganPasien,
            'bulanKunjungan' => $bulanKunjungan,
            'topTenDiagnosa' => $topTenDiagnosa,
            'topTenDiagnosaName' => $topTenDiagnosaName,
        ]);
    }
}
