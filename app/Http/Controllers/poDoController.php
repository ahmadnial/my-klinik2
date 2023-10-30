<?php

namespace App\Http\Controllers;

use App\Models\do_detail_item;
use App\Models\do_hdr;
use App\Models\mstr_lokasi_stock;
use App\Models\mstr_obat;
use App\Models\mstr_supplier;
use App\Models\tb_stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
        $lokasi = mstr_lokasi_stock::all();
        $viewDO = DB::table('do_hdr')
            ->leftJoin('do_detail_item', 'do_hdr.do_hdr_kd', 'do_detail_item.do_hdr_kd')
            ->select('do_hdr.*', 'do_detail_item.*')->get();
        // $viewDO = do_hdr::all();

        return view('pages.delivery-order', ['supplier' => $supplier, 'lokasi' => $lokasi, 'viewDO' => $viewDO, 'noRef' => $noRef]);
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
        $getKdObat = tb_stock::all();

        $request->validate([
            'do_hdr_kd' => 'required',
            'do_hdr_no_faktur' => 'required',
            'do_hdr_supplier' => 'required',
            'do_hdr_tgl_tempo' => 'required',
            'do_hdr_lokasi_stock' => 'required',
            // 'do_hdr_total_faktur' => 'required',
            // 'user' => 'required',

            'do_obat' => 'required',
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
        try {
            $newData = [
                'do_hdr_kd' => $request->do_hdr_kd,
                'do_hdr_no_faktur' => $request->do_hdr_no_faktur,
                'do_hdr_supplier' => $request->do_hdr_supplier,
                'do_hdr_tgl_tempo' => $request->do_hdr_tgl_tempo,
                'do_hdr_lokasi_stock' => $request->do_hdr_lokasi_stock,
                'do_hdr_total_faktur' => $request->do_hdr_total_faktur,
                'user' => $request->user,
            ];
            do_hdr::create($newData);
            // $newData = new do_hdr;
            // $newData->do_hdr_kd = $request->do_hdr_kd;
            // $newData->do_hdr_no_faktur = $request->do_hdr_no_faktur;
            // $newData->do_hdr_supplier = $request->do_hdr_supplier;
            // $newData->do_hdr_tgl_tempo = $request->do_hdr_tgl_tempo;
            // $newData->do_hdr_lokasi_stock = $request->do_hdr_lokasi_stock;
            // $newData->do_hdr_total_faktur = $request->do_hdr_total_faktur;
            // $newData->user = $request->user;
            // $newData->save();


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
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Gagal Tersimpan!');
            return back();
        }
    }
}
