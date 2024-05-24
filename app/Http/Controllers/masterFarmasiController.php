<?php

namespace App\Http\Controllers;

use App\Models\kartuStockHdr;
use App\Models\mstr_jenis_obat;
use App\Models\mstr_kategori_produk;
use App\Models\mstr_lokasi_stock;
use App\Models\mstr_obat;
use App\Models\mstr_satuan;
use App\Models\mstr_supplier;
use App\Models\tb_stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $golongan = mstr_jenis_obat::all();
        $obatview = mstr_obat::all();

        return view('pages.mstr2.mstr-obat', [
            'supplier' => $supplier,
            'kategori' => $kategori,
            'kd_obat' => $kd_obat,
            'satuanBeli' => $satuanBeli,
            'obatView' => $obatview,
            'golongan' => $golongan
        ]);
    }

    public function obatCreate(Request $request)
    {
        // $d = $request->all();
        // dd($d);

        $request->validate([
            'fm_kd_obat' => 'required',
            'fm_nm_obat' => 'required',
            'fm_kategori' => 'required',
            // 'fm_golongan_obat' => 'required',
            'fm_supplier' => 'required',
            'fm_satuan_pembelian' => 'required',
            'fm_isi_satuan_pembelian' => 'required',
            'fm_hrg_beli' => 'required',
            'fm_hrg_beli_detail' => 'required',
            'fm_satuan_jual' => 'required',
            'fm_hrg_jual_non_resep' => 'required',
            'fm_hrg_jual_resep' => 'required',
            'fm_hrg_jual_nakes' => 'required',
            'st_isi_pembelian'  => 'required',
            'st_hrg_beli_per1'  => 'required',
            'st_hrg_beli_per2'  => 'required',
            // 'isActive' => 'required',
            // 'isOpenPrice' => 'required',
            'user'
        ]);

        DB::beginTransaction();
        try {
            mstr_obat::create($request->all());

            $newData = [
                'kd_obat' => $request->fm_kd_obat,
                'nm_obat' => $request->fm_nm_obat,
                'satuan' => $request->fm_satuan_jual,
            ];
            tb_stock::create($newData);

            $kartuStock = [
                'ksh_kd_obat' => $request->fm_kd_obat,
                'ksh_nm_obat' => $request->fm_nm_obat,
                'ksh_satuan' => $request->fm_satuan_jual,
            ];
            kartuStockHdr::create($kartuStock);

            DB::commit();

            toastr()->success('Data Tersimpan!');
            // return back();
            // return redirect()->route('/tindakan-medis');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Gagal Tersimpan!');
            return back();
        }
    }

    public function obatEdit(Request $request)
    {
        // $d = $request->all();
        // dd($d);

        // $request->validate([
        //     'fm_kd_obat' => 'required',
        //     'fm_nm_obat' => 'required',
        //     'fm_kategori' => 'required',
        //     'fm_supplier' => 'required',
        //     'fm_satuan_pembelian' => 'required',
        //     'fm_isi_satuan_pembelian' => 'required',
        //     'fm_hrg_beli' => 'required',
        //     'fm_hrg_beli_detail' => 'required',
        //     'fm_satuan_jual' => 'required',
        //     'fm_hrg_jual_non_resep' => 'required',
        //     'fm_hrg_jual_resep' => 'required',
        //     'fm_hrg_jual_nakes' => 'required',
        //     'st_isi_pembelian'  => 'required',
        //     'st_hrg_beli_per1'  => 'required',
        //     'st_hrg_beli_per2'  => 'required',
        // ]);
        DB::beginTransaction();
        try {

            DB::table('mstr_obat')->where('fm_kd_obat', $request->fm_kd_obat)->update([
                // 'fm_kd_obat' => $request->efm_kd_obat,
                'fm_nm_obat' => $request->fm_nm_obat,
                'fm_kategori' => $request->fm_kategori,
                'fm_supplier' => $request->fm_supplier,
                'fm_golongan_obat' => $request->fm_golongan_obat,
                'fm_satuan_pembelian' => $request->fm_satuan_pembelian,
                'fm_isi_satuan_pembelian' => $request->fm_isi_satuan_pembelian,
                'fm_hrg_beli' => $request->fm_hrg_beli,
                'fm_hrg_beli_detail' => $request->fm_hrg_beli_detail,
                'fm_satuan_jual' => $request->fm_satuan_jual,
                'fm_hrg_jual_non_resep' => $request->fm_hrg_jual_non_resep,
                'fm_hrg_jual_resep' => $request->fm_hrg_jual_resep,
                'fm_hrg_jual_nakes' => $request->fm_hrg_jual_nakes,
                'isActive' => $request->isActive,
                'isOpenPrice' => $request->isOpenPrice,
                'user' => Auth::user()->name,
                'st_isi_pembelian'  => $request->st_isi_pembelian,
                'st_hrg_beli_per1'  => $request->st_hrg_beli_per1,
                'st_hrg_beli_per2'  => $request->st_hrg_beli_per2,
                'fm_hrg_jual_non_resep_persen' => $request->fm_hrg_jual_non_resep_persen,
                'fm_hrg_jual_resep_persen' => $request->fm_hrg_jual_resep_persen,
                'fm_hrg_jual_nakes_persen' => $request->fm_hrg_jual_nakes_persen,
            ]);

            DB::table('tb_stock')->where('kd_obat', $request->fm_kd_obat)->update([
                'nm_obat' => $request->fm_nm_obat,
                'satuan' => $request->fm_satuan_jual,
            ]);

            DB::commit();

            $dataSuccess = [
                'success' => true,
                'message' => 'Data Berhasil Diudapte!',
            ];

            return response()->json($dataSuccess);
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Gagal Tersimpan!');
            return back();
        }
    }

    public function obatDelete(Request $request)
    {
        // $d = $request->all();
        // dd($d);

        // $find = DB::table('mstr_obat')->where('fm_kd_obat', $request->kd_obat)->get();
        $find = mstr_obat::where('fm_kd_obat', $request->kd_obat);
        $find->delete();

        $dataSuccess = [
            'success' => true,
            'message' => 'Data Berhasil Dihapus!',
        ];

        return response()->json($dataSuccess);
    }
}
