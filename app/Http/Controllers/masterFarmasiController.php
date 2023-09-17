<?php

namespace App\Http\Controllers;

use App\Models\mstr_jenis_obat;
use App\Models\mstr_kategori_produk;
use App\Models\mstr_lokasi_stock;
use App\Models\mstr_obat;
use App\Models\mstr_satuan;
use App\Models\mstr_supplier;
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
        $num = str_pad(001, 3, 0, STR_PAD_LEFT);
        $cekid = mstr_supplier::count();
        if ($cekid == 0) {
            $kd_supplier =  'SP'  . $num;
        } else {
            $continue = mstr_supplier::all()->last();
            $de = substr($continue->fm_kd_supplier, -3);
            // dd($de);
            $kd_supplier = 'SP' . str_pad(($de + 1), 3, '0', STR_PAD_LEFT);
            // dd($kd_reg);
        };

        $supplier = mstr_supplier::all();

        return view('pages.mstr2.mstr-supplier', ['supplier' => $supplier, 'kd_supplier' => $kd_supplier]);
    }

    public function supplierCreate(Request $request)
    {
        $request->validate([
            'fm_kd_supplier' => 'required',
            'fm_nm_supplier' => 'required',
            // 'fm_email',
            // 'fm_no_tlp',
            // 'fm_alamat',
            // 'fm_kota',
            // 'fm_kd_pos',
            // 'fm_npwp'
        ]);

        mstr_supplier::create($request->all());
    }

    public function supplierDestroy($id)
    {
        $data = mstr_supplier::findOrFail($id);
        $data->delete();

        if ($data->save()) {
            toastr()->success('Data Berhasil Terhapus');
            return back();
        } else {
            toastr()->error('Gagal!');
            return back();
        }
    }

    // ============= SUPPLIER ================================================

    public function obat()
    {
        $num = str_pad(00001, 5, 0, STR_PAD_LEFT);
        $cekid = mstr_obat::count();
        if ($cekid == 0) {
            $kd_obat =  'TB'  . $num;
        } else {
            $continue = mstr_obat::all()->last();
            $de = substr($continue->fm_kd_obat, -5);
            // dd($de);
            $kd_obat = 'TB' . str_pad(($de + 1), 5, '0', STR_PAD_LEFT);
            // dd($kd_reg);
        };
        $supplier = mstr_supplier::all();
        $kategori = mstr_kategori_produk::all();
        $satuanBeli = mstr_satuan::all();
        $obatview = mstr_obat::all();

        return view('pages.mstr2.mstr-obat', ['supplier' => $supplier, 'kategori' => $kategori, 'kd_obat' => $kd_obat, 'satuanBeli' => $satuanBeli, 'obatView' => $obatview]);
    }

    public function obatCreate(Request $request)
    {
        $request->validate([
            'fm_kd_obat' => 'required',
            'fm_nm_obat' => 'required',
            'fm_kategori' => 'required',
            'fm_supplier' => 'required',
            'fm_satuan_pembelian' => 'required',
            'fm_isi_satuan_pembelian' => 'required',
            'fm_hrg_beli' => 'required',
            'fm_satuan_jual' => 'required',
            'fm_hrg_jual_non_resep' => 'required',
            'fm_hrg_jual_resep' => 'required',
            'fm_hrg_jual_nakes' => 'required',
            'isActive' => 'required',
            'isOpenPrice' => 'required',
            'user'
        ]);
        // http_response_code(500);
        // dd($request);
        mstr_obat::create($request->all());
    }
}
