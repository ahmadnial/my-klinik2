<?php

namespace App\Http\Controllers;

use App\Models\rekening_pendapatan_poliklinik_total;
use App\Models\ta_registrasi_keluar;
use App\Models\registrasiCreate;
use App\Models\ta_registrasi_keluar_hdr;
use App\Models\trs_chart;
use App\Models\trs_kasir_poliklinik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Contracts\Service\Attribute\Required;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Redirect;

class kasirPoliController extends Controller
{

    public function kasirPoli()
    {
        $num = str_pad(000001, 6, 0, STR_PAD_LEFT);
        $Y = date("Y");
        $M = date("m");
        $cekid = ta_registrasi_keluar::count();
        if ($cekid == 0) {
            $noRef =  'RO'  . '-' . substr($Y, -2) . $M . '-' . $num;
        } else {
            $continue = ta_registrasi_keluar::all()->last();
            $de = substr($continue->kd_trs_reg_out, -6);
            $noRef = 'RO' . '-' . substr($Y, -2) . $M  . '-' . str_pad(($de + 1), 6, '0', STR_PAD_LEFT);
        };

        $getListRegOut = DB::table('ta_registrasi_keluar')
            ->select('kd_trs_reg_out', 'trs_kp_kd_reg', 'trs_kp_tgl_keluar', 'trs_kp_no_mr', 'trs_kp_nm_pasien', 'trs_kp_layanan', 'trs_kp_dokter', 'trs_kp_nilai_total')
            ->distinct()
            ->get();
        $getTrsTdk = registrasiCreate::select('fr_kd_reg', 'fr_nama', 'fr_session_poli')->where('fr_tgl_keluar', '=', '')->get();
        $dateNow = Carbon::now()->format("Y-m-d");

        return view('pages.kasir-poliklinik', [
            'noReff' => $noRef,
            'isTrsTdk' => $getTrsTdk,
            'dateNow' => $dateNow,
            'getListRegOut' => $getListRegOut
        ]);
    }

