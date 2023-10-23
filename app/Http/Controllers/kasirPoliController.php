<?php

namespace App\Http\Controllers;

use App\Models\rekening_pendapatan_poliklinik_total;
use App\Models\ta_registrasi_keluar;
use App\Models\trs_chart;
use App\Models\trs_kasir_poliklinik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Symfony\Contracts\Service\Attribute\Required;

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
        // try {
        if ($request->trs_kp_nm_tarif == null) {
            $newrgout = new ta_registrasi_keluar();
            $newrgout->kd_trs_reg_out = $request->kd_trs_reg_out;
            $newrgout->trs_kp_kd_reg = $request->trs_kp_kd_reg;
            $newrgout->trs_kp_tgl_keluar  = $request->trs_kp_tgl_keluar;
            $newrgout->trs_kp_nm_pasien    = $request->trs_kp_nm_pasien;
            $newrgout->trs_kp_no_mr = $request->trs_kp_no_mr;
            $newrgout->trs_kp_layanan = $request->trs_kp_layanan;
            $newrgout->trs_kp_dokter = $request->trs_kp_dokter;
            $newrgout->user   = $request->user_create;
            $newrgout->nm_tarif_dasar = $request->nm_tarif_dasar;
            $newrgout->trs_kp_nilai_total = $request->trs_kp_nilai_total;
            $newrgout->chart_A    = $request->chart_A;
            $newrgout->chart_A_diagnosa = $request->chart_A_diagnosa;
            $newrgout->chart_P = $request->chart_P;
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
                $newrgout->user   = $request->user_create;
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
        $newrekening1->rk_layanan    = $request->trs_kp_layanan;
        $newrekening1->rk_nilai    = $request->trs_kp_nilai_total;
        $newrekening1->save();
        // if ($request->nm_tarif != null) {
        //     foreach ($request->nm_tarif as $key => $val) {
        //         $newData = [
        //             'kd_trs' => $request->kd_trs,
        //             'chart_id' => $request->chart_id,
        //             'tgl_trs' => $request->chart_tgl_trs,
        //             'layanan' => $request->chart_layanan,
        //             'kd_reg' => $request->chart_kd_reg,
        //             'mr_pasien' => $request->chart_mr,
        //             'nm_pasien' => $request->chart_nm_pasien,
        //             'nm_tarif' => $request->nm_tarif[$key],
        //             'nm_tarif_dasar' => $request->nm_tarif_dasar,
        //             'nm_dokter_jm' => $request->chart_dokter,
        //             'sub_total' => $request->sub_total,
        //             'user' => $request->user_create,
        //         ];
        //         trs_chart::create($newData);
        //     };
        // } else {
        //     $newData = [
        //         'kd_trs' => $request->kd_trs,
        //         'chart_id' => $request->chart_id,
        //         'tgl_trs' => $request->chart_tgl_trs,
        //         'layanan' => $request->chart_layanan,
        //         'kd_reg' => $request->chart_kd_reg,
        //         'mr_pasien' => $request->chart_mr,
        //         'nm_pasien' => $request->chart_nm_pasien,
        //         'nm_tarif_dasar' => $request->nm_tarif_dasar,
        //         // 'nm_dokter_jm' => $request->chart_dokter,
        //         // 'sub_total' => $request->sub_total,
        //         'user' => $request->user_create,
        //     ];
        //     trs_chart::create($newData);
        // }
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
