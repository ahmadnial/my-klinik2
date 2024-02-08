<?php

namespace App\Http\Controllers;

use App\Models\do_detail_item;
use App\Models\kartuStockDetail;
use App\Models\mstr_obat;
use App\Models\penjualanFarmasi;
use App\Models\tb_stock;
use App\Models\tp_hdr;
use App\Models\tp_detail_item;
use App\Models\trs_chart_resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Yoeunes\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\Facades\DataTables;
use App\Models\t_label_timeline;

class penjualanController extends Controller
{
    public function penjualan()
    {
        $num = str_pad(000001, 6, 0, STR_PAD_LEFT);
        $Y = date("Y");
        $M = date("m");
        $cekid = tp_hdr::count();
        if ($cekid == 0) {
            $noRef =  'TP'  . '-' . substr($Y, -2) . $M . '-' . $num;
        } else {
            $continue = tp_hdr::all()->last();
            $de = substr($continue->kd_trs, -6);
            $noRef = 'TP' . '-' . substr($Y, -2) . $M  . '-' . str_pad(($de + 1), 6, '0', STR_PAD_LEFT);
        };

        $isListRegResep = trs_chart_resep::select("kd_trs", "chart_id", "kd_reg", "mr_pasien", "nm_pasien")->distinct()->where('isimplementasi', '=', '0')->get();
        $dateNow = Carbon::now()->format("Y-m-d");
        $monthNow = Carbon::now()->format("m");
        $yearNow = Carbon::now()->format("Y");
        // $isListPenjualan = tp_hdr::whereyear('tgl_trs', '=', $yearNow)->whereMonth('tgl_trs', '=', $monthNow)->orderBy('created_at', 'desc')->get();
        return view('Pages.penjualan', [
            'noRef' => $noRef,
            // 'isListPenjualan' => $isListPenjualan,
            'isListRegResep' => $isListRegResep,
            'dateNow' => $dateNow,
        ]);
    }

