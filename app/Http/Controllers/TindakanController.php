<?php

namespace App\Http\Controllers;

use App\Models\ChartTindakan;
use App\Models\mstr_dokter;
use App\Models\mstr_icdx;
use App\Models\mstr_obat;
use App\Models\mstr_tindakan;
use App\Models\registrasiCreate;
use App\Models\trs_chart;
use App\Models\trs_chart_resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Carbon;
use Yoeunes\Toastr\Facades\Toastr;
use Carbon\Carbon;

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
        $isRegActive = registrasiCreate::where('fr_tgl_keluar', '=', '')->get();
        $icdx = mstr_icdx::all();
        $isTindakanTarif = mstr_tindakan::all();
        $isHistoryTindakan = trs_chart::all();
        $dateNow = Carbon::now()->format("d-m-Y");

        // $data = response()->json($chart_id);
        // $isLastChartID = $chart_id;
        // dd($dateNow);

        return view('pages.tindakan-medis', [
            'isRegActive' => $isRegActive,
            'isLastChartID' => $chart_id,
            'isTindakanChart' => $isTindakanChart,
            'icdx' => $icdx,
            'isTindakanTarif' => $isTindakanTarif,
            'kd_trs' => $kd_trs,
            'isHistoryTindakan' => $isHistoryTindakan,
            'dateNow' => $dateNow,
        ]);
        // return response()->json($chart_id);
    }

    public function obatSearchCH(Request $request)
    {
        $isdataObat = [];

        if ($request->filled('q')) {
            $isdataObat = mstr_obat::select("fm_kd_obat", "fm_nm_obat", "fm_satuan_pembelian", "fm_hrg_beli")
                ->where('fm_nm_obat', 'LIKE', '%' . $request->get('q') . '%')
                ->get();
        }
        // dd($data);
        return response()->json($isdataObat);
    }

    public function getObatListCH(request $obat)
    {
        // $true = 'Amoxcillin 500mg';
        $isdataObatList = mstr_obat::where('fm_kd_obat', $obat->fm_kd_obat)->get();

        // dd($isdata2);
        return response()->json($isdataObatList);
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
        // $yes = $request->all();
        // dd($yes);

        $request->validate([
            // 'user' => 'required',
            'chart_id' => 'required',
            // 'chart_tgl_trs' => 'required',
            'chart_kd_reg' => 'required',
            'chart_mr' => 'required',
            'chart_nm_pasien' => 'required',
            'chart_layanan' => 'required',
            'chart_dokter' => 'required',
            'user_create' => 'required',
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
        };

        if ($request->ch_kd_obat != null) {
            foreach ($request->ch_kd_obat as $far => $val) {
                $newDataResep = [
                    'kd_trs' => $request->kd_trs,
                    'chart_id' => $request->chart_id,
                    'layanan' => $request->chart_layanan,
                    'tgl_trs' => $request->chart_tgl_trs,
                    'kd_reg' => $request->chart_kd_reg,
                    'mr_pasien' => $request->chart_mr,
                    'nm_pasien' => $request->chart_nm_pasien,

                    'ch_kd_obat' => $request->ch_kd_obat[$far],
                    'ch_nm_obat' => $request->ch_nm_obat[$far],
                    'ch_qty_obat' => $request->ch_qty_obat[$far],
                    'ch_satuan_obat' => $request->ch_satuan_obat[$far],
                    'ch_signa' => $request->ch_signa[$far],
                    'ch_cara_pakai' => $request->ch_cara_pakai[$far],
                    'ch_hrg_jual' => $request->ch_hrg_jual[$far],
                ];
                trs_chart_resep::create($newDataResep);
            };
        } else {
        }
        // dd($newData);
        DB::commit();
        // Toastr::success('Create new Estimates successfully :)', 'Success');
        // return redirect()->route('tindakan-medis')->toastr()->success('Data Tersimpan!');
        toastr()->success('Data Tersimpan!');
        return back();
        // return redirect()->route('/tindakan-medis');
        // } catch (\Exception $e) {
        DB::rollback();
        toastr()->error('Gagal Tersimpan! Hubungi Admin');
        return back();
        // Toastr::error('Add Estimates fail :)', 'Error');
        // return redirect()->back();
        // return redirect()->route('tindakan-mediss')
        //     ->with('warning', 'Something Went Wrong!');
        // }
    }

    // get timeline pemeriksaan
    public function getTimeline(Request $request)
    {
        $isTimelineHistory = ChartTindakan::with('trstdk.nm_trf', 'resep')
            ->where('chart_mr', $request->chart_mr)
            // ->distinct()
            ->orderBy('chart_tindakan.created_at', 'DESC')
            // ->groupBy('chart_tindakan.chart_id')
            ->get();

        // $isTimelineHistory = DB::table('chart_tindakan')
        //     ->select('chart_tindakan.*', 'mstr_tindakan.nm_tindakan')
        //     ->leftJoin('trs_chart', 'chart_tindakan.chart_id', 'trs_chart.chart_id')
        //     ->leftJoin('mstr_tindakan', 'mstr_tindakan.id', 'trs_chart.nm_tarif')
        //     // ->select('chart_tindakan.*')
        //     ->where('chart_tindakan.chart_mr', $request->chart_mr)
        //     ->orderBy('chart_tindakan.created_at', 'DESC')
        //     // ->groupBy('chart_tindakan.chart_mr')
        //     ->get();

        return response()->json($isTimelineHistory);
    }

    // Get ChartID utk Edit
    public function chartIdSearch(Request $request)
    {
        $isChartID = ChartTindakan::with('trstdk.nm_trf')
            ->where('chart_mr', $request->chart_mr)
            // ->distinct()
            ->orderBy('chart_tindakan.created_at', 'DESC')
            // ->groupBy('chart_tindakan.chart_id')
            ->get();

        return response()->json($isChartID);
    }
}
