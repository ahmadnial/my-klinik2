<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dataSosialCreate;
use App\Models\registrasiCreate;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Pages.index');
    }

    public function dasos()
    {
        $cekid = dataSosialCreate::count();
        if ($cekid == 0) {
            $no_mr = 100011;
        } else {
            $continue = dataSosialCreate::all()->last();
            $temp = (int)substr($continue->fs_mr, -6) + 1;
            $no_mr = $temp;
        }
        return view('Pages.data-sosial', ['no_mr' => $no_mr]);
    }

    public function registrasi()
    {
        $cekreg = registrasiCreate::count();
        if ($cekreg == 0) {
            $kd_reg = 'RG' . 100001;
        } else {
            $continue = registrasiCreate::all()->last();
            $temp = 'RG' . '-' . (int)substr($continue->fr_kd_reg, -6) + 1;
            $kd_reg = $temp;
        }

        return view('Pages.registrasi', ['kd_reg' => $kd_reg]);
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
        $true = '100013';
        $isdata2 = dataSosialCreate::where('fs_mr', $fs_mr->fs_mr)->get();

        // dd($isdata2);

        // return view('Pages.registrasi', ['isdata' => $isdata2]);
        return response()->json($isdata2);
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