    public function getMonthSales(Request $request)
    {
        // $today = Carbon::today()->toDateString();
        $selectMonth = $request->dataBulan;
        // dd($selectMonth);
        if (!$selectMonth) {
            $monthNow = Carbon::now()->format("m");
            $yearNow = Carbon::now()->format("Y");
            $isListPenjualan = tp_hdr::whereyear('tgl_trs', '=', $yearNow)->whereMonth('tgl_trs', '=', $monthNow)->latest('tgl_trs')->get();
        } else {
            $isListPenjualan = tp_hdr::where('tgl_trs', 'LIKE', '%' . $selectMonth . '%')->latest('created_at')->get();
        }

        return DataTables::of($isListPenjualan)
            ->addColumn('action', function ($row) {
                $today = Carbon::today()->toDateString();
                if ($row->tgl_trs == $today) {
                    $actionBtn = '
                <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#EditObat"
                onclick="getDetailPen(this)" data-kd_trs="' . $row->kd_trs . '">&nbsp;&nbsp;<i class="fa fa-info">&nbsp;&nbsp;</i></button>
                <button class="btn btn-xs btn-primary" data-toggle="modal" data-target=""
                onclick="EditTrs(this);validasiTrs(this);" data-kd_trsu="' . $row->kd_trs . '"><i class="fa fa-edit"></i></button>
                <button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#EditObat"
                onclick="cetakNota(this)" data-kd_trsc="' . $row->kd_trs . '" target="_blank"> <i class="fa fa-print"></i> </button>
                 <button class="btn btn-xs btn-danger" data-toggle="modal" data-target=""
                onclick="DeleteTrs(this);" data-kd_trsu="' . $row->kd_trs . '"><i class="fa fa-trash"></i></button>
                ';
                } else {
                    $actionBtn = '
                <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#EditObat"
                onclick="getDetailPen(this)" data-kd_trs="' . $row->kd_trs . '">&nbsp;&nbsp;<i class="fa fa-info">&nbsp;&nbsp;</i></button>
                <button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#EditObat"
                onclick="cetakNota(this)" data-kd_trsc="' . $row->kd_trs . '" target="_blank"> <i class="fa fa-print"></i> </button>
                ';
                }

                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getListObatReguler()
    {
        if (request()->ajax()) {
            $isObatReguler = DB::table('mstr_obat')
                ->leftJoin('tb_stock', 'mstr_obat.fm_kd_obat', 'tb_stock.kd_obat')
                ->select('mstr_obat.*', 'tb_stock.*')
                ->get();
            return DataTables::of($isObatReguler)
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" id="' . $row->fm_kd_obat . '" onClick="SelectItemObat(this)" data-kdmr="' . $row->fm_kd_obat . '"
                    data-fm_kd_obat="' . $row->fm_kd_obat . '" data-fm_nm_obat="' . $row->fm_nm_obat . '" data-fm_satuan_jual="' . $row->fm_satuan_jual . '"
                    data-fm_hrg_jual="' . $row->fm_hrg_jual_non_resep . '" data-qty="' . $row->qty . '" data-fm_hrg_beli_detail="' . $row->fm_hrg_beli_detail . '" data-fm_isi_satuan_pembelian="' . $row->fm_isi_satuan_pembelian . '"
                    class="edit btn btn-xs btn-sm" style="background-color:#10F3A4; color:#ffffff;">Select</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
            return response()->json($isObatReguler);
        }
    }

    public function getListObatResep()
    {
        if (request()->ajax()) {
            $isObatResep = DB::table('mstr_obat')
                ->leftJoin('tb_stock', 'mstr_obat.fm_kd_obat', 'tb_stock.kd_obat')
                ->select('fm_kd_obat', 'fm_nm_obat', 'fm_hrg_jual_resep', 'fm_hrg_beli_detail', 'fm_satuan_jual', 'qty')
                ->get();
            return DataTables::of($isObatResep)
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" id="' . $row->fm_kd_obat . '" onClick="SelectItemObat(this)" data-kdmr="' . $row->fm_kd_obat . '"
                    data-fm_kd_obat="' . $row->fm_kd_obat . '" data-fm_nm_obat="' . $row->fm_nm_obat . '" data-fm_satuan_jual="' . $row->fm_satuan_jual . '"
                    data-fm_hrg_jual="' . $row->fm_hrg_jual_resep . '" data-fm_hrg_beli_detail="' . $row->fm_hrg_beli_detail . '"
                    class="edit btn btn-xs btn-sm" style="background-color:#10F3A4; color:#ffffff;">Select</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
            return response()->json($isObatResep);
        }
    }

    public function getListObatNakes()
    {
        // $isObatNakes = mstr_obat::select("fm_kd_obat", "fm_nm_obat", "fm_satuan_jual", "fm_hrg_beli", "fm_hrg_jual_nakes")->get();
        if (request()->ajax()) {
            $isObatNakes = DB::table('mstr_obat')
                ->leftJoin('tb_stock', 'mstr_obat.fm_kd_obat', 'tb_stock.kd_obat')
                ->select('fm_kd_obat', 'fm_nm_obat', 'fm_hrg_jual_nakes', 'fm_hrg_beli_detail', 'fm_satuan_jual', 'qty')
                ->get();
            return DataTables::of($isObatNakes)
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" id="' . $row->fm_kd_obat . '" onClick="SelectItemObat(this)" data-kdmr="' . $row->fm_kd_obat . '"
                    data-fm_kd_obat="' . $row->fm_kd_obat . '" data-fm_nm_obat="' . $row->fm_nm_obat . '" data-fm_satuan_jual="' . $row->fm_satuan_jual . '"
                    data-fm_hrg_jual="' . $row->fm_hrg_jual_nakes . '" data-fm_hrg_beli_detail="' . $row->fm_hrg_beli_detail . '"
                    class="edit btn btn-xs btn-sm" style="background-color:#10F3A4; color:#ffffff;">Select</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
            return response()->json($isObatNakes);
        }
    }


    public function getListObatRegulerEdit()
    {
        if (request()->ajax()) {
            $isObatReguler = DB::table('mstr_obat')
                ->leftJoin('tb_stock', 'mstr_obat.fm_kd_obat', 'tb_stock.kd_obat')
                ->select('mstr_obat.*', 'tb_stock.*')
                ->get();
            return DataTables::of($isObatReguler)
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" id="' . $row->fm_kd_obat . '" onClick="SelectItemObatEdit(this)" data-kdmr="' . $row->fm_kd_obat . '"
                    data-fm_kd_obat="' . $row->fm_kd_obat . '" data-fm_nm_obat="' . $row->fm_nm_obat . '" data-fm_satuan_jual="' . $row->fm_satuan_jual . '"
                    data-fm_hrg_jual="' . $row->fm_hrg_jual_non_resep . '" data-qty="' . $row->qty . '" data-fm_hrg_beli_detail="' . $row->fm_hrg_beli_detail . '" data-fm_isi_satuan_pembelian="' . $row->fm_isi_satuan_pembelian . '"
                    class="edit btn btn-xs btn-sm" style="background-color:#10F3A4; color:#ffffff;">Select</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
            return response()->json($isObatReguler);
        }
    }

    public function getListObatResepEdit()
    {
        if (request()->ajax()) {
            $isObatResep = DB::table('mstr_obat')
                ->leftJoin('tb_stock', 'mstr_obat.fm_kd_obat', 'tb_stock.kd_obat')
                ->select('fm_kd_obat', 'fm_nm_obat', 'fm_hrg_jual_resep', 'fm_satuan_jual', 'qty')
                ->get();
            return DataTables::of($isObatResep)
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" id="' . $row->fm_kd_obat . '" onClick="SelectItemObatEdit(this)" data-kdmr="' . $row->fm_kd_obat . '"
                    data-fm_kd_obat="' . $row->fm_kd_obat . '" data-fm_nm_obat="' . $row->fm_nm_obat . '" data-fm_satuan_jual="' . $row->fm_satuan_jual . '"
                    data-fm_hrg_jual="' . $row->fm_hrg_jual_resep . '"
                    class="edit btn btn-xs btn-sm" style="background-color:#10F3A4; color:#ffffff;">Select</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
            return response()->json($isObatResep);
        }
    }

    public function getListObatNakesEdit()
    {
        // $isObatNakes = mstr_obat::select("fm_kd_obat", "fm_nm_obat", "fm_satuan_jual", "fm_hrg_beli", "fm_hrg_jual_nakes")->get();
        if (request()->ajax()) {
            $isObatNakes = DB::table('mstr_obat')
                ->leftJoin('tb_stock', 'mstr_obat.fm_kd_obat', 'tb_stock.kd_obat')
                ->select('fm_kd_obat', 'fm_nm_obat', 'fm_hrg_jual_nakes', 'fm_satuan_jual', 'qty')
                ->get();
            return DataTables::of($isObatNakes)
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" id="' . $row->fm_kd_obat . '" onClick="SelectItemObatEdit(this)" data-kdmr="' . $row->fm_kd_obat . '"
                    data-fm_kd_obat="' . $row->fm_kd_obat . '" data-fm_nm_obat="' . $row->fm_nm_obat . '" data-fm_satuan_jual="' . $row->fm_satuan_jual . '"
                    data-fm_hrg_jual="' . $row->fm_hrg_jual_nakes . '"
                    class="edit btn btn-xs btn-sm" style="background-color:#10F3A4; color:#ffffff;">Select</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
            return response()->json($isObatNakes);
        }
    }

    public function getListOrderResep(Request $kd_trs)
    {
        $isListOrderResep = DB::table('trs_chart_resep')
            ->leftJoin('tc_mr', 'trs_chart_resep.mr_pasien', 'tc_mr.fs_mr')
            ->leftJoin('trs_chart', 'trs_chart_resep.kd_trs', 'trs_chart.kd_trs')
            ->select('trs_chart_resep.*', 'tc_mr.*', 'trs_chart.nm_dokter_jm')
            ->distinct()
            ->where('trs_chart_resep.kd_trs', $kd_trs->kd_trs)
            // ->where('isimplementasi', '=', '0')
            ->get();
        return response()->json($isListOrderResep);
    }

    public function penjualanCreate(Request $request)
    {
        // $k = $request->all();
        // dd($k);

        $request->validate([
            // 'kd_trs' => 'required',
            'tgl_trs' => 'required',
            'kd_obat' => 'required',
            'nm_obat' => 'required',
            // 'dosis',
            'hrg_obat' => 'required',
            'qty' => 'required',
            // 'tipe_tarif' => 'required',
            // // 'diskon',
            // // 'satuan',
            // // 'tax',
            // // 'tulsah',
            // // 'embalase',
            // 'sub_total' => 'required',
            // 'etiket',
            // 'signa',
            // 'cara_pakai',
            // 'user',
        ]);
        // foreach ($request->kd_obat as $keys => $val) {
        //     $datax =  $request->kd_obat[$keys];
        //     $dataQty =  $request->qty[$keys];
        //     // $dataIsi =  $request->do_isi_pembelian[$keys];
        //     // $X = (int)$dataQty * (int)$dataIsi;
        //     $toInt = (int)$dataQty;

        //     $cekStock = tb_stock::where('kd_obat', [$datax])->get();
        // }

        // foreach ($cekStock as $qty => $x) {
        //     $ObatCurrent = ['kd_obat'][$qty];
        //     $QtyCurrent = $cekStock[$qty];
        //     // $QtyCurrentInt = (int)$QtyCurrent;
        // }

        // if ($QtyCurrent == '0') {
        //     print_r($QtyCurrent);
        // }
        DB::beginTransaction();
        try {
            $newData = [
                'kd_trs'        => $request->tp_kd_trs,
                'kd_order_resep' => $request->tp_kd_order,
                'layanan_order' => $request->tp_layanan,
                'dokter'        => $request->tp_dokter,
                // 'sip_dokter' => $request->,
                'tgl_trs' => $request->tgl_trs,
                'lokasi_stock'  => $request->tp_lokasi_stock,
                'kd_reg'        => $request->tp_kd_reg,
                'no_mr'         => $request->tp_no_mr,
                'nm_pasien'  => $request->tp_nama,
                'alamat'        => $request->tp_alamat,
                'jenis_kelamin' => $request->tp_jenis_kelamin,
                'tgl_lahir'     => $request->tp_tgl_lahir,
                'tipe_tarif'    => $request->tp_tipe_tarif,
                'total_penjualan' => $request->total_penjualan,
            ];
            tp_hdr::create($newData);

            foreach ($request->kd_obat as $key => $xf) {
                $tpdetail = [
                    'kd_trs'    => $request->tp_kd_trs,
                    'kd_reg'    => $request->tp_kd_reg,
                    'kd_obat'   => $request->kd_obat[$key],
                    'nm_obat'   => $request->nm_obat[$key],
                    // 'dosis'     => $request->kd_obat[$key],
                    'hrg_obat'  => $request->hrg_obat[$key],
                    'qty'       => $request->qty[$key],
                    'diskon'    => $request->diskon[$key],
                    'satuan'    => $request->satuan[$key],
                    // 'tax'       => $request->tax[$key],
                    'sub_total' => $request->sub_total[$key],
                    // // 'etiket',
                    // 'signa' => $request->signa[$key],
                    'cara_pakai' => $request->cara_pakai[$key],
                    'tgl_trs' => $request->tgl_trs,
                    'user' => Auth::user()->name,
                    'tuslah' => $request->tuslah[$key],
                    'embalase' => $request->embalase[$key],
                ];
                tp_detail_item::create($tpdetail);
            }

            foreach ($request->kd_obat as $keyx => $val) {
                $currentStock = DB::table('tb_stock')->whereIn('kd_obat', [$request->kd_obat[$keyx]])->value('qty');
                // $currentStockF = preg_replace("/[^0-9]/", "", $currentStock);
                $Y = (int)$request->qty[$keyx];
                $qtyAkhir = $currentStock - $Y;
                $detailKartuStock = [
                    'tanggal_trs' => $request->tgl_trs,
                    'kd_trs' => $request->tp_kd_trs,
                    'kd_obat' => $request->kd_obat[$keyx],
                    'nm_obat' => $request->nm_obat[$keyx],
                    'supplier' => 'Penjualan Apotek',
                    'no_batch' => '-',
                    'expired_date' => '-',
                    'qty_awal' => $currentStock,
                    'qty_masuk' => '0',
                    'qty_keluar' => $request->qty[$keyx],
                    'qty_akhir'  => $qtyAkhir,
                    'hpp_satuan' => $request->hrgHPP[$keyx],
                ];
                // print_r($currentStock);
                kartuStockDetail::create($detailKartuStock);
            }
            // die();

            foreach ($request->kd_obat as $keys => $val) {
                $datax =  $request->kd_obat[$keys];
                $dataQty =  $request->qty[$keys];
                // $dataIsi =  $request->do_isi_pembelian[$keys];
                // $X = (int)$dataQty * (int)$dataIsi;
                $toInt = (int)$dataQty;

                tb_stock::where('kd_obat', [$datax])->decrement("qty", $toInt);
            }

            // trs_chart_resep::where('kd_trs', $request->tp_kd_trs)->update(['isImplementasi' => "1"]);
            DB::table('trs_chart_resep')
                ->where('kd_reg', $request->tp_kd_reg)
                ->update(['isImplementasi' => "1"]);


            if ($request->tp_no_mr != '') {
                $newDataLabel = [
                    'reffID' => $request->tp_kd_trs,
                    'Tgl' => Carbon::now(),
                    'labelType' => 'medication (Obat Pulang)',
                    'pasienID' => $request->tp_no_mr,
                    'layananID' => $request->tp_layanan,
                    'kdReg' => $request->tp_kd_reg,
                    'pasienName' => $request->tp_nama,
                    'userID' => Auth::user()->name,
                    'ketFile' => '',
                ];
                $ketHTML = [];
                foreach ($request->kd_obat as $label => $val) {
                    $ketHTML[] = htmlentities('<tr><td>' . $request->nm_obat[$label] . '</td><td>' . $request->qty[$label] . '</td><td>' . $request->satuan[$label] . '</td><td>' . $request->cara_pakai[$label] . '</td></tr>');
                };
                $newDataLabel['ketHTML'] = json_encode($ketHTML, JSON_UNESCAPED_SLASHES);
                // $x = str_replace('","', '', $newDataLabel);
                // dd($x);
                t_label_timeline::create($newDataLabel);
            }

            DB::commit();

            $sessionFlash = [
                'message' => 'Saved!',
                'alert-type' => 'success'
            ];

            return Redirect::to('/penjualan')->with($sessionFlash);
        } catch (\Exception $e) {
            DB::rollback();

            $sessionFlashErr = [
                'message' => 'Error!',
                'alert-type' => 'error'
            ];
            return Redirect::to('/penjualan')->with($sessionFlashErr);
        }
    }


    public function updateTrsPenjualan(Request $request)
    {
        // $k = $request->all();
        // dd($k);

        // $request->validate([
        //     'kd_trse' => 'required',
        //     'tgl_trse' => 'required',
        //     'kd_obate' => 'required',
        //     'nm_obate' => 'required',
        //     'hrg_obate' => 'required',
        //     'qty' => 'required',
        // ]);


        // $newData = [
        //     'kd_trs'        => $request->tp_kd_trs,
        //     'kd_order_resep' => $request->tp_kd_order,
        //     'layanan_order' => $request->tp_layanan,
        //     'dokter'        => $request->tp_dokter,
        //     // 'sip_dokter' => $request->,
        //     'tgl_trs' => $request->tgl_trs,
        //     'lokasi_stock'  => $request->tp_lokasi_stock,
        //     'kd_reg'        => $request->tp_kd_reg,
        //     'no_mr'         => $request->tp_no_mr,
        //     'nm_pasien'  => $request->tp_nama,
        //     'alamat'        => $request->tp_alamat,
        //     'jenis_kelamin' => $request->tp_jenis_kelamin,
        //     'tgl_lahir'     => $request->tp_tgl_lahir,
        //     'tipe_tarif'    => $request->tp_tipe_tarif,
        //     'total_penjualan' => $request->total_penjualan,
        // ];
        // tp_hdr::create($newData);

        // $updateStockF = preg_replace("/[^0-9]/", "", $updateStock);
        // print_r($updateStockF);
        // die();
        // $today = Carbon::today()->toDateString();
        // $dateTime = Carbon::now();

        // foreach ($request->kd_obat as $keyy => $val) {
        //     $delTrsKS = DB::table('kartu_stock_detail')
        //         ->where([
        //             ['created_at', '>=', $dateTime],
        //             ['tanggal_trs', '=', $today]
        //         ])
        //         ->whereIn('kd_obat', [$request->kd_obat[$keyy]])
        //         ->get();
        //     print_r($delTrsKS);
        // }
        // print($dateTime . $today);
        // die();
        // if ($delTrsKS ==  0) {
        //     print('oi');
        // }
        // if ($request->tgl_trse == $today) {
        //     print('match');
        // } else {
        //     // print('tidak match');
        // }
        // die();
        // $toInt = (int)$delTrsKS;
        // dd($delTrsKS);
        // if ($delTrsKS > 0) {
        //     $sessionFlashErr = [
        //         'message' => 'Gagal! Sudah Ada Item Moving!',
        //         'alert-type' => 'error'
        //     ];
        //     return Redirect::to('/penjualan')->with($sessionFlashErr);
        //     // return response()->with($sessionFlashErr);
        // } else {
        DB::beginTransaction();
        // try {
        foreach ($request->kd_obat as $keys => $val) {
            $updateStock = DB::table('tp_detail_item')->whereIn('kd_obat', [$request->kd_obat[$keys]])->where('kd_trs', $request->tp_kd_trse)->value('qty');
            $currenttStock = DB::table('tb_stock')->whereIn('kd_obat', [$request->kd_obat[$keys]])->value('qty');
            // $calculate = $updateStockF + $currenttStock;
            $datax =  $request->kd_obat[$keys];
            $dataQty =  $updateStock;
            $toInt = (int)$dataQty;
            // print_r($updateStock);
            tb_stock::where('kd_obat', [$datax])->increment("qty", $toInt);
        }
        // die();
        // DB::table('tp_hdr')->where('kd_trs', $request->tp_kd_trse)->delete();
        DB::table('tp_detail_item')->where('kd_trs', $request->tp_kd_trse)->delete();
        // DB::table('kartu_stock_detail')->where('kd_trs', $request->tp_kd_trse)->delete();

        // $newData = [
        //     'kd_trs'        => $request->tp_kd_trse,
        //     'kd_order_resep' => $request->tp_kd_ordere,
        //     'layanan_order' => $request->tp_layanane,
        //     'dokter'        => $request->tp_doktere,
        //     // 'sip_dokter' => $request->,
        //     'tgl_trs' => $request->tgl_trse,
        //     'lokasi_stock'  => $request->tp_lokasi_stock,
        //     'kd_reg'        => $request->tp_kd_rege,
        //     'no_mr'         => $request->tp_no_mre,
        //     'nm_pasien'  => $request->tp_namae,
        //     'alamat'        => $request->tp_alamate,
        //     'jenis_kelamin' => $request->tp_jenis_kelamine,
        //     'tgl_lahir'     => $request->tp_tgl_lahire,
        //     'tipe_tarif'    => $request->tp_tipe_tarife,
        //     'total_penjualan' => $request->total_penjualanE,
        // ];
        // tp_hdr::create($newData);
        // DB::table('tp_hdr')->where('kd_trs', $request->tp_kd_trse)->update([
        //     // 'kd_trs'        => $request->tp_kd_trse,
        //     // 'kd_order_resep' => $request->tp_kd_ordere,
        //     // 'layanan_order' => $request->tp_layanane,
        //     // 'dokter'        => $request->tp_doktere,
        //     // 'sip_dokter' => $request->,
        //     // 'tgl_trs' => $request->tgl_trse,
        //     // 'lokasi_stock'  => $request->tp_lokasi_stock,
        //     // 'kd_reg'        => $request->tp_kd_rege,
        //     // 'no_mr'         => $request->tp_no_mre,
        //     // 'nm_pasien'  => $request->tp_namae,
        //     // 'alamat'        => $request->tp_alamate,
        //     // 'jenis_kelamin' => $request->tp_jenis_kelamine,
        //     // 'tgl_lahir'     => $request->tp_tgl_lahire,
        //     // 'tipe_tarif'    => $request->tp_tipe_tarife,
        //     'total_penjualan' => $request->total_penjualanE,
        // ]);
        tp_hdr::updateOrInsert(
            ['kd_trs' => $request->tp_kd_trse],
            [
                'total_penjualan' => $request->total_penjualanE,
            ]
        );

        // foreach ($request->kd_obat as $key => $xf) {
        //     $tpdetail = [
        //         'kd_trs'    => $request->tp_kd_trse,
        //         'kd_reg'    => $request->tp_kd_rege,
        //         'kd_obat'   => $request->kd_obat[$key],
        //         'nm_obat'   => $request->nm_obat[$key],
        //         // 'dosis'     => $request->kd_obat[$key],
        //         'hrg_obat'  => $request->hrg_obat[$key],
        //         'qty'       => $request->qty[$key],
        //         'diskon'    => $request->diskon[$key],
        //         'satuan'    => $request->satuan[$key],
        //         // 'tax'       => $request->tax[$key],
        //         'sub_total' => $request->sub_total[$key],
        //         // // 'etiket',
        //         // 'signa' => $request->signa[$key],
        //         'cara_pakai' => $request->cara_pakai[$key],
        //         'tgl_trs' => $request->tgl_trse,
        //         'user' => Auth::user()->name,
        //         'tuslah' => $request->tuslah[$key],
        //         'embalase' => $request->embalase[$key],
        //     ];
        //     tp_detail_item::create($tpdetail);
        // }
        foreach ($request->kd_obat as $key => $xf) {
            tp_detail_item::insert(
                // [
                //     'kd_trs' => $request->tp_kd_trse,
                //     'kd_obat'   => $request->kd_obat[$key]
                // ],
                [
                    'kd_trs'    => $request->tp_kd_trse,
                    'kd_reg'    => $request->tp_kd_rege,
                    'kd_obat'   => $request->kd_obat[$key],
                    'nm_obat'   => $request->nm_obat[$key],
                    'hrg_obat'  => $request->hrg_obat[$key],
                    'qty'       => $request->qty[$key],
                    'diskon'    => $request->diskon[$key],
                    'satuan'    => $request->satuan[$key],
                    'sub_total' => $request->sub_total[$key],
                    'cara_pakai' => $request->cara_pakai[$key],
                    'tgl_trs' => $request->tgl_trse,
                    'user' => Auth::user()->name,
                    'tuslah' => $request->tuslah[$key],
                    'embalase' => $request->embalase[$key],
                ]
            );
            // DB::table('tp_detail_item')->where('kd_trs', $request->tp_kd_trse)->update([
            //     'kd_obat'   => $request->kd_obat[$key],
            //     'nm_obat'   => $request->nm_obat[$key],
            //     'hrg_obat'  => $request->hrg_obat[$key],
            //     'qty'       => $request->qty[$key],
            //     'diskon'    => $request->diskon[$key],
            //     'satuan'    => $request->satuan[$key],
            //     'sub_total' => $request->sub_total[$key],
            //     'signa' => $request->signa[$key],
            //     'cara_pakai' => $request->cara_pakai[$key],
            //     'tgl_trs' => $request->tgl_trse,
            //     'user' => Auth::user()->name,
            //     'tuslah' => $request->tuslah[$key],
            //     'embalase' => $request->embalase[$key],
            // ]);
        }

        // foreach ($request->kd_obat as $keyx => $val) {
        //     $currentStock = DB::table('tb_stock')->whereIn('kd_obat', [$request->kd_obat[$keyx]])->value('qty');
        //     // $currentStockF = preg_replace("/[^0-9]/", "", $currentStock);
        //     $Y = (int)$request->qty[$keyx];
        //     $qtyAkhir = $currentStock - $Y;
        //     $detailKartuStock = [
        //         'tanggal_trs' => $request->tgl_trse,
        //         'kd_trs' => $request->tp_kd_trse,
        //         'kd_obat' => $request->kd_obat[$keyx],
        //         'nm_obat' => $request->nm_obat[$keyx],
        //         'supplier' => 'Penjualan Apotek',
        //         'no_batch' => '-',
        //         'expired_date' => '-',
        //         'qty_awal' => $currentStock,
        //         'qty_masuk' => '0',
        //         'qty_keluar' => $request->qty[$keyx],
        //         'qty_akhir'  => $qtyAkhir,
        //         'hpp_satuan' => $request->hrg_obat[$keyx],
        //     ];
        //     // print_r($currentStock);
        //     kartuStockDetail::create($detailKartuStock);
        // }

        // foreach ($request->kd_obat as $keyx => $val) {
        //     $currentStock = DB::table('tb_stock')->whereIn('kd_obat', [$request->kd_obat[$keyx]])->value('qty');

        //     DB::table('tp_hdr')->where('kd_trs', $request->tp_kd_trse)->update([
        //         'kd_obat' => $request->kd_obat[$keyx],
        //         'nm_obat' => $request->nm_obat[$keyx],
        //         'qty_awal' => $currentStock,
        //         'qty_masuk' => '0',
        //         'qty_keluar' => $request->qty[$keyx],
        //         'qty_akhir'  => $qtyAkhir,
        //         'hpp_satuan' => $request->hrg_obat[$keyx],
        //     ]);
        // }

        foreach ($request->kd_obat as $keys => $val) {
            $datax =  $request->kd_obat[$keys];
            $dataQty =  $request->qty[$keys];
            // $dataIsi =  $request->do_isi_pembelian[$keys];
            // $X = (int)$dataQty * (int)$dataIsi;
            $toInt = (int)$dataQty;

            tb_stock::where('kd_obat', [$datax])->decrement("qty", $toInt);
        }

        // // trs_chart_resep::where('kd_trs', $request->tp_kd_trs)->update(['isImplementasi' => "1"]);
        // DB::table('trs_chart_resep')
        //     ->where('kd_reg', $request->tp_kd_rege)
        //     ->update(['isImplementasi' => "1"]);

        DB::commit();

        $sessionFlash = [
            'message' => 'Transaksi Berhasil Diperbaharui!',
            'alert-type' => 'success'
        ];

        return Redirect::to('/penjualan')->with($sessionFlash);
        // } catch (\Exception $e) {
        DB::rollback();

        $sessionFlashErr = [
            'message' => 'Some Error Occured!',
            'alert-type' => 'error'
        ];
        return Redirect::to('/penjualan')->with($sessionFlashErr);
        // }
        // }
    }

    public function DelTrsPenjualan(Request $request)
    {

        DB::beginTransaction();
        // try {
        // foreach ($request->kd_obat as $keys => $val) {
        //     $updateStock = DB::table('tp_detail_item')->whereIn('kd_obat', [$request->kd_obat[$keys]])->where('kd_trs', $request->nomorTrs)->value('qty');
        //     $currenttStock = DB::table('tb_stock')->whereIn('kd_obat', [$request->kd_obat[$keys]])->value('qty');
        //     // $calculate = $updateStockF + $currenttStock;
        //     $datax =  $request->kd_obat[$keys];
        //     $dataQty =  $updateStock;
        //     $toInt = (int)$dataQty;
        //     // print_r($updateStock);
        //     tb_stock::where('kd_obat', [$datax])->increment("qty", $toInt);
        // }
        DB::table('tp_hdr')->where('kd_trs', $request->nomorTrs)->delete();
        DB::table('tp_detail_item')->where('kd_trs', $request->nomorTrs)->delete();
        // DB::table('kartu_stock_detail')->where('kd_trs', $request->nomorTrs)->delete();

        DB::table('kartu_stock_detail')->where('kd_trs', $request->tp_kd_trse)->update([
            'supplier' => 'Transaksi Void Oleh' . Auth::user()->name,
        ]);

        foreach ($request->kd_obat as $keys => $val) {
            $datax =  $request->kd_obat[$keys];
            $dataQty =  $request->qty[$keys];
            // $dataIsi =  $request->do_isi_pembelian[$keys];
            // $X = (int)$dataQty * (int)$dataIsi;
            $toInt = (int)$dataQty;

            tb_stock::where('kd_obat', [$datax])->increment("qty", $toInt);
        }

        DB::commit();

        $sessionFlash = [
            'message' => 'Transaksi Berhasil Dihapus!',
            'alert-type' => 'success'
        ];

        return Redirect::to('/penjualan')->with($sessionFlash);
        // } catch (\Exception $e) {
        DB::rollback();

        $sessionFlashErr = [
            'message' => 'Some Error Occured!',
            'alert-type' => 'error'
        ];
        return Redirect::to('/penjualan')->with($sessionFlashErr);
    }


    public function getDetailPenjualan(Request $request)
    {
        $isViewDetailPenjualan = tp_hdr::where('tp_hdr.kd_trs', '=', $request->kd_trs)
            ->leftJoin('tp_detail_item', 'tp_hdr.kd_trs', 'tp_detail_item.kd_trs')
            ->get();

        return response()->json($isViewDetailPenjualan);
    }

    public function cetakNota(Request $request)
    {
        $isListPenjualan = tp_hdr::where('tp_hdr.kd_trs', '=', $request->kd_trs)
            ->leftJoin('tp_detail_item', 'tp_hdr.kd_trs', 'tp_detail_item.kd_trs')
            // ->leftJoin('tb_stock', 'mstr_obat.fm_kd_obat', 'tb_stock.kd_obat')
            ->get();

        $isListPenjualanHdr = tp_hdr::where('tp_hdr.kd_trs', '=', $request->kd_trs)
            ->get();

        // return Pdf::loadView('pages.nota', ['isListPenjualan' => $isListPenjualan, 'isListPenjualanHdr' => $isListPenjualanHdr])->stream();
        // return $pdf->stream();
        // return Pdf::loadFile(public_path() . '/myfile.html')->save('/path-to/my_stored_file.pdf')->stream('download.pdf');
        return view('Pages.nota', ['isListPenjualan' => $isListPenjualan, 'isListPenjualanHdr' => $isListPenjualanHdr]);
        // return redirect()->to('/nota');
    }
}
