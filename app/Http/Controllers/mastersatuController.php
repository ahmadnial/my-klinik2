<?php

namespace App\Http\Controllers;

use App\Models\mstr_dokter;
use Illuminate\Http\Request;
use App\Models\mstr_layanan;
use Dflydev\DotAccessData\Data;
use DataTables;

class mastersatuController extends Controller
{

    public function layanan()
    {
        $cekid = mstr_layanan::count();
        if ($cekid == 0) {
            $kd_layanan =  'LA'  . 001;
        } else {
            $continue = mstr_layanan::all()->last();
            $temp = 'LA' . (int)substr($continue->fm_kd_layanan, -1) + 1;
            $kd_layanan = $temp;
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
            toast('Berhasil Tersimpan', 'success')->autoClose(5000);
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
            toast('Berhasil Tersimpan', 'success')->autoClose(5000);
            return back();
        } else {
            toast('Gagal Tersimpan!', 'error')->autoClose(5000);
            return back();
        }
    }


    public function jaminan()
    {
        return view('pages.mstr1.mstr-jaminan');
    }
}
