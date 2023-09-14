<?php

namespace App\Http\Controllers;

use App\Models\mstr_kategori_produk;
use Illuminate\Http\Request;

class masterFarmasiController extends Controller
{

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

    public function satuan()
    {
        return view('pages.mstr2.mstr-satuan');
    }

    public function lokStock()
    {
        return view('pages.mstr2.mstr-lokasi-stock');
    }

    public function jenBat()
    {
        return view('pages.mstr2.mstr-jenis-obat');
    }

    public function supplier()
    {
        return view('pages.mstr2.mstr-supplier');
    }

    public function obat()
    {
        return view('pages.mstr2.mstr-obat');
    }
}
