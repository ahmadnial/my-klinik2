<?php

namespace App\Http\Controllers;

use App\Models\rekening_pendapatan_poliklinik_total;
use App\Models\ta_registrasi_keluar;
use App\Models\registrasiCreate;
use App\Models\trs_chart;
use App\Models\trs_kasir_poliklinik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Contracts\Service\Attribute\Required;

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
        $getTrsTdk = registrasiCreate::select('fr_kd_reg', 'fr_nama')->where('fr_tgl_keluar', '=', '')->get();
        $dateNow = Carbon::now()->format("Y-m-d");

        return view('pages.kasir-poliklinik', [
            'noReff' => $noRef,
            'isTrsTdk' => $getTrsTdk,
            'dateNow' => $dateNow,
            'getListRegOut' => $getListRegOut
        ]);
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
            $newrekening1->rk_layanan    = $request->trs_kp_layanan;
            $newrekening1->rk_nilai    = $request->trs_kp_nilai_total;
            $newrekening1->save();

            DB::table('ta_registrasi')->where('fr_kd_reg', $request->trs_kp_kd_reg)->update([
                'fr_tgl_keluar' => $request->trs_kp_tgl_keluar,
            ]);

            DB::table('tc_mr')->where('fs_mr', $request->trs_kp_no_mr)->update([
                'fs_last_tarif_dasar' => $request->nm_tarif_dasar,
                'fs_tgl_kunjungan_terakhir' => $request->trs_kp_tgl_keluar,
            ]);

            DB::commit();
            toastr()->success('Data Tersimpan!');
            return back();
            // return redirect()->route('/tindakan-medis');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Gagal Tersimpan! Hubungi Admin');
            return back();
        }
    }
}
