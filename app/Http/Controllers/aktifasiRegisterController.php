<?php

namespace App\Http\Controllers;

use App\Models\aktifasiRegister;
use App\Models\mstr_layanan;
use App\Models\registrasiCreate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class aktifasiRegisterController extends Controller
{
    public function aktifasiRegister()
    {
        $layanan = mstr_layanan::all();
        $dateNow = Carbon::now()->format("Y-m-d");
        $listAktifasi = DB::table('aktifasi_register')->where('tgl_deaktif', '=', '3000-01-01')->get();
        $listDeAktifasi = DB::table('aktifasi_register')->where('tgl_deaktif', '!=', '3000-01-01')->get();

        $num = str_pad(000001, 6, 0, STR_PAD_LEFT);
        $cekid = aktifasiRegister::count();
        // dd($cekid);
        if ($cekid == 0) {
            $kd_aktifasi_get =  'AF'  . $num;
        } else {
            $continue = aktifasiRegister::latest('created_at')->limit(1)->first();
            // $continue = DB::table('ta_registrasi')->withTrashed()->latest('created_at')->first();
            // $de = substr($continue->fr_kd_reg, -8); //old way
            $de = preg_replace('/[^0-9]/', '', $continue->kd_aktifasi);
            $kd_aktifasi_get = 'AF' . str_pad(($de + 1), 6, '0', STR_PAD_LEFT);
        };

        return view('Pages.aktifasi-berkas', [
            'layanan' => $layanan, 'dateNow' => $dateNow,
            'kd_aktifasi_get' => $kd_aktifasi_get,
            'listAktifasi' => $listAktifasi,
        ]);
    }

    public function getRegAktifasi(Request $request)
    {
        $isdata = [];

        if ($request->filled('q')) {
            $isdata = registrasiCreate::select("fr_mr", "fr_nama", "fr_kd_reg", "fr_tgl_keluar")
                ->where('fr_nama', 'LIKE', '%' . $request->get('q') . '%')
                ->orWhere('fr_mr', 'LIKE', '%' . $request->get('q') . '%')
                ->get();
        }
        return response()->json($isdata);
    }

    public function selectRegAktifasi(request $request)
    {
        // $true = '100013';
        $isdata2 = registrasiCreate::where('fr_mr', $request->fr_mr)->latest('created_at')->limit(1)->get();;
        // dd($isdata2);

        // return view('Pages.registrasi', ['isdata' => $isdata2]);
        return response()->json($isdata2);
    }

    public function aktifasiCreate(Request $request)
    {
        // dd($request->all());

        $d = aktifasiRegister::create($request->all());

        if ($d) {
            toastr()->success('saved!');
            return back();
        } else {
            toastr()->error('Gagal Tersimpan!');
            return back();
        }
    }

    public function deaktif(Request $request)
    {
        // dd($request->all());
        $dateNow = Carbon::now();
        $d =  DB::table('aktifasi_register')->where('kd_aktifasi', $request->kd_aktifasi)->update([
            'tgl_deaktif' => $dateNow,
            'user_deaktifasi' => Auth::user()->name,
        ]);

        if ($d) {
            $sessionFlash = [
                'Success'
            ];
        } else {
            $sessionFlash = [
                'Error'
            ];
        }
        return response()->json($sessionFlash);
    }
}
