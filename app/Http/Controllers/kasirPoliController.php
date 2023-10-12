<?php

namespace App\Http\Controllers;

use App\Models\trs_chart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class kasirPoliController extends Controller
{

    public function kasirPoli()
    {
        $getTrsTdk = DB::table('trs_chart')->select('*')->distinct()->get();
        return view('pages.kasir-poliklinik', ['isTrsTdk' => $getTrsTdk]);
    }

    public function xregisterSearch(Request $request)
    {
        // $isRegSearchResult = trs_chart::distinct('kd_reg')->where('kd_reg', $request->kd_reg)->get();
        // $isRegSearchResult = DB::table('trs_chart')->select('*')->where('kd_reg', $request->kd_reg)->groupBy('kd_reg')->get();


        $isRegSearchResult = DB::table('trs_chart')
            ->leftJoin('mstr_tindakan', 'mstr_tindakan.id', 'trs_chart.nm_tarif')
            ->leftJoin('mstr_nilai_tindakan', 'mstr_tindakan.id', 'mstr_nilai_tindakan.id_tindakan')
            ->select('trs_chart.*', 'mstr_tindakan.*', 'mstr_nilai_tindakan.*')
            ->where('trs_chart.kd_reg', $request->kd_reg)
            ->get();
        return response()->json($isRegSearchResult);
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
