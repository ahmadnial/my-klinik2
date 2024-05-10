<?php

namespace App\Http\Controllers;

use App\Models\do_detail_item;
use App\Models\do_hdr;
use App\Models\HutangSupplier;
use App\Models\kartuStockDetail;
use App\Models\mstr_lokasi_stock;
use App\Models\mstr_obat;
use App\Models\mstr_supplier;
use App\Models\tb_adjusment_detail;
use App\Models\tb_adjusment_hdr;
use App\Models\tb_stock;
use App\Models\tp_detail_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;

class poDoController extends Controller
{

    public function po()
    {
        // $num = str_pad(00001, 5, 0, STR_PAD_LEFT);
        // $cekid = mstr_supplier::count();
        // if ($cekid == 0) {
        //     $kd_po =  'PO'  . $num;
        // } else {
        //     $continue = mstr_supplier::all()->last();
        //     $de = substr($continue->fm_kd_supplier, -5);
        //     // dd($de);
        //     $kd_po = 'PO' . str_pad(($de + 1), 5, '0', STR_PAD_LEFT);
        //     // dd($kd_reg);
        // };

        $supplier = mstr_supplier::all();
        $lokasi = mstr_lokasi_stock::all();
        return view('pages.purchase-order', ['supplier' => $supplier, 'lokasi' => $lokasi]);
    }

    public function do()
    {
        // kd DO
        $num = str_pad(000001, 6, 0, STR_PAD_LEFT);
        $Y = date("Y");
        $M = date("m");
        $cekid = do_hdr::count();
        if ($cekid == 0) {
            $noRef =  'DO'  . '-' . substr($Y, -2) . $M . '-' . $num;
        } else {
            $continue = do_hdr::all()->last();
            $de = substr($continue->do_hdr_kd, -6);
            $noRef = 'DO' . '-' . substr($Y, -2) . $M  . '-' . str_pad(($de + 1), 6, '0', STR_PAD_LEFT);
        };

        // KD HUTANG
        $numb = str_pad(000001, 6, 0, STR_PAD_LEFT);
        $Yr = date("Y");
        $Mh = date("m");
        $cekids = HutangSupplier::count();
        if ($cekids == 0) {
            $noRefHT =  'HT'  . '-' . substr($Yr, -2) . $Mh . '-' . $numb;
        } else {
            $continues = HutangSupplier::all()->last();
            $getKd = substr($continues->hs_kd_hutang, -6);
            $noRefHT = 'HT' . '-' . substr($Yr, -2) . $Mh  . '-' . str_pad(($getKd + 1), 6, '0', STR_PAD_LEFT);
        };

        $supplier = mstr_supplier::all();
        $listObat = mstr_obat::all();
        $lokasi = mstr_lokasi_stock::all();
        $viewDO = do_hdr::with('hdrToDetail')
            // ->where('chart_mr', $request->chart_mr)
            ->latest()
            ->get();
        $dateNow = Carbon::now()->format("Y-m-d");

        // $viewDO = DB::table('do_hdr')
        //     ->select('do_hdr.*', 'do_detail_item.*')
        //     ->distinct()
        //     ->leftJoin('do_detail_item', 'do_hdr.do_hdr_kd', 'do_detail_item.do_hdr_kd')
        //     ->get();

        return view('pages.delivery-order', [
            'supplier' => $supplier,
            'lokasi' => $lokasi,
            'viewDO' => $viewDO,
            'noRef' => $noRef,
            'noRefHT' => $noRefHT,
            'listObat' => $listObat,
            'dateNow' => $dateNow,
        ]);
    }

    public function getListObatDO()
    {
        if (request()->ajax()) {
            $isObatResep = DB::table('mstr_obat')
                // ->leftJoin('tb_stock', 'mstr_obat.fm_kd_obat', 'tb_stock.kd_obat')
                // ->select('fm_kd_obat', 'fm_nm_obat', 'fm_hrg_jual_resep', 'fm_satuan_jual', 'qty')
                // ->select('fm_kd_obat')
                ->get();
            return DataTables::of($isObatResep)
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" id="' . $row->fm_kd_obat . '" onClick="SelectItemObatDO(this)"
                    data-fm_kd_obat="' . $row->fm_kd_obat . '" data-fm_nm_obat="' . $row->fm_nm_obat . '" data-fm_satuan_pembelian="' . $row->fm_satuan_pembelian .
                        '"data-fm_isi_satuan_pembelian="' . $row->fm_isi_satuan_pembelian . '" data-fm_satuan_jual="' . $row->fm_satuan_jual . '" data-fm_hrg_beli="' . $row->fm_hrg_beli . '"
                    data-fm_hrg_beli_detail="' . $row->fm_hrg_beli_detail . '"
                    class="edit btn btn-xs btn-sm" style="background-color:#06D981; color:#ffffff;">Select</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
            return response()->json($isObatResep);
        }
    }


