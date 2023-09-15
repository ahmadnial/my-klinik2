<?php

namespace App\Http\Controllers;

use App\Models\mstr_jenis_obat;
use App\Models\mstr_kategori_produk;
use App\Models\mstr_lokasi_stock;
use App\Models\mstr_satuan;
use Illuminate\Http\Request;

class masterFarmasiController extends Controller
{
    // ============= KATEGORI PRODUK =======================================
    public function katProd()
    {
        $katprod = mstr_kategori_produk::all();
        return view('pages.mstr2.mstr-kategori-produk', ['katprod' => $katprod]);
    }

    public function katProdCreate(Request $request)
    {
        $request->validate([
            'fm_nm_kategori_produk' => 'required',
        ]);

        mstr_kategori_produk::create($request->all());
    }

    // ============= KATEGORI PRODUK =======================================


    // ============= SATUAN ================================================ 

    public function satuan()
    {
        $satuan = mstr_satuan::all();

        return view('pages.mstr2.mstr-satuan', ['satuan' => $satuan]);
    }

    public function satuanCreate(Request $request)
    {
        $request->validate([
            'fm_nm_satuan' => 'required',
        ]);

        mstr_satuan::create($request->all());
    }

    public function satuanDestroy($id)
    {
        $data = mstr_satuan::findOrFail($id);
        $data->delete();

        if ($data->save()) {
            toastr()->success('Data Berhasil Terhapus');
            return back();
        } else {
            toastr()->error('Gagal!');
            return back();
        }
    }

    // ============= SATUAN =================================================


    // ============= LOKASI STOCK ============================================
    public function lokStock()
    {
        $lokstock = mstr_lokasi_stock::all();

        return view('pages.mstr2.mstr-lokasi-stock', ['lokstock' => $lokstock]);
    }

    public function lokstockCreate(Request $request)
    {
        $request->validate([
            'fm_nm_lokasi_stock' => 'required',
        ]);

        mstr_lokasi_stock::create($request->all());
    }

    public function lokStockDestroy($id)
    {
        $data = mstr_lokasi_stock::findOrFail($id);
        $data->delete();

        if ($data->save()) {
            toastr()->success('Data Berhasil Terhapus');
            return back();
        } else {
            toastr()->error('Gagal!');
            return back();
        }
    }
    // ============= LOKASI STOCK ============================================


    // ============= JENIS OBAT ==============================================

    public function jenBat()
    {
        $jenbat = mstr_jenis_obat::all();

        return view('pages.mstr2.mstr-jenis-obat', ['jenbat' => $jenbat]);
    }

    public function jenbatCreate(Request $request)
    {
        $request->validate([
            'fm_nm_jenis_obat' => 'required',
        ]);

        mstr_jenis_obat::create($request->all());
    }

    public function jenbatDestroy($id)
    {
        $data = mstr_jenis_obat::findOrFail($id);
        $data->delete();

        if ($data->save()) {
            toastr()->success('Data Berhasil Terhapus');
            return back();
        } else {
            toastr()->error('Gagal!');
            return back();
        }
    }
    // ============= JENIS OBAT ==============================================

    // ============= SUPPLIER ================================================

    public function supplier()
    {
        return view('pages.mstr2.mstr-supplier');
    }

    // ============= SUPPLIER ================================================

    public function obat()
    {
        return view('pages.mstr2.mstr-obat');
    }
}
