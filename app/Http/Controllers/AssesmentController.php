<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\registrasiCreate;
use Illuminate\Support\Carbon;

class AssesmentController extends Controller
{

    public function assAwal()
    {
        // $id = str_pad(00000001, 8, 0, STR_PAD_LEFT);
        // $vardate = date("Y-m");
        // $cekid = ChartTindakan::count();
        // if ($cekid == 0) {
        //     $chart_id =  'AS' . '-' . $vardate . $id;
        // } else {
        //     $continue = ChartTindakan::all()->last();
        //     $de = substr($continue->AssId, -3);
        //     $chart_id = 'AS' . '-' . $vardate . str_pad(($de + 1), 8, '0', STR_PAD_LEFT);
        // };
        $isRegActive = registrasiCreate::where('fr_tgl_keluar', '=', '')->get();
        $dateNow = Carbon::now()->format("Y-m-d");
        $timeNow = Carbon::now()->format("H:i:s");
        // $timeNow = Carbon::now();
        // $timeNow->toTimeString(); //14:15:16
        // dd($timeNow);
        return view('Pages.assesment-awal', [
            'isRegActive' => $isRegActive,
            'dateNow' => $dateNow,
            'timeNow' => $timeNow
        ]);
    }

    public function registerSearch(Request $request)
    {
        // $isRegSearch = registrasiCreate::where('fr_kd_reg', $request->fr_kd_reg)->get();
        $isRegSearch = registrasiCreate::with('tcmr')
            ->where('fr_kd_reg', $request->fr_kd_reg)->get();

        //  $isTimelineHistory = ChartTindakan::with('trstdk.nm_trf', 'resep')
        //     ->where('chart_mr', $request->chart_mr)
        return response()->json($isRegSearch);
    }

    public function createAssesment(Request $request)
    {
        dd($request->all());
    }
}