    public function adj()
    {
        // $num = str_pad(000001, 6, 0, STR_PAD_LEFT);
        // $Y = date("Y");
        // $M = date("m");
        // $cekid = tb_adjusment_hdr::count();
        // if ($cekid == 0) {
        //     $noRef =  'AJ'  . '-' . substr($Y, -2) . $M . '-' . $num;
        // } else {
        //     $continue = tb_adjusment_hdr::all()->last();
        //     $de = substr($continue->kd_adj, -6);
        //     $noRef = 'AJ' . '-' . substr($Y, -2) . $M  . '-' . str_pad(($de + 1), 6, '0', STR_PAD_LEFT);
        // };
        $ListObat = DB::table('mstr_obat')
            ->leftJoin('tb_stock', 'mstr_obat.fm_kd_obat', 'tb_stock.kd_obat')
            ->select('mstr_obat.*', 'tb_stock.*')
            ->get();
        // $isListAdj = DB::table('tb_adjusment_hdr')
        //     ->leftJoin('tb_adjusment_detail', 'tb_adjusment_hdr.kd_adj', 'tb_adjusment_detail.kd_adj')
        //     ->select('tb_adjusment_hdr.*', 'tb_adjusment_detail.*')
        //     ->latest('tb_adjusment_hdr.created_at')
        //     ->get();
        $dateNow = Carbon::now()->format("Y-m-d");

        return view('pages.adjusment', [
            'ListObat' => $ListObat,
            // 'noReff'    => $noRef,
            // 'isListAdj'    => $isListAdj,
            'dateNow'   => $dateNow
        ]);
    }

