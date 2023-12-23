<?php

namespace App\Http\Controllers;

use App\Models\do_detail_item;
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
        $isListPenjualan = tp_hdr::whereyear('tgl_trs', '=', $yearNow)->whereMonth('tgl_trs', '=', $monthNow)->latest()->get();
        return view('Pages.penjualan', [
            'noRef' => $noRef,
            'isListPenjualan' => $isListPenjualan,
            'isListRegResep' => $isListRegResep,
            'dateNow' => $dateNow,
        ]);
    }

    public function getListObatReguler()
    {
        // $isObatReguler = mstr_obat::select("fm_kd_obat", "fm_nm_obat", "fm_satuan_jual", "fm_hrg_beli", "fm_hrg_jual_non_resep")->get();

        $isObatReguler = DB::table('mstr_obat')
            ->leftJoin('tb_stock', 'mstr_obat.fm_kd_obat', 'tb_stock.kd_obat')
            ->select('fm_kd_obat', 'fm_nm_obat', 'fm_hrg_jual_non_resep', 'fm_satuan_jual', 'qty')
            // ->paginate(10)
            ->get();
        return response()->json($isObatReguler);
    }

    public function getListObatResep()
    {
        // $isObatResep = mstr_obat::select("fm_kd_obat", "fm_nm_obat", "fm_satuan_jual", "fm_hrg_beli", "fm_hrg_jual_resep")->get();
        $isObatResep = DB::table('mstr_obat')
            ->leftJoin('tb_stock', 'mstr_obat.fm_kd_obat', 'tb_stock.kd_obat')
            ->select('fm_kd_obat', 'fm_nm_obat', 'fm_hrg_jual_resep', 'fm_satuan_jual', 'qty')
            ->get();
        return response()->json($isObatResep);
    }

    public function getListObatNakes()
    {
        // $isObatNakes = mstr_obat::select("fm_kd_obat", "fm_nm_obat", "fm_satuan_jual", "fm_hrg_beli", "fm_hrg_jual_nakes")->get();
        $isObatNakes = DB::table('mstr_obat')
            ->leftJoin('tb_stock', 'mstr_obat.fm_kd_obat', 'tb_stock.kd_obat')
            ->select('fm_kd_obat', 'fm_nm_obat', 'fm_hrg_jual_nakes', 'fm_satuan_jual', 'qty')
            ->get();

        return response()->json($isObatNakes);
    }


    public function getListOrderResep(Request $kd_trs)
    {
        // $isListOrderResep = trs_chart_resep::select(
        //     "kd_trs",
        //     "chart_id",
        //     "tgl_trs",
        //     "layanan",
        //     "kd_reg",
        //     "mr_pasien",
        //     "nm_pasien",
        //     "kd_reg",
        //     "ch_kd_obat",
        //     "ch_nm_obat",
        //     "ch_qty_obat",
        //     "ch_satuan_obat",
        //     "ch_signa",
        //     "ch_cara_pakai",
        //     "ch_hrg_jual",
        // )
        //     ->leftJoin('do_detail_item', 'do_hdr.do_hdr_kd', 'do_detail_item.do_hdr_kd')
        //     ->select('do_hdr.*', 'do_detail_item.*')
        //     ->where('kd_trs', $kd_trs->kd_trs)->get();

        $isListOrderResep = DB::table('trs_chart_resep')
            ->leftJoin('tc_mr', 'trs_chart_resep.mr_pasien', 'tc_mr.fs_mr')
            ->select('trs_chart_resep.*', 'tc_mr.*')
            ->distinct()
            ->where('kd_trs', $kd_trs->kd_trs)
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
                    'tax'       => $request->tax[$key],
                    // // 'tulsah',
                    // // 'embalase',
                    'sub_total' => $request->sub_total[$key],
                    // // 'etiket',
                    // 'signa' => $request->signa[$key],
                    'cara_pakai' => $request->cara_pakai[$key],
                    'tgl_trs' => $request->tgl_trs,
                    'user' => Auth::user()->name,
                ];
                tp_detail_item::create($tpdetail);
            }

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

    public function getDetailPenjualan(Request $request)
    {
        $isViewDetailPenjualan = tp_detail_item::select('*')
            ->where('kd_trs', $request->kd_trs)
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
