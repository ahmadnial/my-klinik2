<?php

namespace App\Http\Controllers;

use App\Models\do_detail_item;
use App\Models\kartuStockHdr;
use App\Models\mstr_dokter;
use App\Models\mstr_tindakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

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
        $isMstrMedis =  mstr_dokter::all();

        return view('pages.laporan.registrasi.laporan-registrasi-masuk', ['isMstrMedis' => $isMstrMedis]);
    }

    public function getLapRegMasuk(Request $request)
    {
        $start = $request->date1;
        $end = $request->date2;
        $medis = $request->medis;
        $session = $request->session;
        if ($request->ajax()) {
            if ($medis && !$session) {
                $isDataRegMasuk = DB::table('ta_registrasi')
                    ->whereBetween('fr_tgl_reg', [$start, $end])
                    ->where([
                        ['fr_dokter', '=', $medis],
                        ['deleted_at', '=', null],
                    ])
                    ->latest()
                    ->get();
            } elseif ($session && !$medis) {
                $isDataRegMasuk = DB::table('ta_registrasi')
                    ->whereBetween('fr_tgl_reg', [$start, $end])
                    ->where([
                        ['fr_session_poli', '=', $session],
                        ['deleted_at', '=', null],
                    ])
                    ->latest()
                    ->get();
            } elseif ($medis && $session) {
                $isDataRegMasuk = DB::table('ta_registrasi')
                    ->whereBetween('fr_tgl_reg', [$start, $end])
                    ->where([
                        ['fr_dokter', '=', $medis],
                        ['fr_session_poli', '=', $session],
                        ['deleted_at', '=', null],
                    ])
                    ->latest()
                    ->get();
            } else {
                $isDataRegMasuk = DB::table('ta_registrasi')
                    ->whereBetween('fr_tgl_reg', [$start, $end])->where('deleted_at', '=', null)->latest()->get();
            }
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
            $isDataPenjualanDetail = do_detail_item::whereBetween(DB::raw('DATE(do_detail_item.created_at)'), [$request->date1, $request->date2])
                ->leftJoin('do_hdr', 'do_detail_item.do_hdr_kd', 'do_hdr.do_hdr_kd')
                ->select('do_detail_item.*', 'do_hdr.do_hdr_supplier')
                ->get();
            return response()->json($isDataPenjualanDetail);
        }
    }

    function infoTindakan()
    {
        $isMstrMedis =  mstr_dokter::all();
        $isMstrTdk =  mstr_tindakan::all();
        return view('pages.laporan.klinik.info-tindakan', [
            'isMstrMedis' => $isMstrMedis,
            'isMstrTdk' => $isMstrTdk
        ]);
    }

    function getinfoTindakan(Request $request)
    {
        $start = $request->date1;
        $end = $request->date2;
        $medis = $request->medis;
        $tindakan = $request->tindakan;
        if ($request->ajax()) {
            if ($medis && !$tindakan) {
                $isDataTindakan = DB::table('trs_chart')
                    ->leftJoin('mstr_tindakan', 'trs_chart.nm_tarif', 'mstr_tindakan.id')
                    ->whereBetween('trs_chart.tgl_trs', [$start, $end])
                    ->where([
                        ['nm_dokter_jm', '=', $medis],
                        ['trs_chart.deleted_at', '=', null],
                        ['trs_chart.nm_tarif', '!=', null || ''],
                    ])
                    ->get();
            } elseif ($tindakan && !$medis) {
                $isDataTindakan = DB::table('trs_chart')
                    ->leftJoin('mstr_tindakan', 'trs_chart.nm_tarif', 'mstr_tindakan.id')
                    ->whereBetween('trs_chart.tgl_trs', [$start, $end])
                    ->where([
                        ['nm_tarif', '=', $tindakan],
                        ['trs_chart.deleted_at', '=', null],
                        ['trs_chart.nm_tarif', '!=', null || ''],
                    ])
                    ->get();
            } elseif ($medis && $tindakan) {
                $isDataTindakan = DB::table('trs_chart')
                    ->leftJoin('mstr_tindakan', 'trs_chart.nm_tarif', 'mstr_tindakan.id')
                    ->whereBetween('trs_chart.tgl_trs', [$start, $end])
                    ->where([
                        ['nm_dokter_jm', '=', $medis],
                        ['nm_tarif', '=', $tindakan],
                        ['trs_chart.deleted_at', '=', null],
                        ['trs_chart.nm_tarif', '!=', null || ''],
                    ])
                    ->get();
            } else {
                $isDataTindakan = DB::table('trs_chart')
                    ->leftJoin('mstr_tindakan', 'trs_chart.nm_tarif', 'mstr_tindakan.id')
                    ->whereBetween('trs_chart.tgl_trs', [$start, $end])->where([
                        ['trs_chart.deleted_at', '=', null],
                        ['trs_chart.nm_tarif', '!=', null || ''],
                    ])->get();
            }
        }
        return response()->json($isDataTindakan);
    }

    public function karatuStok()
    {
        return view('pages.laporan.farmasi.kartu-stok');
    }

    public function itemObatSearch(Request $request)
    {
        $isdataKS = [];

        if ($request->filled('q')) {
            $isdataKS = kartuStockHdr::select("ksh_kd_obat", "ksh_nm_obat", "ksh_satuan")
                ->where('ksh_nm_obat', 'LIKE', '%' . $request->get('q') . '%')
                ->get();
        }
        return response()->json($isdataKS);
    }

    public function getKartuStok(Request $request)
    {
        $start = $request->date1;
        $end = $request->date2;
        $kdobat = $request->kdObat;

        if ($request->ajax()) {
            $isKartuStock = DB::table('kartu_stock_hdr')->whereBetween('kartu_stock_detail.tanggal_trs', [$start, $end])
                ->where('ksh_kd_obat', $kdobat)
                ->leftJoin('kartu_stock_detail', 'kartu_stock_detail.kd_obat', 'kartu_stock_hdr.ksh_kd_obat')
                ->select('kartu_stock_hdr.*', 'kartu_stock_detail.*')
                ->get();
            return response()->json($isKartuStock);
        }
    }
}
