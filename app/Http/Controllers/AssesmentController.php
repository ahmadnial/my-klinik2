<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\registrasiCreate;

class AssesmentController extends Controller
{

    public function assAwal()
    {
        $isRegActive = registrasiCreate::where('fr_tgl_keluar', '=', '')->get();

        return view('Pages.assesment-awal', ['isRegActive' => $isRegActive]);
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
}
