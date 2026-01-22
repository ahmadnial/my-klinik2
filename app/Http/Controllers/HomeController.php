<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use App\Models\dataSosialCreate;
use App\Models\mstr_dokter;
use App\Models\mstr_jaminan;
use App\Models\mstr_layanan;
use App\Models\registrasiCreate;

use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    /* =====================================================
     * BASIC VIEW
     * ===================================================== */
    public function index()
    {
        return view('Pages.index');
    }

    public function login()
    {
        return view('Pages.login');
    }

    public function antrian()
    {
        return view('Pages.antrian');
    }

    /* =====================================================
     * DATA SOSIAL
     * ===================================================== */
    public function dasos()
    {
        $num_mr = str_pad(1, 7, '0', STR_PAD_LEFT);

        $exists = dataSosialCreate::exists();

        if (!$exists) {
            $mr = $num_mr;
        } else {
            // ❗ ambil 1 data terakhir saja (AMAN MEMORY)
            $lastMr = dataSosialCreate::orderBy('fs_mr', 'desc')->value('fs_mr');

            $mr = str_pad($lastMr + 1, 7, '0', STR_PAD_LEFT);
        }

        return view('Pages.data-sosial', compact('mr'));
    }

    public function getAllDasos()
    {
        if (request()->ajax()) {
            // ❗ DataTables server-side (TIDAK load semua data)
            $query = dataSosialCreate::select('fs_mr', 'fs_nama', 'fs_alamat', 'fs_tgl_lahir');

            return DataTables::of($query)
                ->addColumn('action', function ($row) {
                    return '
                        <a href="javascript:void(0)"
                           data-kdmr="' .
                        $row->fs_mr .
                        '"
                           onClick="getDasosEdit(this)"
                           class="edit btn btn-xs btn-sm"
                           style="background-color:#10F3A4; color:#fff;">
                           Edit
                        </a>
                        <a href="javascript:void(0)"
                           class="delete btn btn-xs btn-sm"
                           style="background-color:#F7686B; color:#fff;">
                           Delete
                        </a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('Pages.data-sosial');
    }

    /* =====================================================
     * REGISTRASI
     * ===================================================== */
    public function registrasi()
    {
        $num = str_pad(1, 8, '0', STR_PAD_LEFT);

        // ❗ Cek eksistensi TANPA load data
        $exists = registrasiCreate::withTrashed()->exists();

        if (!$exists) {
            $kd_reg = 'RG' . $num;
        } else {
            // ❗ Ambil kode terakhir SAJA
            $lastCode = registrasiCreate::withTrashed()->orderBy('created_at', 'desc')->value('fr_kd_reg');

            $number = preg_replace('/\D/', '', $lastCode);
            $kd_reg = 'RG' . str_pad($number + 1, 8, '0', STR_PAD_LEFT);
        }

        // ❗ master data: select kolom perlu saja
        $layanan = mstr_layanan::select('fm_kd_layanan', 'fm_nm_layanan')->get();

        $jaminan = mstr_jaminan::select('fm_kd_jaminan', 'fm_nm_jaminan')->get();

        // ❗ LIMIT tampilan aktif (tidak ubah alur UI)
        $isviewreg = registrasiCreate::where('fr_tgl_keluar', '=', '')->select('fr_kd_reg', 'fr_mr', 'fr_nama', 'fr_tgl_reg')->limit(100)->get();

        // ❗ JOIN besar DIBATASI
        // $isviewregSaset = DB::table('ta_registrasi')->select('ta_registrasi.fr_kd_reg', 'ta_registrasi.fr_mr', 'tc_mr.fs_nama')->leftJoin('tc_mr', 'tc_mr.fs_mr', '=', 'ta_registrasi.fr_mr')->leftJoin('saset_encounter', 'saset_encounter.regID', '=', 'ta_registrasi.fr_kd_reg')->whereNull('ta_registrasi.fr_tgl_keluar')->whereNull('ta_registrasi.deleted_at')->limit(100)->get();
        $isviewregSaset = DB::table('ta_registrasi')
            ->select(
                'ta_registrasi.fr_kd_reg',
                'ta_registrasi.fr_tgl_reg',
                'ta_registrasi.fr_mr',
                'ta_registrasi.fr_layanan',
                'ta_registrasi.fr_dokter',
                'ta_registrasi.fr_jaminan',
                'ta_registrasi.fr_session_poli',
                'ta_registrasi.fr_alergi',
                'ta_registrasi.fr_alamat',
                'ta_registrasi.fr_no_hp',
                'ta_registrasi.fr_user',
                'ta_registrasi.keluhan_utama',
                'ta_registrasi.fr_kd_medis',

                // 🔑 ALIAS DARI tc_mr (INI KUNCINYA)
                DB::raw('tc_mr.fs_nama AS fr_nama'),
                DB::raw('tc_mr.fs_tgl_lahir AS fr_tgl_lahir'),
                DB::raw('tc_mr.fs_no_hp AS fr_no_hp'),
                DB::raw('tc_mr.fs_alamat AS fr_alamat'),
                DB::raw('tc_mr.fs_alergi AS fr_alergi'),
                'tc_mr.fs_tgl_kunjungan_terakhir',
                'tc_mr.ihs_number',

                // status encounter
                'saset_encounter.encounterID',
                DB::raw("
            CASE
                WHEN saset_encounter.encounterID IS NULL
                THEN 'BELUM'
                ELSE 'TERKIRIM'
            END AS status
        "),
            )
            ->leftJoin('tc_mr', 'tc_mr.fs_mr', '=', 'ta_registrasi.fr_mr')
            ->leftJoin('saset_encounter', 'saset_encounter.regID', '=', 'ta_registrasi.fr_kd_reg')
            ->where('ta_registrasi.fr_tgl_keluar', '=', '')
            ->whereNull('ta_registrasi.deleted_at')
            ->orderBy('ta_registrasi.created_at', 'desc')
            ->limit(100)
            ->get();

        $dateNow = Carbon::now()->format('Y-m-d');

        return view('Pages.registrasi', compact('kd_reg', 'layanan', 'jaminan', 'isviewreg', 'isviewregSaset', 'dateNow'));
    }

    /* =====================================================
     * SEARCH & AJAX
     * ===================================================== */
    public function registrasiSearch(Request $request)
    {
        if (!$request->filled('q')) {
            return response()->json([]);
        }

        $data = dataSosialCreate::select('fs_mr', 'fs_nama', 'fs_alamat', 'fs_tgl_lahir')
            ->where('fs_nama', 'LIKE', "%{$request->q}%")
            ->orWhere('fs_mr', 'LIKE', "%{$request->q}%")
            ->limit(20)
            ->get();

        return response()->json($data);
    }

    public function getDasos(Request $request)
    {
        $aktif = DB::table('ta_registrasi')->where('fr_mr', $request->fs_mr)->whereNull('fr_tgl_keluar')->whereNull('deleted_at')->exists();

        if (!$aktif) {
            return response()->json(dataSosialCreate::where('fs_mr', $request->fs_mr)->limit(1)->get());
        }

        return response()->json([]);
    }

    public function getLayananMedis(Request $request)
    {
        $dokter = mstr_dokter::select('fm_kd_medis', 'fm_nm_medis')->where('fm_layanan', $request->fm_layanan)->limit(50)->get();

        return response()->json($dokter);
    }
}