    public function getMonthRegOut(Request $request)
    {
        // $today = Carbon::today()->toDateString();
        $selectMonth = $request->dataBulan;
        // dd($selectMonth);
        if (!$selectMonth) {
            $monthNow = Carbon::now()->format("m");
            $yearNow = Carbon::now()->format("Y");
            $isListPenjualan = ta_registrasi_keluar_hdr::whereyear('kp_tgl_keluar', '=', $yearNow)->whereMonth('kp_tgl_keluar', '=', $monthNow)->latest('kp_tgl_keluar')->distinct();
        } else {
            $isListPenjualan = ta_registrasi_keluar_hdr::where('kp_tgl_keluar', 'LIKE', '%' . $selectMonth . '%')->latest('created_at')->distinct();
        }

        return DataTables::of($isListPenjualan)
            ->addColumn('action', function ($row) {
                // $today = Carbon::today()->toDateString();
                // if ($row->tgl_trs == $today) {
                $actionBtn = '
                <button class="btn btn-xs btn-primary" data-toggle="modal" data-target=""
                onclick="EditTrs(this);" data-kd_trsu="' . $row->kd_trs_reg_out . '"><i class="fa fa-edit"></i></button>
                <button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#EditObat"
                onclick="cetakNota(this)" data-kd_trsc="' . $row->kd_trs_reg_out . '" target="_blank"> <i class="fa fa-print"></i> </button>
                 <button class="btn btn-xs btn-danger" data-toggle="modal" data-target=""
                
                ';
                // } else {
                //     $actionBtn = '
                // <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#EditObat"
                // onclick="getDetailPen(this)" data-kd_trs="' . $row->kd_trs_reg_out . '">&nbsp;&nbsp;<i class="fa fa-info">&nbsp;&nbsp;</i></button>
                // <button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#EditObat"
                // onclick="cetakNota(this)" data-kd_trsc="' . $row->kd_trs_reg_out . '" target="_blank"> <i class="fa fa-print"></i> </button>
                // ';
                // }

                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function xregisterSearch(Request $request)
    {
        // $isRegSearchResult = trs_chart::distinct('kd_reg')->where('kd_reg', $request->kd_reg)->get();
        // $isRegSearchResult = DB::table('trs_chart')->select('*')->where('kd_reg', $request->kd_reg)->groupBy('kd_reg')->get();


        $isRegSearchResult = DB::table('trs_chart')
            ->leftJoin('mstr_tindakan', 'mstr_tindakan.id', 'trs_chart.nm_tarif')
            ->leftJoin('ta_registrasi', 'ta_registrasi.fr_kd_reg', 'trs_chart.kd_reg')
            ->leftJoin('mstr_nilai_tindakan', 'mstr_tindakan.id', 'mstr_nilai_tindakan.id_tindakan')
            ->select('trs_chart.*', 'mstr_tindakan.*', 'mstr_nilai_tindakan.*', 'fr_session_poli')
            // ->groupBy('trs_chart.kd_reg')
            ->where('trs_chart.kd_reg', $request->kd_reg)
            // ->where('nm_tarif', '!=', '')
            // ->whereNull('nm_tarif')
            // ->orwherenotNull('trs_chart.nm_tarif')
            // ->having('trs_chart.kd_reg', '>', 1)
            ->get();
        // dd($isRegSearchResult);
        // , DB::raw('count(`kd_reg`) as kr')
        return response()->json($isRegSearchResult);
    }


    public function regOut(Request $request)
    {
        // $yes = $request->all();
        // dd($yes);

        $request->validate([
            // 'kd_trs_reg_out' => 'Required',
            'trs_kp_kd_reg' => 'Required',
            'trs_kp_tgl_keluar' => 'Required',
            'trs_kp_nm_pasien' => 'Required',
            'trs_kp_no_mr' => 'Required',
            'trs_kp_layanan' => 'Required',
            'trs_kp_dokter' => 'Required',
            'nm_tarif_dasar' => 'Required',
            // 'user',
            'trs_kp_nilai_total' => 'Required'

        ]);
        DB::beginTransaction();
        try {

            $newregouthdr = new ta_registrasi_keluar_hdr();
            $newregouthdr->kd_trs_reg_out = $request->kd_trs_reg_out;
            $newregouthdr->kp_kd_reg = $request->trs_kp_kd_reg;
            $newregouthdr->kp_tgl_keluar  = $request->trs_kp_tgl_keluar;
            $newregouthdr->kp_nm_pasien  = $request->trs_kp_nm_pasien;
            $newregouthdr->kp_no_mr  = $request->trs_kp_no_mr;
            $newregouthdr->kp_layanan    = $request->trs_kp_layanan;
            $newregouthdr->kp_dokter    = $request->trs_kp_dokter;
            $newregouthdr->nm_tarif_dasar = $request->nm_tarif_dasar;
            $newregouthdr->kp_nilai_total    = $request->trs_kp_nilai_total;
            $newregouthdr->user    = Auth::user()->name;
            $newregouthdr->save();

            if ($request->trs_kp_nm_tarif == null) {
                $newrgout = new ta_registrasi_keluar();
                $newrgout->kd_trs_reg_out = $request->kd_trs_reg_out;
                $newrgout->trs_kp_kd_reg = $request->trs_kp_kd_reg;
                $newrgout->trs_kp_tgl_keluar  = $request->trs_kp_tgl_keluar;
                $newrgout->trs_kp_nm_pasien    = $request->trs_kp_nm_pasien;
                $newrgout->trs_kp_no_mr = $request->trs_kp_no_mr;
                $newrgout->trs_kp_layanan = $request->trs_kp_layanan;
                $newrgout->trs_kp_dokter = $request->trs_kp_dokter;
                $newrgout->user   = Auth::user()->name;
                $newrgout->nm_tarif_dasar = $request->nm_tarif_dasar;
                $newrgout->trs_kp_nilai_total = $request->trs_kp_nilai_total;
                // $newrgout->chart_A    = $request->chart_A;
                // $newrgout->chart_A_diagnosa = $request->chart_A_diagnosa;
                // $newrgout->chart_P = $request->chart_P;
                $newrgout->save();
            } else {
                foreach ($request->trs_kp_nm_tarif as $key => $val) {
                    $newrgout = new ta_registrasi_keluar();
                    $newrgout->kd_trs_reg_out = $request->kd_trs_reg_out;
                    $newrgout->trs_kp_kd_reg = $request->trs_kp_kd_reg;
                    $newrgout->trs_kp_tgl_keluar  = $request->trs_kp_tgl_keluar;
                    $newrgout->trs_kp_nm_pasien    = $request->trs_kp_nm_pasien;
                    $newrgout->trs_kp_no_mr = $request->trs_kp_no_mr;
                    $newrgout->trs_kp_layanan = $request->trs_kp_layanan;
                    $newrgout->trs_kp_dokter = $request->trs_kp_dokter;
                    $newrgout->user   = Auth::user()->name;
                    $newrgout->nm_tarif_dasar = $request->nm_tarif_dasar;
                    $newrgout->trs_kp_kd_trs_chart = $request->trs_kp_kd_trs_chart[$key];
                    $newrgout->trs_kp_nm_tarif = $request->trs_kp_nm_tarif[$key];
                    $newrgout->trs_kp_nilai_tarif = $request->trs_kp_nilai_tarif[$key];
                    $newrgout->trs_kp_nilai_total = $request->trs_kp_nilai_total;
                    $newrgout->save();
                }
            }

            $newrekening1 = new rekening_pendapatan_poliklinik_total();
            $newrekening1->rk_kd_reg = $request->trs_kp_kd_reg;
            $newrekening1->rk_tgl_regout = $request->trs_kp_tgl_keluar;
            $newrekening1->rk_no_mr  = $request->trs_kp_no_mr;
            $newrekening1->rk_pasienName  = $request->trs_kp_nm_pasien;
            $newrekening1->rk_dokter  = $request->trs_kp_dokter;
            $newrekening1->rk_layanan    = $request->trs_kp_layanan;
            $newrekening1->rk_nilai    = $request->trs_kp_nilai_total;
            $newrekening1->rk_session_poli    = $request->session_poli;
            $newrekening1->save();

            DB::table('ta_registrasi')->where('fr_kd_reg', $request->trs_kp_kd_reg)->update([
                'fr_tgl_keluar' => $request->trs_kp_tgl_keluar,
            ]);

            DB::table('tc_mr')->where('fs_mr', $request->trs_kp_no_mr)->update([
                'fs_last_tarif_dasar' => $request->nm_tarif_dasar,
                'fs_tgl_kunjungan_terakhir' => $request->trs_kp_tgl_keluar,
            ]);

            DB::commit();

            $sessionFlash = [
                'message' => 'Saved!',
                'alert-type' => 'success'
            ];

            return Redirect::to('/kasir-poli')->with($sessionFlash);
            // toastr()->success('Saved!');
            // return back();

        } catch (\Exception $e) {
            DB::rollback();

            $sessionFlashErr = [
                'message' => 'Error!',
                'alert-type' => 'error'
            ];
            return Redirect::to('/kasir-poli')->with($sessionFlashErr);
            // toastr()->error('Some Error Occured!');
            // return back();
        }
    }

    public function getDetailRegOut(Request $request)
    {
        // $isDataRegOut = ta_registrasi_keluar::where('ta_registrasi_keluar.kd_trs_reg_out', '=', $request->kd_trs)
        //     ->leftJoin('trs_chart', 'ta_registrasi_keluar.trs_kp_kd_trs_chart', 'trs_chart.kd_trs')
        //     ->get();

        $isDataRegOut = ta_registrasi_keluar_hdr::with('regoutDetail')
            ->where('kd_trs_reg_out', '=', $request->kd_trs)
            // ->leftJoin('trs_chart', 'ta_registrasi_keluar.trs_kp_kd_trs_chart', 'trs_chart.kd_trs')
            ->get();

        // $isChartID = ChartTindakan::with('trstdk.nm_trf')
        // ->where('chart_id', $request->chartid)
        // ->get();

        return response()->json($isDataRegOut);
    }

    public function EditRegout(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'trs_kp_kd_regE' => 'Required',
            'trs_kp_tgl_keluarE' => 'Required',
            // 'trs_kp_nm_pasienE' => 'Required',
            // 'trs_kp_no_mrE' => 'Required',
            // 'trs_kp_layananE' => 'Required',
            // 'trs_kp_dokterE' => 'Required',
            'nm_tarif_dasarE' => 'Required',
            'trs_kp_nilai_totalE' => 'Required'

        ]);

        DB::beginTransaction();
        try {
            DB::table('ta_registrasi_keluar_hdr')->where('kd_trs_reg_out', $request->kd_trs_reg_outE)->update([
                'nm_tarif_dasar' => $request->nm_tarif_dasarE,
                'kp_nilai_total' => $request->trs_kp_nilai_totalE,
                'user' => Auth::user()->name
            ]);

            if ($request->trs_kp_kd_trs_chart != null) {
                DB::table('ta_registrasi_keluar')->where('kd_trs_reg_out', $request->kd_trs_reg_outE)->update([
                    'nm_tarif_dasar' => $request->nm_tarif_dasarE,
                    'trs_kp_nilai_total' => $request->trs_kp_nilai_totalE,
                    'user' => Auth::user()->name
                ]);
            }

            DB::table('rekening_pendapatan_poliklinik_total')->where('rk_kd_reg', $request->trs_kp_kd_regE)->update([
                'rk_nilai' => $request->trs_kp_nilai_totalE
                // 'user' => Auth::user()->name
            ]);

            DB::commit();

            $sessionFlash = [
                'message' => 'Saved!',
                'alert-type' => 'success'
            ];

            return Redirect::to('/kasir-poli')->with($sessionFlash);
        } catch (\Exception $e) {
            DB::rollback();

            $sessionFlashErr = [
                'message' => $e,
                'alert-type' => 'error'
            ];
            return Redirect::to('/kasir-poli')->with($sessionFlashErr);
        }
    }
}
