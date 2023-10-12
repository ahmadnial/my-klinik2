<?php

namespace App\Http\Controllers;

use App\Models\mstr_dokter;
use App\Models\mstr_jaminan;
use App\Models\mstr_tindakan;
use Illuminate\Http\Request;
use App\Models\mstr_layanan;
use App\Models\mstr_nilai_tindakan;
use Yoeunes\Toastr\Toastr;
use Illuminate\Support\Facades\DB;
use Dflydev\DotAccessData\Data;
use DataTables;

class mastersatuController extends Controller
{

    public function layanan()
    {
        $num = str_pad(001, 3, 0, STR_PAD_LEFT);

        $cekid = mstr_layanan::count();
        if ($cekid == 0) {
            $kd_layanan =  'LA'  . $num;
        } else {
            $continue = mstr_layanan::all()->last();
            $de = substr($continue->fm_kd_layanan, -3);
            $kd_layanan = 'LA' . str_pad(($de + 1), 3, '0', STR_PAD_LEFT);
            // dd($kd_layanan);
        }

        $isview = mstr_layanan::all();

        return view('pages.mstr1.mstr-layanan', ['kd_layanan' => $kd_layanan], ['isview' => $isview]);
    }

    public function layananCreate(Request $request)
    {
        $request->validate([
            'fm_kd_layanan' => 'required',
            'fm_nm_layanan' => 'required',
        ]);

        $data = mstr_layanan::create($request->all());

        if ($data->save()) {
            toastr()->success('Data Tersimpan!');
            return back();
        } else {
            toast('Gagal Tersimpan!', 'error')->autoClose(5000);
            return back();
        }
    }

    public function viewLayanan()
    {
        $isview = mstr_layanan::all();

        // return view('pages.mstr1.mstr-layanan', ['isview' => $isview]);
        // return DataTables::of($isview)->Make(true);
    }


    public function medis()
    {
        $isview = mstr_dokter::all();
        $isviewlayanan = mstr_layanan::all();

        return view('pages.mstr1.mstr-medis', ['isview' => $isview], ['islayanan' => $isviewlayanan]);
    }


    public function DokterCreate(Request $request)
    {
        $request->validate([
            'fm_kd_medis' => 'required',
            'fm_nm_medis' => 'required',
            'fm_sip_medis' => 'required',
            'fm_kadaluarsa_sip' => 'required',
            'fm_layanan' => 'required',
        ]);

        $data = mstr_dokter::create($request->all());

        if ($data->save()) {
            toastr()->success('Data Tersimpan!');
            return back();
        } else {
            toastr()->error('Gagal Tersimpan!');
            return back();
        }
    }


    public function jaminan()
    {
        $isjaminan = mstr_jaminan::all();

        return view('pages.mstr1.mstr-jaminan', ['isjaminan' => $isjaminan]);
    }

    public function jaminanCreate(Request $request)
    {
        $request->validate([
            'fm_kd_jaminan' => 'required',
            'fm_nm_jaminan' => 'required',
        ]);

        $data = mstr_jaminan::create($request->all());

        if ($data->save()) {
            toastr()->success('Data Tersimpan!');
            return back();
        } else {
            toastr()->error('Gagal Tersimpan!');
            return back();
        }
    }

    public function tindakan()
    {
        $istindakan = mstr_tindakan::all();

        return view('pages.mstr1.mstr-tindakan', ['istindakan' => $istindakan]);
    }

    public function tindakanCreate(Request $request)
    {
        $request->validate([
            'nm_tindakan' => 'required',
            // 'tarif_tindakan' => 'required',
        ]);

        $data = mstr_tindakan::create($request->all());

        if ($data->save()) {
            toastr()->success('Data Tersimpan!');
            return back();
        } else {
            toastr()->error('Gagal Tersimpan!');
            return back();
        }
    }

    public function nilaiTindakan()
    {
        $isnilaitindakan = DB::table('mstr_nilai_tindakan')
            ->leftJoin('mstr_tindakan', 'mstr_nilai_tindakan.id_tindakan', 'mstr_tindakan.id')
            ->select('mstr_nilai_tindakan.*', 'mstr_tindakan.*')
            ->get();
        // dd($isnilaitindakan);
        $istindakan = mstr_tindakan::all();

        return view('pages.mstr1.mstr-nilai-tindakan', ['isnilaitindakan' => $isnilaitindakan, 'istindakan' => $istindakan]);
    }

    public function nilaiTindakanCreate(Request $request)
    {
        $request->validate([
            'id_tindakan' => 'required',
            // 'nm_tindakan' => 'required',
            'nilai_tarif' => 'required',
        ]);

        $data = mstr_nilai_tindakan::create($request->all());

        if ($data->save()) {
            toastr()->success('Data Tersimpan!');
            return back();
        } else {
            toast('Gagal Tersimpan!', 'error')->autoClose(5000);
            return back();
        }
    }
}
