<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dataSosialCreate;
use App\Models\registrasiCreate;
use App\Models\trs_chart;
use App\Models\trs_chart_resep;
use RealRashid\SweetAlert\Toaster;
use Yoeunes\Toastr\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;


class registrasiController extends Controller
{

    public function index()
    {
        //
    }


    public function store(Request $request)
    {
        // $yes = $request->all();
        // dd($yes);
        $request->validate([
            'fs_mr' => 'required',
            'fs_nama' => 'required',
            'fs_tgl_lahir' => 'required',
            'fs_jenis_kelamin' => 'required'
        ]);

        $data = dataSosialCreate::create($request->all());

        if ($data->save()) {
            toastr()->success('Data Tersimpan!');
            return back();
        } else {
            toastr()->error('Gagal Tersimpan!');
            return back();
        }
    }

    public function registrasiCreate(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'fr_kd_reg' => 'required',
            'fr_mr' => 'required',
            // 'fr_nama' => 'required',
            'fr_tgl_reg' => 'required',
            'fr_tgl_lahir' => 'required',
            'fr_jenis_kelamin' => 'required',
            'fr_alamat' => 'required',
            // 'fr_no_hp' => 'required',
            'fr_layanan' => 'required',
            'fr_dokter' => 'required',
            'fr_jaminan' => 'required',
            'fr_session_poli' => 'required'
        ]);

        $data = registrasiCreate::create($request->all());

        if ($data->save()) {
            toastr()->success('Data Tersimpan!');
            return back();
        } else {
            toastr()->error('Gagal Tersimpan!');
            return back();
        }
    }

    public function editRegister(Request $request)
    {
        // dd($request->all());
        $d =  DB::table('ta_registrasi')->where('fr_kd_reg', $request->fr_kd_reg)->update([
            'fr_tgl_reg' => $request->fr_tgl_reg,
            'fr_layanan' => $request->fr_layanan,
            'fr_dokter' => $request->fr_dokter,
            'fr_jaminan' => $request->fr_jaminan,
            'fr_session_poli' => $request->fr_session_poli,
            'keluhan_utama' => $request->keluhan_utama,
        ]);

        if ($d) {
            toastr()->success('Edit Data Berhasil!');
            return back();
        } else {
            toastr()->error('Gagal Tersimpan!');
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function editDasos(Request $request)
    {
        // dd($request->all());
        // $xc = DB::table('tc_mr')->where('fs_mr', $request->fs_mr)->get();
        // dd($xc);
        $y = DB::table('tc_mr')->where('fs_mr', $request->fs_mr)->update([
            // 'fs_mr' => $request->efs_mr,
            'fs_nama' => $request->fs_nama,
            'fs_tempat_lahir' => $request->fs_tempat_lahir,
            'fs_tgl_lahir' => $request->fs_tgl_lahir,
            'fs_jenis_kelamin' => $request->fs_jenis_kelamin,
            'fs_jenis_identitas' => $request->fs_jenis_identitas,
            'fs_no_identitas' => $request->fs_no_identitas,
            'fs_nm_ibu_kandung' => $request->fs_nm_ibu_kandung,
            'fs_alamat' => $request->fs_alamat,
            'fs_agama' => $request->fs_agama,
            'fs_suku' => $request->fs_suku,
            'fs_bahasa' => $request->fs_bahasa,
            'fs_pekerjaan' => $request->fs_pekerjaan,
            'fs_pendidikan' => $request->fs_pendidikan,
            'fs_status_kawin' => $request->fs_status_kawin,
            'fs_no_hp' => $request->fs_no_hp,
            'fs_user' => Auth::user()->name,
        ]);
        // dd($y);
        if ($y) {
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


    public function deleteDasos(Request $request)
    {
        $delete =  DB::table('tc_mr')->where('fs_mr', $request->fs_mr)->get();
        dd($delete);
        $delete->delete();

        return back();
    }


    public function voidRegister(Request $request)
    {
        // $reg = registrasiCreate::where('fr_kd_reg', '=', $request->regID)->first();
        $cekTrs = trs_chart::where('kd_reg', $request->regID)->value('kd_reg');
        $cekResep = trs_chart_resep::where('kd_reg', $request->regID)->pluck('kd_reg');

        // dd($cekTrs);
        if ($cekTrs == $request->regID) {
            $sessionFlash = [
                'Error'
            ];
            // return response()->json($sessionFlash);
        } else {
            DB::table('ta_registrasi')->where('fr_kd_reg', $request->regID)->update(['deleted_at' => Carbon::now()]);
            $sessionFlash = [
                'Success'
            ];
            // $reg->delete();
            // return back();
        }
        return response()->json($sessionFlash);
    }
}
