<?php

namespace App\Http\Controllers;

use App\Models\do_detail_item;
use App\Models\do_hdr;
use App\Models\mstr_lokasi_stock;
use App\Models\mstr_obat;
use App\Models\mstr_supplier;
use App\Models\tb_adjusment_detail;
use App\Models\tb_adjusment_hdr;
use App\Models\tb_stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

        $supplier = mstr_supplier::all();
        $listObat = mstr_obat::all();
        $lokasi = mstr_lokasi_stock::all();
        $viewDO = do_hdr::with('hdrToDetail')
            // ->where('chart_mr', $request->chart_mr)
            ->orderBy('created_at', 'DESC')
            ->get();
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
            'listObat' => $listObat
        ]);
    }

    public function adj()
    {
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
        $ListObat = DB::table('mstr_obat')
            ->leftJoin('tb_stock', 'mstr_obat.fm_kd_obat', 'tb_stock.kd_obat')
            ->select('mstr_obat.*', 'tb_stock.*')
            ->get();
        $isListAdj = tb_adjusment_hdr::all();

        return view('pages.adjusment', [
            'ListObat' => $ListObat,
            'noReff'    => $noRef,
            'isListAdj'    => $isListAdj
        ]);
    }

    public function createAdj(Request $request)
    {
        // $y = $request->all();
        // dd($y);
        $request->validate([
            'kd_adj' => 'required',
            'tgl_trs' => 'required',
            'periode_adjusment' => 'required',
            // 'nilai_total_adjusment' => 'required',   
        ]);

        DB::beginTransaction();
        // try {
        $HdrAdj = [
            'kd_adj' => $request->kd_adj,
            'tgl_trs' => $request->tgl_trs,
            'periode_adjusment' => $request->periode_adjusment,
            'nilai_total_adjusment' => $request->total_adj,
            'keterangan' => $request->keterangan,
        ];
        tb_adjusment_hdr::create($HdrAdj);

        foreach ($request->kd_obat as $key => $val) {
            $detailObat = [
                'kd_adj' => $request->kd_adj,
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
        // } catch (\Exception $e) {
        DB::rollback();
        toastr()->error('Gagal Tersimpan!');
        return back();
        // }
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
            'do_hdr_tgl_tempo' => 'required',
            // 'do_hdr_lokasi_stock' => 'required',
            // 'do_hdr_total_faktur' => 'required',
            // 'user' => 'required',

            'do_obat' => 'required',
            'nm_obat' => 'required',
            'do_satuan_pembelian' => 'required',
            // 'do_diskon',
            'do_qty' => 'required',
            'do_isi_pembelian' => 'required',
            'do_satuan_jual' => 'required',
            'do_hrg_beli' => 'required',
            // 'do_pajak',
            'do_tgl_exp' => 'required',
            // 'do_batch_number',
            'do_sub_total' => 'required',
            // 'do_hdr_id' => 'required'
        ]);

        DB::beginTransaction();
        // try {
        $newData = [
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
                // 'do_hdr_id' => $request->do_hdr_kd[$key],
            ];
            do_detail_item::create($detail);
        }
        // foreach ($request->do_obat as $keys => $val) {
        //     $cvToNum = $request->do_qty[$keys];
        //     $int = (int)$cvToNum;
        //     //     DB::table('tb_stock')->increment('qty', 20)->where('kd_obat' ,'=', $request->do_obat[$keys]);
        //     // foreach ($getKdObat as $ko) {
        //     // if ($ko->kd_obat == $request->do_obat) {
        //     DB::table('tb_stock')->where('kd_obat', $request->do_obat[$keys])->increment([
        //         // 'kd_obat' => $request->do_obat[$keys],
        //         // 'qty' => DB::raw('qty' + $int),
        //         'qty', $int,
        //         // 'qty' => $request->do_qty,
        //     ]);
        // }
        // }
        // }

        foreach ($request->do_obat as $keys => $val) {
            $datax =  $request->do_obat[$keys];
            $dataQty =  $request->do_qty[$keys];
            $dataIsi =  $request->do_isi_pembelian[$keys];
            $X = (int)$dataQty * (int)$dataIsi;
            $toInt = (int)$X;

            tb_stock::whereIn('kd_obat', [$datax])->increment("qty", $toInt);
        }


        DB::commit();

        toastr()->success('Data Tersimpan!');
        return back();
        // return redirect()->route('/tindakan-medis');
        // } catch (\Exception $e) {
        DB::rollback();
        toastr()->error('Gagal Tersimpan!');
        return back();
        // }
    }

    public function getDOList(Request $request)
    {
        $isListDO = do_hdr::with('hdrToDetail')
            ->where('do_hdr_kd', $request->kd_do)
            ->get();

        return response()->json($isListDO);
    }
}
