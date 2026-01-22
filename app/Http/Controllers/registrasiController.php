<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Models\dataSosialCreate;
use App\Models\registrasiCreate;
use App\Models\trs_chart;
use App\Models\trs_chart_resep;
use App\Models\saset_patient;

class registrasiController extends Controller
{
    public function index()
    {
        //
    }

    /* =====================================================
     * DATA SOSIAL
     * ===================================================== */
    public function store(Request $request)
    {
        $request->validate([
            'fs_mr' => 'required',
            'fs_nama' => 'required',
            'fs_tgl_lahir' => 'required',
            'fs_jenis_kelamin' => 'required',
        ]);

        $data = dataSosialCreate::create($request->all());

        if ($data) {
            toastr()->success('Data Tersimpan!');
        } else {
            toastr()->error('Gagal Tersimpan!');
        }

        return back();
    }

    /* =====================================================
     * REGISTRASI PASIEN
     * ===================================================== */
    public function registrasiCreate(Request $request)
    {
        $request->validate([
            'fr_mr' => 'required',
            'fr_tgl_reg' => 'required',
            'fr_tgl_lahir' => 'required',
            'fr_jenis_kelamin' => 'required',
            'fr_alamat' => 'required',
            'fr_layanan' => 'required',
            'fr_dokter' => 'required',
            'fr_jaminan' => 'required',
            'fr_session_poli' => 'required',
        ]);

        // ===== Generate Kode Registrasi (AMAN MEMORY)
        $exists = registrasiCreate::withTrashed()->exists();
        $num = str_pad(1, 8, '0', STR_PAD_LEFT);

        if (!$exists) {
            $kd_reg = 'RG' . $num;
        } else {
            // $last = registrasiCreate::withTrashed()->latest('created_at')->first();
            $last = registrasiCreate::withTrashed()->select('fr_kd_reg')->orderBy('created_at', 'desc')->limit(1)->value('fr_kd_reg');

            $lastNumber = preg_replace('/\D/', '', $last->fr_kd_reg);
            $kd_reg = 'RG' . str_pad($lastNumber + 1, 8, '0', STR_PAD_LEFT);
        }

        DB::beginTransaction();
        try {
            $namaDokter = DB::table('mstr_dokter')->where('fm_kd_medis', $request->fr_dokter)->value('fm_nm_medis');

            registrasiCreate::create([
                'fr_kd_reg' => $kd_reg,
                'fr_mr' => $request->fr_mr,
                'fr_nama' => $request->fr_nama,
                'fr_tgl_lahir' => $request->fr_tgl_lahir,
                'fr_jenis_kelamin' => $request->fr_jenis_kelamin,
                'fr_alamat' => $request->fr_alamat,
                'fr_no_hp' => $request->fr_no_hp,
                'fr_layanan' => $request->fr_layanan,
                'fr_dokter' => $namaDokter,
                'fr_kd_medis' => $request->fr_dokter,
                'fr_session_poli' => $request->fr_session_poli,
                'fr_jaminan' => $request->fr_jaminan,
                'fr_bb' => $request->fr_bb,
                'fr_alergi' => $request->fr_alergi,
                'fr_user' => Auth::user()->name,
                'fr_tgl_reg' => $request->fr_tgl_reg,
                'keluhan_utama' => $request->keluhan_utama,
            ]);

            DB::commit();
            return response()->json('success');
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json('error', 500);
        }
    }

    /* =====================================================
     * EDIT REGISTRASI
     * ===================================================== */
    public function editRegister(Request $request)
    {
        $updated = DB::table('ta_registrasi')
            ->where('fr_kd_reg', $request->fr_kd_reg)
            ->update([
                'fr_tgl_reg' => $request->fr_tgl_reg,
                'fr_layanan' => $request->fr_layanan,
                'fr_dokter' => $request->fr_dokter,
                'fr_jaminan' => $request->fr_jaminan,
                'fr_session_poli' => $request->fr_session_poli,
                'keluhan_utama' => $request->keluhan_utama,
            ]);

        if ($updated) {
            toastr()->success('Edit Data Berhasil!');
        } else {
            toastr()->error('Gagal Tersimpan!');
        }

        return back();
    }

    /* =====================================================
     * EDIT DATA SOSIAL
     * ===================================================== */
    public function editDasos(Request $request)
    {
        $updated = DB::table('tc_mr')
            ->where('fs_mr', $request->fs_mr)
            ->update([
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
                'ihs_number' => $request->ihs_number,
                'fs_user' => Auth::user()->name,
                'updated_at' => Carbon::now(),
            ]);

        if ($request->ihs_number) {
            $exists = saset_patient::where('noMr', $request->fs_mr)->exists();

            if (!$exists) {
                saset_patient::create([
                    'noMr' => $request->fs_mr,
                    'kemkesId' => $request->ihs_number,
                    'name' => $request->fs_nama,
                    'user_id' => Auth::user()->name,
                ]);
            }
        }

        return response()->json($updated ? ['Success'] : ['Error']);
    }

    /* =====================================================
     * DELETE DATA SOSIAL
     * ===================================================== */
    public function deleteDasos(Request $request)
    {
        DB::table('tc_mr')->where('fs_mr', $request->fs_mr)->delete();

        return back();
    }

    /* =====================================================
     * VOID REGISTRASI
     * ===================================================== */
    public function voidRegister(Request $request)
    {
        $hasTrx = trs_chart::where('kd_reg', $request->regID)->exists();

        if ($hasTrx) {
            return response()->json(['Error']);
        }

        DB::table('ta_registrasi')
            ->where('fr_kd_reg', $request->regID)
            ->update(['deleted_at' => Carbon::now()]);

        return response()->json(['Success']);
    }
}
