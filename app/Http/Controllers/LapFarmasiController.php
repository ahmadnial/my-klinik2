<?php

namespace App\Http\Controllers;

use App\Models\do_detail_item;
use App\Models\kartuStockHdr;
use App\Models\mstr_dokter;
use App\Models\mstr_tindakan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


use function PHPUnit\Framework\isNull;

class LapFarmasiController extends Controller
{

    public function lapPenjualanFarmasiRekap()
    {
        $isUser = DB::table('users')->get();
        return view('pages.laporan.farmasi.laporan-penjualan-rekap', ['isUser' => $isUser]);
    }

    public function lapPenjualanFarmasiDetail()
    {
        $isUser = DB::table('users')->get();

        return view('pages.laporan.farmasi.laporan-penjualan-farmasi-detail', ['isUser' => $isUser]);
    }



    public function getLapPenjualanDetail(Request $request)
    {
        // $t = $request->all();
        // dd($t);
        if ($request->ajax()) {
            $isDataLaporan = DB::table('tp_detail_item')
                ->whereBetween('tgl_trs', [$request->date1, $request->date2])
                ->whereNull('kd_reg')
                // ->where('kd_order_resep', '=', 'null')
                ->get();
        }
        return response()->json($isDataLaporan);
    }

    public function getLapPenjualanRekap(Request $request)
    {
        // $t = $request->all();
        // dd($t);
        if ($request->user == '' && $request->tipeTarif == '') {
            $isDataLaporanDetail = DB::table('tp_detail_item')
                ->leftJoin('mstr_obat', 'tp_detail_item.kd_obat', 'mstr_obat.fm_kd_obat')
                ->select('kd_obat', 'nm_obat', 'hrg_obat', 'satuan', 'fm_hrg_beli_detail', DB::raw('sum(qty) as total'))
                ->whereBetween('tgl_trs', [$request->date1, $request->date2])
                ->whereNull('kd_reg')
                ->groupBy('kd_obat', 'nm_obat', 'hrg_obat', 'satuan')
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

    public function bukuStok()
    {
        return view('pages.laporan.farmasi.buku-stok');
    }

    public function getBukuStok(Request $request)
    {
        // $t = $request->all();
        // dd($t);
        if ($request->ajax()) {
            if ($request->kondisiStock == '') {
                $isDataBukuStok = DB::table('tb_stock')
                    ->leftJoin('mstr_obat', 'tb_stock.kd_obat', 'mstr_obat.fm_kd_obat')
                    ->where('mstr_obat.isActive', '=', '1')
                    ->select('mstr_obat.*', 'tb_stock.*')
                    ->get();
            } else if ($request->kondisiStock == 'ada') {
                $isDataBukuStok = DB::table('tb_stock')
                    ->leftJoin('mstr_obat', 'tb_stock.kd_obat', 'mstr_obat.fm_kd_obat')
                    ->where('mstr_obat.isActive', '=', '1')
                    ->where('tb_stock.qty', '!=', '0')
                    ->select('mstr_obat.*', 'tb_stock.*')
                    ->get();
            } else if ($request->kondisiStock == 'kosong') {
                $isDataBukuStok = DB::table('tb_stock')
                    ->leftJoin('mstr_obat', 'tb_stock.kd_obat', 'mstr_obat.fm_kd_obat')
                    ->where('mstr_obat.isActive', '=', '1')
                    ->where('tb_stock.qty', '=', '0')
                    ->select('mstr_obat.*', 'tb_stock.*')
                    ->get();
            }
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
        $session = $request->session;
        if ($request->ajax()) {
            if (!$session) {
                $isDataPendapatan = DB::table('rekening_pendapatan_poliklinik_total')
                    ->whereBetween('rk_tgl_regout', [$request->date1, $request->date2])
                    ->get();
            } else {
                $isDataPendapatan = DB::table('rekening_pendapatan_poliklinik_total')
                    ->where('rk_session_poli', '=', $session)
                    ->whereBetween('rk_tgl_regout', [$request->date1, $request->date2])
                    ->get();
            }
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
                ->latest('kartu_stock_detail.tanggal_trs')
                ->get();
            return response()->json($isKartuStock);
        }
    }

    public function pricelist()
    {
        return view('Pages.laporan.farmasi.pricelist');
    }

    public function pricelistHrgReguler()
    {
        if (request()->ajax()) {
            $isObatReguler = DB::table('mstr_obat')
                ->leftJoin('tb_stock', 'mstr_obat.fm_kd_obat', 'tb_stock.kd_obat')
                ->select('mstr_obat.*', 'tb_stock.*')
                ->get();
            return DataTables::of($isObatReguler)
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" id="' . $row->fm_kd_obat . '" onClick="SelectItemObat(this);SelectItemObatEdit(this)" data-kdmr="' . $row->fm_kd_obat . '"
                    data-fm_kd_obat="' . $row->fm_kd_obat . '" data-fm_nm_obat="' . $row->fm_nm_obat . '" data-fm_satuan_jual="' . $row->fm_satuan_jual . '" data-fm_satuan_pembelian="' . $row->fm_satuan_pembelian . '"
                    data-fm_hrg_jual="' . $row->fm_hrg_jual_non_resep . '" data-fm_hrg_beli_detail="' . $row->fm_hrg_beli_detail . '" data-fm_isi_satuan_pembelian="' . $row->fm_isi_satuan_pembelian . '"
                    class="edit btn btn-xs btn-sm" style="background-color:#10F3A4; color:#ffffff;">Select</a>';
                    return $actionBtn;
                })
                ->addColumn('HrgJualGlobal', function ($row) {
                    $HrgJualGlobald = '' . $row->fm_hrg_jual_non_resep * $row->fm_isi_satuan_pembelian . '';
                    return $HrgJualGlobald;
                })
                ->rawColumns(['action'])
                ->rawColumns(['HrgJualGlobal'])
                ->make(true);
            return response()->json($isObatReguler);
        }

        // $isObatReguler = DB::table('mstr_obat')
        // ->leftJoin('tb_stock', 'mstr_obat.fm_kd_obat', 'tb_stock.kd_obat')
        // ->select('mstr_obat.*', 'tb_stock.*')
        // ->paginate(15);
        // // ->get();
        // return response()->json($isObatReguler);
    }

    public function pricelistHrgResep()
    {
        if (request()->ajax()) {
            $isObatResep = DB::table('mstr_obat')
                ->leftJoin('tb_stock', 'mstr_obat.fm_kd_obat', 'tb_stock.kd_obat')
                ->select('fm_kd_obat', 'fm_nm_obat', 'fm_hrg_jual_resep', 'fm_satuan_jual', 'qty', 'fm_isi_satuan_pembelian', 'fm_satuan_pembelian')
                ->get();
            return DataTables::of($isObatResep)
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" id="' . $row->fm_kd_obat . '" onClick="SelectItemObat(this)" data-kdmr="' . $row->fm_kd_obat . '"
                    data-fm_kd_obat="' . $row->fm_kd_obat . '" data-fm_nm_obat="' . $row->fm_nm_obat . '" data-fm_satuan_jual="' . $row->fm_satuan_jual . '"
                    data-fm_hrg_jual="' . $row->fm_hrg_jual_resep . '" data-fm_satuan_pembelian="' . $row->fm_satuan_pembelian . '"
                    class="edit btn btn-xs btn-sm" style="background-color:#10F3A4; color:#ffffff;">Select</a>';
                    return $actionBtn;
                })
                ->addColumn('HrgJualGlobalResep', function ($row) {
                    $HrgJualGlobalR = '' . $row->fm_hrg_jual_resep * $row->fm_isi_satuan_pembelian . '';
                    return $HrgJualGlobalR;
                })
                ->rawColumns(['action'])
                ->rawColumns(['HrgJualGlobalResep'])
                ->make(true);
            return response()->json($isObatResep);
        }
    }

    public function pricelistHrgNakes()
    {
        // $isObatNakes = mstr_obat::select("fm_kd_obat", "fm_nm_obat", "fm_satuan_jual", "fm_hrg_beli", "fm_hrg_jual_nakes")->get();
        if (request()->ajax()) {
            $isObatNakes = DB::table('mstr_obat')
                ->leftJoin('tb_stock', 'mstr_obat.fm_kd_obat', 'tb_stock.kd_obat')
                ->select('fm_kd_obat', 'fm_nm_obat', 'fm_hrg_jual_nakes', 'fm_satuan_jual', 'qty', 'fm_isi_satuan_pembelian', 'fm_satuan_pembelian')
                ->get();
            return DataTables::of($isObatNakes)
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" id="' . $row->fm_kd_obat . '" onClick="SelectItemObat(this)" data-kdmr="' . $row->fm_kd_obat . '"
                    data-fm_kd_obat="' . $row->fm_kd_obat . '" data-fm_nm_obat="' . $row->fm_nm_obat . '" data-fm_satuan_jual="' . $row->fm_satuan_jual . '"
                    data-fm_hrg_jual="' . $row->fm_hrg_jual_nakes . '" data-fm_satuan_pembelian="' . $row->fm_satuan_pembelian . '"
                    class="edit btn btn-xs btn-sm" style="background-color:#10F3A4; color:#ffffff;">Select</a>';
                    return $actionBtn;
                })
                ->addColumn('HrgJualGlobalNakes', function ($row) {
                    $HrgJualGlobalN = '' . $row->fm_hrg_jual_nakes * $row->fm_isi_satuan_pembelian . '';
                    return $HrgJualGlobalN;
                })
                ->rawColumns(['action'])
                ->rawColumns(['HrgJualGlobalNakes'])
                ->make(true);
            return response()->json($isObatNakes);
        }
    }
}
