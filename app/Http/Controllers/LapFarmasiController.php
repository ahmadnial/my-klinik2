<?php

namespace App\Http\Controllers;

use App\Models\do_detail_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LapFarmasiController extends Controller
{

    public function lapPenjualanFarmasi()
    {
        return view('pages.laporan.farmasi.laporan-penjualan-farmasi');
    }

    public function lapPenjualanFarmasiDetail()
    {
        return view('pages.laporan.farmasi.laporan-penjualan-detail');
    }



    public function getLapPenjualan(Request $request)
    {
        // $t = $request->all();
        // dd($t);
        if ($request->ajax()) {
            $isDataLaporan = DB::table('tp_hdr')
                ->whereBetween('tgl_trs', [$request->date1, $request->date2])
                ->whereNull('kd_order_resep')
                // ->where('kd_order_resep', '=', 'null')
                ->get();
        }
        return response()->json($isDataLaporan);
    }

    public function getLapPenjualanDetail(Request $request)
    {
        // $t = $request->all();
        // dd($t);
        if ($request->ajax()) {
            $isDataLaporanDetail = DB::table('tp_detail_item')
                ->select('kd_trs', 'kd_obat', 'nm_obat', 'hrg_obat', 'qty', 'satuan', 'sub_total', 'created_at')
                ->distinct()
                ->whereBetween('tgl_trs', [$request->date1, $request->date2])
                ->whereNull('kd_reg')
                // ->where('kd_order_resep', '=', 'null')
                ->first();
        }
        return response()->json($isDataLaporanDetail);
    }

    public function bukuStok()
    {
        return view('pages.laporan.farmasi.buku-stok');
    }

    public function getBukuStok(Request $request)
    {
        // $t = $request->all();
        // dd($t);
        if ($request->ajax()) {
            $isDataBukuStok = DB::table('tb_stock')
                ->leftJoin('mstr_obat', 'tb_stock.kd_obat', 'mstr_obat.fm_kd_obat')
                ->select('mstr_obat.*', 'tb_stock.*')
                ->get();
        }
        return response()->json($isDataBukuStok);
    }

    // LAPORAN REG MASUK
    public function lapRegMasuk()
    {
        return view('pages.laporan.registrasi.laporan-registrasi-masuk');
    }

    public function getLapRegMasuk(Request $request)
    {
        // $t = $request->all();
        // dd($t);
        if ($request->ajax()) {
            $isDataRegMasuk = DB::table('ta_registrasi')
                ->whereBetween('fr_tgl_reg', [$request->date1, $request->date2])
                // ->whereNull('kd_order_resep')
                ->get();
        }
        return response()->json($isDataRegMasuk);
    }

    // LAPORAN PENDAPATAN KLINIK
    public function lapKlinikRekap()
    {
        return view('pages.laporan.klinik.pendapatan-klinik-rekap');
    }

    public function getLapPendapatanKlinik(Request $request)
    {
        if ($request->ajax()) {
            $isDataPendapatan = DB::table('rekening_pendapatan_poliklinik_total')
                ->whereBetween('rk_tgl_regout', [$request->date1, $request->date2])
                ->get();
        }
        return response()->json($isDataPendapatan);
    }

    function pembelianDetail()
    {
        return view('pages.laporan.farmasi.pembelian-detail');
    }

    function getPembelianDetail(Request $request)
    {
        if ($request->ajax()) {
            $isDataPenjualanDetail = do_detail_item::whereBetween(DB::raw('DATE(created_at)'), [$request->date1, $request->date2])
                // ->leftJoin('do_hdr', 'do_hdr_kd', '=', 'do_hdr_kd')
                // ->select('do_hdr')
                ->get();
        }
        return response()->json($isDataPenjualanDetail);
    }
}
