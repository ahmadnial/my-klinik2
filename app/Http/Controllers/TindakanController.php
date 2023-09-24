<?php

namespace App\Http\Controllers;

use App\Models\ChartTindakan;
use App\Models\registrasiCreate;
use Illuminate\Http\Request;

class TindakanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function tindakanMedis()
    {
        $id = str_pad(00000001, 8, 0, STR_PAD_LEFT);
        $vardate = date("Y-m");
        $cekid = ChartTindakan::count();
        if ($cekid == 0) {
            $chart_id =  'CH' . '-' . $vardate . $id;
        } else {
            $continue = ChartTindakan::all()->last();
            $de = substr($continue->chart_id, -3);
            $chart_id = 'CH' . '-' . $vardate . str_pad(($de + 1), 8, '0', STR_PAD_LEFT);
        };

        $isRegActive = registrasiCreate::all();
        $isTindakanChart = ChartTindakan::all();

        return view('pages.tindakan-medis', ['isRegActive' => $isRegActive, 'chart_id' => $chart_id, 'isTindakanChart' => $isTindakanChart]);
    }

    public function registerSearch(Request $request)
    {
        $isRegSearch = registrasiCreate::where('fr_kd_reg', $request->fr_kd_reg)->get();

        return response()->json($isRegSearch);
    }


    public function chartCreate(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'chart_id' => 'required',
            // 'chart_tgl_trs' => 'required',
            'chart_kd_reg' => 'required',
            'chart_mr' => 'required',
            'chart_nm_pasien' => 'required',
            'chart_layanan' => 'required',
            'chart_dokter' => 'required',
            'user' => 'required',
            // 'chart_S',
            // 'chart_O',
            // 'chart_A',
            // 'chart_A_diagnosa',
            // 'chart_P',
            // 'chart_P_resep',
            // 'chart_P_tindakan'
        ]);
        // http_response_code(500);
        // dd($request);
        ChartTindakan::create($request->all());
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
