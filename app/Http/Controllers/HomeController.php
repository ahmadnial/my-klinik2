<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dataSosialCreate;
use App\Models\mstr_dokter;
use App\Models\mstr_jaminan;
use App\Models\mstr_layanan;
use App\Models\registrasiCreate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;


use function Laravel\Prompts\error;

class HomeController extends Controller
{
    public function index()
    {
        return view('Pages.index');
    }

    public function login()
    {
        return view('Pages.login');
    }

    public function dasos()
    {
        $num_mr = str_pad(0000001, 7, 0, STR_PAD_LEFT);
        $cekid = dataSosialCreate::count();
        if ($cekid == 0) {
            $mr =  $num_mr;
        } else {
            $continue = dataSosialCreate::all()->last();
            $de = $continue->fs_mr;
            $mr =  str_pad(($de + 1), 7, '0', STR_PAD_LEFT);
            // dd($kd_reg);
        };
        // if (request()->ajax()) {
        //     $dasos = dataSosialCreate::query();
        //     return DataTables::of($dasos)
        //         ->make();
        // }
        // $isdatasosial = DB::table('tc_mr')->get();

        // return view('Pages.data-sosial', ['mr' => $mr, 'isdatasosial' => $isdatasosial]);
        return view('Pages.data-sosial', ['mr' => $mr]);
    }

    public function getAllDasos()
    {
        if (request()->ajax()) {
            $dasos = dataSosialCreate::select('*');
            return DataTables::of($dasos)
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" id="' . $row->fs_mr . '" onClick="getDasosEdit(this)" data-kdmr="' . $row->fs_mr . '" class="edit btn btn-xs btn-sm" style="background-color:#10F3A4; color:#ffffff;">Edit</a>
                    <a href="javascript:void(0)" class="delete btn btn-xs btn-sm" style="background-color:#F7686B; color:#ffffff;">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('Pages.data-sosial');
    }

    public function registrasi()
    {
        $num = str_pad(00000001, 8, 0, STR_PAD_LEFT);
        $cekid = registrasiCreate::withTrashed()->get();
        if ($cekid == '') {
            $kd_reg =  'RG'  . $num;
        } else {
            $continue = registrasiCreate::withTrashed()->latest('created_at')->first();
            // $continue = DB::table('ta_registrasi')->withTrashed()->latest('created_at')->first();
            // $de = substr($continue->fr_kd_reg, -8); //old way
            $de = preg_replace('/[^0-9]/', '', $continue->fr_kd_reg);
            $kd_reg = 'RG' . str_pad(($de + 1), 8, '0', STR_PAD_LEFT);
        };

        $layanan = mstr_layanan::all();
        $jaminan = mstr_jaminan::all();
        $isviewreg = registrasiCreate::where('fr_tgl_keluar', '=', '')->get();
        $isviewregSaset = DB::table('ta_registrasi')
        ->leftJoin('tc_mr', 'tc_mr.fs_mr', '=', 'ta_registrasi.fr_mr')
        ->where('ta_registrasi.fr_tgl_keluar', '=', '')
        ->where('ta_registrasi.deleted_at', '=', NULL)
        ->get();
        $dateNow = Carbon::now()->format("Y-m-d");

        return view(
            'Pages.registrasi',
            ['kd_reg' => $kd_reg, 'jaminan' => $jaminan, 'layanan' => $layanan, 'isviewreg' => $isviewreg, 'dateNow' => $dateNow,'isviewregSaset' => $isviewregSaset]
        );
    }

    public function registrasiView()
    {
        // $isviewreg = registrasiCreate::all();

        // return response()->json($isviewreg);
    }


    public function registrasiSearch(Request $request)
    {
        $isdata = [];

        if ($request->filled('q')) {
            $isdata = dataSosialCreate::select("fs_mr", "fs_nama", "fs_alamat", "fs_tgl_lahir")
                ->where('fs_nama', 'LIKE', '%' . $request->get('q') . '%')
                ->orWhere('fs_mr', 'LIKE', '%' . $request->get('q') . '%')
                ->get();
        }
        // dd($data);
        return response()->json($isdata);
    }

    public function getDasos(request $fs_mr)
    {
        $isRegAktifNow = DB::table('ta_registrasi')->where([
            ['fr_mr', '=', $fs_mr->fs_mr],
            ['fr_tgl_keluar', '=', ''],
            ['deleted_at', '=', null],
        ])->count();
        // dd($isRegAktifNow);
        if ($isRegAktifNow == 0) {
            $isdata2 = dataSosialCreate::where('fs_mr', $fs_mr->fs_mr)->get();
            return response()->json($isdata2);
        }
    }

    public function getLayananMedis(request $id_layanan)
    {
        // $true = 'LA1';
        $islayananMedis = mstr_dokter::where('fm_layanan', $id_layanan->fm_layanan)->get();

        // dd($islayananMedis);
        return response()->json($islayananMedis);
    }

    public function antrian()
    {
        return view('Pages.antrian');
    }
}
