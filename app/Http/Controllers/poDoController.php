<?php

namespace App\Http\Controllers;

use App\Models\do_detail_item;
use App\Models\do_hdr;
use App\Models\mstr_lokasi_stock;
use App\Models\mstr_obat;
use App\Models\mstr_supplier;
use Illuminate\Http\Request;

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
        $supplier = mstr_supplier::all();
        $lokasi = mstr_lokasi_stock::all();

        return view('pages.delivery-order', ['supplier' => $supplier, 'lokasi' => $lokasi]);
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
        $request->validate([
            'do_hdr_kd' => 'required',
            'do_hdr_no_faktur' => 'required',
            'do_hdr_supplier' => 'required',
            'do_hdr_tgl_tempo' => 'required',
            'do_hdr_lokasi_stock' => 'required',
            // 'do_hdr_total_faktur' => 'required',
            'user' => 'required',

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
            'do_hdr_kd' => 'required'
        ]);


        $do_hdr = new do_hdr;
        $do_hdr->do_hdr_kd = $request->do_hdr_kd;
        $do_hdr->do_hdr_no_faktur = $request->do_hdr_no_faktur;
        $do_hdr->do_hdr_supplier = $request->do_hdr_supplier;
        $do_hdr->do_hdr_tgl_tempo = $request->do_hdr_tgl_tempo;
        $do_hdr->do_hdr_lokasi_stock = $request->do_hdr_lokasi_stock;
        $do_hdr->do_hdr_total_faktur = $request->do_hdr_total_faktur;
        $do_hdr->user = $request->user;

        $do_hdr->save();

        $do_detail_item = new do_detail_item();
        $do_detail_item->do_obat = $request->do_obat;
        $do_detail_item->do_satuan_pembelian = $request->do_satuan_pembelian;
        $do_detail_item->do_diskon = $request->do_diskon;
        $do_detail_item->do_qty = $request->do_qty;
        $do_detail_item->do_isi_pembelian = $request->do_isi_pembelian;
        $do_detail_item->do_satuan_jual = $request->do_satuan_jual;
        $do_detail_item->do_hrg_beli = $request->do_hrg_beli;
        $do_detail_item->do_pajak = $request->do_pajak;
        $do_detail_item->do_tgl_exp = $request->do_tgl_exp;
        $do_detail_item->do_batch_number = $request->do_batch_number;
        $do_detail_item->do_sub_total = $request->do_sub_total;
        $do_detail_item->do_hdr_kd = $request->do_hdr_kd;

        // $do_detail_item->save();

        $do_hdr->do_detail_item()->save($do_detail_item);
        // dd($request);
    }
}