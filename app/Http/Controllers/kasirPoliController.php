<?php

namespace App\Http\Controllers;

use App\Models\trs_chart;
use Illuminate\Http\Request;

class kasirPoliController extends Controller
{

    public function kasirPoli()
    {
        $getTrsTdk = trs_chart::all();
        return view('pages.kasir-poliklinik', ['isTrsTdk' => $getTrsTdk]);
    }

    public function xregisterSearch(Request $request)
    {
        $isRegSearchResult = trs_chart::where('kd_reg', $request->kd_reg)->get();

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
