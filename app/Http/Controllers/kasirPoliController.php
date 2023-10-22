<?php

namespace App\Http\Controllers;

use App\Models\trs_chart;
use App\Models\trs_kasir_poliklinik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class kasirPoliController extends Controller
{

    public function kasirPoli()
    {
        // $getTrsTdk = DB::table('trs_chart')->select('kd_reg', 'nm_pasien')->groupBy('kd_reg')->get();
        $getTrsTdk = trs_chart::select('kd_reg', 'nm_pasien')->distinct()->get();
        $dateNow = Carbon::now()->format("d-m-Y");

        return view('pages.kasir-poliklinik', ['isTrsTdk' => $getTrsTdk, 'dateNow' => $dateNow]);
    }

    public function xregisterSearch(Request $request)
    {
        // $isRegSearchResult = trs_chart::distinct('kd_reg')->where('kd_reg', $request->kd_reg)->get();
        // $isRegSearchResult = DB::table('trs_chart')->select('*')->where('kd_reg', $request->kd_reg)->groupBy('kd_reg')->get();


        $isRegSearchResult = DB::table('trs_chart')
            ->leftJoin('mstr_tindakan', 'mstr_tindakan.id', 'trs_chart.nm_tarif')
            ->leftJoin('mstr_nilai_tindakan', 'mstr_tindakan.id', 'mstr_nilai_tindakan.id_tindakan')
            ->select('trs_chart.*', 'mstr_tindakan.*', 'mstr_nilai_tindakan.*')
            // ->groupBy('trs_chart.kd_reg')
            ->where('trs_chart.kd_reg', $request->kd_reg)
            ->where('nm_tarif', '!=', '')
            // ->orwherenotNull('trs_chart.nm_tarif')
            // ->having('trs_chart.kd_reg', '>', 1)
            ->get();
        // , DB::raw('count(`kd_reg`) as kr')
        return response()->json($isRegSearchResult);
    }


    public function regOut(Request $request)
    {
        $yes = $request->all();
        dd($yes);

        $request->validate([
            'user' => 'required',

        ]);
        DB::beginTransaction();
        // try {

        $nerChart = new trs_kasir_poliklinik();
        $nerChart->chart_id = $request->chart_id;
        $nerChart->chart_tgl_trs = $request->chart_tgl_trs;
        $nerChart->chart_kd_reg  = $request->chart_kd_reg;
        $nerChart->chart_mr    = $request->chart_mr;
        $nerChart->chart_nm_pasien = $request->chart_nm_pasien;
        $nerChart->chart_layanan = $request->chart_layanan;
        $nerChart->chart_dokter = $request->chart_dokter;
        $nerChart->user   = $request->user_create;
        $nerChart->chart_S = $request->chart_S;
        $nerChart->chart_O = $request->chart_O;
        $nerChart->chart_A    = $request->chart_A;
        $nerChart->chart_A_diagnosa = $request->chart_A_diagnosa;
        $nerChart->chart_P = $request->chart_P;
        $nerChart->save();

        // dd($nerChart);
        // $newTrsChart = new trs_chart();
        // $newTrsChart->kd_trs = $request->kd_trs;
        // $newTrsChart->tgl_trs = $request->tgl_trs;
        // $newTrsChart->layanan = $request->layanan;
        // $newTrsChart->kd_reg = $request->kd_reg;
        // $newTrsChart->mr_pasien = $request->mr_pasien;
        // $newTrsChart->nm_pasien = $request->nm_pasien;
        // $newTrsChart->nm_tarif = $request->nm_tarif;
        // $newTrsChart->nm_dokter_jm = $request->nm_dokter_jm;
        // $newTrsChart->sub_total = $request->sub_total;
        // $newTrsChart->user = $request->user;
        // $newTrsChart->save();

        if ($request->nm_tarif != null) {
            foreach ($request->nm_tarif as $key => $val) {
                $newData = [
                    'kd_trs' => $request->kd_trs,
                    'chart_id' => $request->chart_id,
                    'tgl_trs' => $request->chart_tgl_trs,
                    'layanan' => $request->chart_layanan,
                    'kd_reg' => $request->chart_kd_reg,
                    'mr_pasien' => $request->chart_mr,
                    'nm_pasien' => $request->chart_nm_pasien,
                    'nm_tarif' => $request->nm_tarif[$key],
                    'nm_tarif_dasar' => $request->nm_tarif_dasar,
                    'nm_dokter_jm' => $request->chart_dokter,
                    'sub_total' => $request->sub_total,
                    'user' => $request->user_create,
                ];
                trs_chart::create($newData);
            };
        } else {
            $newData = [
                'kd_trs' => $request->kd_trs,
                'chart_id' => $request->chart_id,
                'tgl_trs' => $request->chart_tgl_trs,
                'layanan' => $request->chart_layanan,
                'kd_reg' => $request->chart_kd_reg,
                'mr_pasien' => $request->chart_mr,
                'nm_pasien' => $request->chart_nm_pasien,
                'nm_tarif_dasar' => $request->nm_tarif_dasar,
                // 'nm_dokter_jm' => $request->chart_dokter,
                // 'sub_total' => $request->sub_total,
                'user' => $request->user_create,
            ];
            trs_chart::create($newData);
        }
        // dd($newData);
        DB::commit();
        toastr()->success('Data Tersimpan!');
        return back();
        // return redirect()->route('/tindakan-medis');
        // } catch (\Exception $e) {
        DB::rollback();
        toastr()->error('Gagal Tersimpan! Hubungi Admin');
        return back();
    }
}
