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
        $y =  DB::table('tc_mr')->where('fs_mr', $request->efs_mr)->update([
            // 'fs_mr' => $request->efs_mr,
            'fs_nama' => $request->efs_nama,
            'fs_tempat_lahir' => $request->efs_tempat_lahir,
            'fs_tgl_lahir' => $request->efs_tgl_lahir,
            'fs_jenis_kelamin' => $request->efs_jenis_kelamin,
            'fs_jenis_identitas' => $request->efs_jenis_identitas,
            'fs_no_identitas' => $request->efs_no_identitas,
            'fs_nm_ibu_kandung' => $request->efs_nm_ibu_kandung,
            'fs_alamat' => $request->efs_alamat,
            'fs_agama' => $request->efs_agama,
            'fs_suku' => $request->efs_suku,
            'fs_bahasa' => $request->efs_bahasa,
            'fs_pekerjaan' => $request->efs_pekerjaan,
            'fs_pendidikan' => $request->efs_pendidikan,
            'fs_status_kawin' => $request->efs_status_kawin,
            'fs_no_hp' => $request->efs_no_hp,
            // 'fs_user' => $request->efs_user,
        ]);
        // dd($request->all());
        return response()->json($y);
        // if ($y) {
        //     toastr()->success('Edit Data Berhasil!');
        //     return back();
        // } else {
        //     toastr()->error('Gagal Tersimpan!');
        //     return back();
        // }
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
        $cekTrs = trs_chart::where('kd_reg', $request->regID)->pluck('kd_reg');
        $cekResep = trs_chart_resep::where('kd_reg', $request->regID)->pluck('kd_reg');

        dd($cekTrs);
        if ($cekTrs != $request->regID && $cekResep != $request->regID) {
            DB::table('ta_registrasi')->where('fr_kd_reg', $request->regID)->update(['deleted_at' => Carbon::now()]);
        }
        // $reg->delete();
        return back();
    }
}
