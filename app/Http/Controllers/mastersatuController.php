<?php

namespace App\Http\Controllers;

use App\Models\mstr_dokter;
use App\Models\mstr_jaminan;
use Illuminate\Http\Request;
use App\Models\mstr_layanan;
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
            $plus = 1;
            // dd($continue);
            $fix = substr($continue->fm_kd_layanan, -3);
            $temp = 'LA' . '00' . str_pad($fix, 3, 0, STR_PAD_LEFT) + 1;
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
            toast('Berhasil Tersimpan', 'success')->autoClose(5000);
            return back();
        } else {
            toast('Gagal Tersimpan!', 'error')->autoClose(5000);
            return back();
        }
    }
}
