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
        $num_mr = str_pad(000001, 6, 0, STR_PAD_LEFT);
        $cekid = dataSosialCreate::count();
        if ($cekid == 0) {
            $mr =  '2022'  . $num_mr;
        } else {
            $continue = dataSosialCreate::all()->last();
            $de = substr($continue->fs_mr, -3);
            $mr = '2022' . str_pad(($de + 1), 6, '0', STR_PAD_LEFT);
            // dd($kd_reg);
        };

        $isdatasosial = dataSosialCreate::all();

        return view('Pages.data-sosial', ['mr' => $mr, 'isdatasosial' => $isdatasosial]);
    }

    public function registrasi()
    {
        $num = str_pad(00000001, 8, 0, STR_PAD_LEFT);
        $cekid = registrasiCreate::count();
        if ($cekid == 0) {
            $kd_reg =  'RG'  . $num;
        } else {
            $continue = registrasiCreate::all()->last();
            $de = substr($continue->fr_kd_reg, -3);
            $kd_reg = 'RG' . str_pad(($de + 1), 8, '0', STR_PAD_LEFT);
            // dd($kd_reg);
        };

        $layanan = mstr_layanan::all();
        $jaminan = mstr_jaminan::all();
        $isviewreg = registrasiCreate::where('fr_tgl_keluar', '=', '')->get();
        $dateNow = Carbon::now()->format("Y-m-d");

        return view(
            'Pages.registrasi',
            ['kd_reg' => $kd_reg, 'jaminan' => $jaminan, 'layanan' => $layanan, 'isviewreg' => $isviewreg, 'dateNow' => $dateNow]
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
                ->get();
        }
        // dd($data);
        return response()->json($isdata);
    }

    public function getDasos(request $fs_mr)
    {
        // $true = '100013';
        $isdata2 = dataSosialCreate::where('fs_mr', $fs_mr->fs_mr)->get();

        // dd($isdata2);

        // return view('Pages.registrasi', ['isdata' => $isdata2]);
        return response()->json($isdata2);
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




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