    public function getMonthAdjusment(Request $request)
    {
        // $today = Carbon::today()->toDateString();
        $selectMonth = $request->dataBulan;
        // dd($selectMonth);
        if (!$selectMonth) {
            $monthNow = Carbon::now()->format("m");
            $yearNow = Carbon::now()->format("Y");
            $isListAdjusment = tb_adjusment_hdr::whereyear('tgl_trs', '=', $yearNow)->whereMonth('tgl_trs', '=', $monthNow)->latest('tgl_trs')->get();
        } else {
            $isListAdjusment = tb_adjusment_hdr::where('tgl_trs', 'LIKE', '%' . $selectMonth . '%')->latest('created_at')->get();
        }

        return DataTables::of($isListAdjusment)
            ->addColumn('action', function ($row) {
                $actionBtn = '
                <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#EditAdjusment"
                onclick="getDetailAdj(this)" data-kd_adj="' . $row->kd_adj . '">&nbsp;&nbsp;<i class="fa fa-eye">&nbsp;&nbsp;</i></button>
                ';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getDetailAdjusment(Request $request)
    {
        $isViewAdjusment = tb_adjusment_hdr::where('tb_adjusment_hdr.kd_adj', '=', $request->kd_trs)
            ->leftJoin('tb_adjusment_detail', 'tb_adjusment_hdr.kd_adj', 'tb_adjusment_detail.kd_adj')
            ->get();

        return response()->json($isViewAdjusment);
    }

    public function createAdj(Request $request)
    {
        // $y = $request->all();
        // dd($y);
        $request->validate([
            // 'kd_adj' => 'required',
            'tgl_trs' => 'required',
            'periode_adjusment' => 'required',
            // 'nilai_total_adjusment' => 'required',   
        ]);

        DB::beginTransaction();
        try {

            $num = str_pad(000001, 6, 0, STR_PAD_LEFT);
            $Y = date("Y");
            $M = date("m");
            $cekid = tb_adjusment_hdr::count();
            if ($cekid == 0) {
                $noRef =  'AJ'  . '-' . substr($Y, -2) . $M . '-' . $num;
            } else {
                $continue = tb_adjusment_hdr::all()->last();
                $de = substr($continue->kd_adj, -6);
                $noRef = 'AJ' . '-' . substr($Y, -2) . $M  . '-' . str_pad(($de + 1), 6, '0', STR_PAD_LEFT);
            };


            $HdrAdj = [
                'kd_adj' => $noRef,
                'tgl_trs' => $request->tgl_trs,
                'periode_adjusment' => $request->periode_adjusment,
                'nilai_total_adjusment' => $request->total_adj,
                'keterangan' => $request->keterangan,
            ];
            tb_adjusment_hdr::create($HdrAdj);

            foreach ($request->kd_obat as $key => $val) {
                $detailObat = [
                    'kd_adj' => $noRef,
                    'kd_obat' => $request->kd_obat[$key],
                    'nm_obat' => $request->nm_obat[$key],
                    'satuan' => $request->satuan[$key],
                    'qty_awal' => $request->qty[$key],
                    'qty_sebenarnya' => $request->qty_adj[$key],
                    'koreksi_adj' => $request->qty_hasil_koreksi[$key],
                    'nilai_hpp' => $request->hrg_beli_hpp[$key],
                    'sub_total_adjusment' => $request->sub_total_adj[$key],
                    'user' => Auth::user()->name,
                ];
                tb_adjusment_detail::create($detailObat);
            }

            foreach ($request->kd_obat as $keyz => $val) {
                // $currentStock = DB::table('tb_stock')->whereIn('kd_obat', [$request->do_obat[$keyz]])->value('qty');
                if ($request->qty_hasil_koreksi[$keyz] < 0) {
                    $qtyKeluar = preg_replace("/[^0-9]/", "", $request->qty_hasil_koreksi[$keyz]);
                    $dataZ = [
                        'tanggal_trs' => $request->tgl_trs,
                        'kd_trs' => $noRef,
                        'kd_obat' => $request->kd_obat[$keyz],
                        'nm_obat' => $request->nm_obat[$keyz],
                        'supplier' => 'Adjusment/SO',
                        'no_batch' => '-',
                        'expired_date' => '-',
                        'qty_awal' => $request->qty[$keyz],
                        'qty_masuk' => '0',
                        'qty_keluar' => $qtyKeluar,
                        'qty_akhir'  => $request->qty_adj[$keyz],
                        'hpp_satuan' => $request->hrg_beli_hpp[$keyz],
                    ];
                } else {
                    $dataZ = [
                        'tanggal_trs' => $request->tgl_trs,
                        'kd_trs' => $noRef,
                        'kd_obat' => $request->kd_obat[$keyz],
                        'nm_obat' => $request->nm_obat[$keyz],
                        'supplier' => 'Adjusment/SO',
                        'no_batch' => '-',
                        'expired_date' => '-',
                        'qty_awal' => $request->qty[$keyz],
                        'qty_masuk' => $request->qty_hasil_koreksi[$keyz],
                        'qty_keluar' => '0',
                        'qty_akhir'  => $request->qty_adj[$keyz],
                        'hpp_satuan' => $request->hrg_beli_hpp[$keyz],
                    ];
                }

                kartuStockDetail::create($dataZ);
            }

            foreach ($request->kd_obat as $keys => $val) {
                $datax =  $request->kd_obat[$keys];
                $dataQty =  $request->qty_adj[$keys];
                $toInt = (int)$dataQty;

                tb_stock::whereIn('kd_obat', [$datax])->update(['qty' => $toInt]);
            }

            DB::commit();

            toastr()->success('Data Tersimpan!');
            return back();
            // return redirect()->route('/tindakan-medis');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Gagal Tersimpan!');
            return back();
        }
    }

    public function obatSearch(Request $request)
    {
        $isdataObat = [];

        if ($request->filled('q')) {
            $isdataObat = mstr_obat::select("fm_kd_obat", "fm_nm_obat", "fm_satuan_pembelian", "fm_hrg_beli")
                ->where('fm_nm_obat', 'LIKE', '%' . $request->get('q') . '%')
                ->get();
        }
        // dd($data);
        return response()->json($isdataObat);
    }

    public function getObatList(request $obat)
    {
        // $true = 'Amoxcillin 500mg';
        $isdataObat = mstr_obat::where('fm_kd_obat', $obat->fm_kd_obat)->get();

        // dd($isdata2);
        return response()->json($isdataObat);
    }

    public function doCreate(Request $request)
    {
        // dd($request->all());
        // $data = $request->all();

        $request->validate([
            'do_hdr_kd' => 'required',
            'do_hdr_no_faktur' => 'required',
            'do_hdr_supplier' => 'required',
            // 'do_hdr_tgl_tempo' => 'required',
            // 'do_hdr_lokasi_stock' => 'required',
            // 'do_hdr_total_faktur' => 'required',
            // 'user' => 'required',

            'do_obat' => 'required',
            'nm_obat' => 'required',
            // 'do_satuan_pembelian' => 'required',
            // // 'do_diskon',
            // 'do_qty' => 'required',
            // 'do_isi_pembelian' => 'required',
            // 'do_satuan_jual' => 'required',
            // 'do_hrg_beli' => 'required',
            // 'do_hrg_beli_detail' => 'required',
            // // 'do_pajak',
            // 'do_tgl_exp' => 'required',
            // // 'do_batch_number',
            // 'do_sub_total' => 'required',
            // 'do_hdr_id' => 'required'
        ]);

        DB::beginTransaction();
        try {
            // foreach ($request->do_obat as $uh => $valx) {
            //     if ($request->has('updateHrg')) {
            //         // $listBarang = $request->updateHrg[$uh];
            //         $detailIsi = DB::table('mstr_obat')->whereIn('fm_kd_obat', [$request->updateHrg[$uh]])->value('fm_isi_satuan_pembelian');
            //         print_r($detailIsi);
            //     } else {
            //         return false;
            //     }
            // }
            // die();

            $newData = [
                'tanggal_trs' => $request->tanggal_trs,
                'do_hdr_kd' => $request->do_hdr_kd,
                'do_hdr_no_faktur' => $request->do_hdr_no_faktur,
                'do_hdr_supplier' => $request->do_hdr_supplier,
                'do_hdr_tgl_tempo' => $request->do_hdr_tgl_tempo,
                // 'do_hdr_lokasi_stock' => $request->do_hdr_lokasi_stock,
                'do_hdr_total_faktur' => $request->do_hdr_total_faktur,
                'user' => Auth::user()->name,
            ];
            do_hdr::create($newData);

            foreach ($request->do_obat as $key => $val) {
                $detail = [
                    'do_obat' => $request->do_obat[$key],
                    'do_satuan_pembelian' => $request->do_satuan_pembelian[$key],
                    'do_diskon' => $request->do_diskon[$key],
                    'do_qty' => $request->do_qty[$key],
                    'do_isi_pembelian' => $request->do_isi_pembelian[$key],
                    'do_satuan_jual' => $request->do_satuan_jual[$key],
                    'do_hrg_beli' => $request->do_hrg_beli[$key],
                    'do_pajak' => $request->do_pajak[$key],
                    'do_tgl_exp' => $request->do_tgl_exp[$key],
                    'do_batch_number' => $request->do_batch_number[$key],
                    'do_sub_total' => $request->do_sub_total[$key],
                    'do_hdr_kd' => $request->do_hdr_kd,
                    'do_diskon_prosen' => $request->do_diskon_prosen[$key],
                    'nm_obat' => $request->nm_obat[$key],
                    'tanggal_trs' => $request->tanggal_trs,
                    // 'do_hdr_id' => $request->do_hdr_kd[$key],
                ];
                do_detail_item::create($detail);
            }

            if ($request->updateHrg) {
                foreach ($request->do_obat as $uh => $valx) {
                    $isSubttlTrue = $request->do_sub_total[$uh];
                    $demunLarge = $request->do_qty[$uh];
                    $hnappnLarge = $isSubttlTrue / $demunLarge;
                    $pembulatan = round($hnappnLarge, 2);
                    DB::table('mstr_obat')->whereIn('fm_kd_obat', [$request->do_obat[$uh]])->update([
                        'fm_hrg_beli' => $pembulatan,
                    ]);
                    // $hrgBeli = $request->do_hrg_beli[$uh];
                    $isItemTrue = array_filter([$request->do_obat[$uh]]);
                    $detailIsi = DB::table('mstr_obat')->whereIn('fm_kd_obat', [$isItemTrue])->value('fm_isi_satuan_pembelian');
                    $hnappnSmall = $hnappnLarge / $detailIsi;
                    $pembulatan2 = round($hnappnSmall, 2);
                    // $hrgJualDetail = $hrgBeli / $detailIsi;
                    DB::table('mstr_obat')->whereIn('fm_kd_obat', [$isItemTrue])->update([
                        'fm_hrg_beli_detail' => $pembulatan2
                    ]);
                    // print_r($hnappnLarge);
                    // print_r($hnappnSmall);
                }
            }
            // die();
            foreach ($request->do_obat as $keyx => $val) {
                $currentStock = DB::table('tb_stock')->whereIn('kd_obat', [$request->do_obat[$keyx]])->value('qty');
                $datax =  $request->do_obat[$keyx];
                // $currentStockF = preg_replace("/[^0-9]/", "", $currentStock);
                $dataQtyS =  $request->do_qty[$keyx];
                $dataIsiS =  $request->do_isi_pembelian[$keyx];
                $Y = (int)$dataQtyS * (int)$dataIsiS;
                $qtyAkhir = $currentStock + $Y;
                $detailKartuStock = [
                    'tanggal_trs' => $request->tanggal_trs,
                    'kd_trs' => $request->do_hdr_kd,
                    'kd_obat' => $request->do_obat[$keyx],
                    'nm_obat' => $request->nm_obat[$keyx],
                    'supplier' => $request->do_hdr_supplier,
                    'no_batch' => $request->do_batch_number[$keyx],
                    'expired_date' => $request->do_tgl_exp[$keyx],
                    'qty_awal' => $currentStock,
                    'qty_masuk' => $Y,
                    'qty_keluar' => '0',
                    'qty_akhir'  => $qtyAkhir,
                    // 'do_obat' => $request->do_obat[$keyx],
                    'hpp_satuan' => $request->do_hrg_beli_detail[$keyx],
                ];
                // print_r($currentStock);
                kartuStockDetail::create($detailKartuStock);
            }
            // die();

            foreach ($request->do_obat as $keys => $val) {
                $datax =  $request->do_obat[$keys];
                $dataQty =  $request->do_qty[$keys];
                $dataIsi =  $request->do_isi_pembelian[$keys];
                $X = (int)$dataQty * (int)$dataIsi;
                $toInt = (int)$X;

                tb_stock::whereIn('kd_obat', [$datax])->increment("qty", $toInt);
            }

            if ($request->do_hdr_tgl_tempo) {
                $HutangCreate = [
                    'hs_kd_hutang' => $request->hs_kd_hutang,
                    'hs_kd_hutang_buat' => $request->do_hdr_kd,
                    'hs_no_faktur' => $request->do_hdr_no_faktur,
                    'hs_supplier' => $request->do_hdr_supplier,
                    'hs_kd_rekening' => '1.1.1.1',
                    'hs_nilai_hutang' => $request->do_hdr_total_faktur,
                    'hs_pembayaran' => '0',
                    'hs_potongan' => '0',
                    'hs_hutang_akhir' => $request->do_hdr_total_faktur,
                    'hs_tanggal_trs' => $request->tanggal_trs,
                    'hs_tanggal_hutang' => $request->tanggal_trs,
                    'hs_tanggal_tempo' => $request->do_hdr_tgl_tempo,
                    'hs_tanggal_pelunasan' => 'Open',
                    'user' => Auth::user()->name,
                ];
                HutangSupplier::create($HutangCreate);
            }

            DB::commit();

            $sessionFlash = [
                'message' => 'Saved!',
                'alert-type' => 'success'
            ];

            return Redirect('/delivery-order')->with($sessionFlash);
        } catch (\Exception $e) {
            DB::rollback();

            $sessionFlashErr = [
                'message' => $e,
                'alert-type' => 'error'
            ];
            return Redirect('/delivery-order')->with($sessionFlashErr);
        }
    }

    public function getDOList(Request $request)
    {
        $isListDO = do_hdr::with('hdrToDetail')
            ->where('do_hdr_kd', $request->kd_do)
            ->get();

        return response()->json($isListDO);
    }
}
