<?php

namespace App\Http\Controllers;

use App\Models\ChartTindakan;
use App\Models\mstr_dokter;
use App\Models\mstr_icdx;
use App\Models\mstr_tindakan;
use App\Models\registrasiCreate;
use App\Models\trs_chart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TindakanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function tindakanMedis(Request $request)
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

        // kd_chart
        $idc = str_pad(00000001, 8, 0, STR_PAD_LEFT);
        $vardate = date("m");
        $cekidc = trs_chart::count();
        if ($cekidc == 0) {
            $kd_trs =  'TU' . '-' . $vardate . $idc;
        } else {
            $continue = trs_chart::all()->last();
            $dec = substr($continue->kd_trs, -3);
            $kd_trs = 'TU' . '-' . $vardate . str_pad(($dec + 1), 8, '0', STR_PAD_LEFT);
        };
        $isTindakanChart = ChartTindakan::where('chart_mr', '=', $request)->get();
        $isRegActive = registrasiCreate::all();
        $icdx = mstr_icdx::all();
        $isTindakanTarif = mstr_tindakan::all();
        $isHistoryTindakan = trs_chart::all();

        // $data = response()->json($chart_id);
        // $isLastChartID = $chart_id;


        return view('pages.tindakan-medis', [
            'isRegActive' => $isRegActive,
            'isLastChartID' => $chart_id,
            'isTindakanChart' => $isTindakanChart,
            'icdx' => $icdx,
            'isTindakanTarif' => $isTindakanTarif,
            'kd_trs' => $kd_trs,
            'isHistoryTindakan' => $isHistoryTindakan,
        ]);
        // return response()->json($chart_id);
    }

    // public function getLastID()
    // {
    //     $id = str_pad(00000001, 8, 0, STR_PAD_LEFT);
    //     $vardate = date("Y-m");
    //     $cekid = ChartTindakan::count();
    //     if ($cekid == 0) {
    //         $chart_id =  'CH' . '-' . $vardate . $id;
    //     } else {
    //         $continue = ChartTindakan::all()->last();
    //         $de = substr($continue->chart_id, -3);
    //         $chart_id = 'CH' . '-' . $vardate . str_pad(($de + 1), 8, '0', STR_PAD_LEFT);
    //     };
    //     return response()->json($chart_id);
    //     // return view('pages.tindakan-medis', ['chart_id' => $chart_id]);
    //     // $isLastChartID = json_decode($data);

    //     // return view('pages.tindakan-medis', ['isLastChartID' => $isLastChartID]);
    // }

    // public function getTimeline(Request $request)
    // {
    //     $isTindakanChart = ChartTindakan::where('chart_mr', '=', $request)->get();

    //     return view('pages.tindakan-medis', ['isTindakanChart' => $isTindakanChart]);
    // }


    // public function getLastID()
    // {
    //     $id = str_pad(00000001, 8, 0, STR_PAD_LEFT);
    //     $vardate = date("Y-m");
    //     $cekid = ChartTindakan::count();
    //     if ($cekid == 0) {
    //         $chart_id =  'CH' . '-' . $vardate . $id;
    //     } else {
    //         $continue = ChartTindakan::all()->last();
    //         $de = substr($continue->chart_id, -3);
    //         $chart_id = 'CH' . '-' . $vardate . str_pad(($de + 1), 8, '0', STR_PAD_LEFT);
    //     };

    //     return response()->json($chart_id);
    // }

    public function registerSearch(Request $request)
    {
        $isRegSearch = registrasiCreate::where('fr_kd_reg', $request->fr_kd_reg)->get();

        return response()->json($isRegSearch);
    }


    public function chartCreate(Request $request)
    {
        $yes = $request->all();
        dd($yes);

        $request->validate([
            // 'user' => 'required',
            // 'chart_id' => 'required',
            // // 'chart_tgl_trs' => 'required',
            // 'chart_kd_reg' => 'required',
            // 'chart_mr' => 'required',
            // 'chart_nm_pasien' => 'required',
            // 'chart_layanan' => 'required',
            // 'chart_dokter' => 'required',
            // 'user' => 'required',
            // 'kd_trs' => 'required',
            // 'tgl_trs' => 'required',
            // 'layanan' => 'required',
            // 'kd_reg' => 'required',
            // 'mr_pasien' => 'required',
            // 'nm_pasien' => 'required',
            // 'nm_tarif' => 'required',
            // 'nm_dokter_jm' => 'required',
            // // 'sub_total' => 'required',
            // 'user' => 'required',
            // 'chart_S',
            // 'chart_O',
            // 'chart_A',
            // 'chart_A_diagnosa',
            // 'chart_P',
            // 'chart_P_resep',
            // 'chart_P_tindakan'
        ]);
        DB::beginTransaction();
        // try {

        $nerChart = new ChartTindakan;
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

        if (count($request->nm_tarif) > 0) {
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
                    'nm_dokter_jm' => $request->chart_dokter,
                    'sub_total' => $request->sub_total,
                    'user' => $request->user_create,
                ];
                trs_chart::create($newData);
            };
        }
        // dd($newData);
        DB::commit();
        // Toastr::success('Create new Estimates successfully :)', 'Success');
        return redirect()->route('tindakan-medis')->with('success', 'Thank You');
        // return redirect()->route('/tindakan-medis');
        // } catch (\Exception $e) {
        DB::rollback();
        // Toastr::error('Add Estimates fail :)', 'Error');
        // return redirect()->back();
        return redirect()->route('tindakan-mediss')
            ->with('warning', 'Something Went Wrong!');
        // }
    }

    public function getTimeline(Request $request)
    {
        // $isTimelineHistory = ChartTindakan::where('chart_mr', $request->chart_mr)->latest()->get();

        $isTimelineHistory = DB::table('chart_tindakan')
            ->leftJoin('trs_chart', 'chart_tindakan.chart_id', 'trs_chart.chart_id')
            ->select('chart_tindakan.*', 'trs_chart.*')
            ->where('chart_tindakan.chart_mr', $request->chart_mr)
            ->orderBy('chart_tindakan.created_at', 'DESC')
            ->get();

        return response()->json($isTimelineHistory);
    }
}
