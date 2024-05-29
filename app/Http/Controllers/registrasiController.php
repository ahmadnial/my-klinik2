<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dataSosialCreate;
use App\Models\registrasiCreate;
use App\Models\trs_chart;
use App\Models\trs_chart_resep;
use RealRashid\SweetAlert\Toaster;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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
        $num = str_pad(00000001, 8, 0, STR_PAD_LEFT);
        $cekid = registrasiCreate::withTrashed()->get();
        if ($cekid == '') {
            $kd_reg =  'RG'  . $num;
        } else {
            $continue = registrasiCreate::withTrashed()->latest('created_at')->limit(1)->first();
            // $continue = DB::table('ta_registrasi')->withTrashed()->latest('created_at')->first();
            // $de = substr($continue->fr_kd_reg, -8); //old way
            $de = preg_replace('/[^0-9]/', '', $continue->fr_kd_reg);
            $kd_reg = 'RG' . str_pad(($de + 1), 8, '0', STR_PAD_LEFT);
        };

        $request->validate([
            // 'fr_kd_reg' => 'required',
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

        DB::beginTransaction();
        // try {
        $baseURL = getenv('BASE_URL_API');

        // Http::post($baseURL . '/encounter', [
        //     'regID' => $kd_reg,

        // ]);
        // $client = new Client();
        // $res = $client->request('POST', $baseURL . 'encounter', [
        //     // 'form_params' => [
        //     'regID' => $kd_reg
        //     // ]
        // ]);
        // echo $res->getStatusCode();
        // // 200
        // echo $res->getHeader('content-type');
        // // 'application/json; charset=utf8'
        // echo $res->getBody();
        // {"type":"User"...'

        $newReg = new registrasiCreate();
        $newReg->fr_kd_reg = $kd_reg;
        $newReg->fr_mr = $request->fr_mr;
        $newReg->fr_nama = $request->fr_nama;
        $newReg->fr_tgl_lahir = $request->fr_tgl_lahir;
        $newReg->fr_jenis_kelamin = $request->fr_jenis_kelamin;
        $newReg->fr_alamat = $request->fr_alamat;
        $newReg->fr_no_hp = $request->fr_no_hp;
        $newReg->fr_layanan = $request->fr_layanan;
        $newReg->fr_dokter = $request->fr_dokter;
        $newReg->fr_session_poli = $request->fr_session_poli;
        $newReg->fr_jaminan = $request->fr_jaminan;
        $newReg->fr_bb = $request->fr_bb;
        $newReg->fr_alergi = $request->fr_alergi;
        $newReg->fr_user = Auth::user()->name;
        $newReg->fr_tgl_reg = $request->fr_tgl_reg;
        $newReg->keluhan_utama = $request->keluhan_utama;

        $newReg->save();

        DB::commit();
        $sessionFlash = 'success';

        // return Redirect::to('/registrasi')->with($sessionFlash);
        return response()->json($sessionFlash);
        // } catch (\Exception $e) {
        DB::rollback();

        $sessionFlash = 'Error';
        // return Redirect::to('/registrasi')->with($sessionFlashErr);
        return response()->json($sessionFlash);
        // $data = registrasiCreate::create($request->all());

        // if ($newReg->save()) {
        //     toastr()->success('Data Tersimpan!');
        //     return back();
        // } else {
        //     toastr()->error('Gagal Tersimpan!');
        //     return back();
        // }
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
            'fs_alergi' => $request->fs_alergi,
            'fs_user' => Auth::user()->name,
            'updated_at' => Carbon::now(),
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
