<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\registrasiCreate;
use App\Models\tc_assesment_detail;
use App\Models\tc_assesment_hdr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AssesmentController extends Controller
{

    public function assAwal()
    {
        $id = str_pad(00000001, 8, 0, STR_PAD_LEFT);
        $vardate = date("ym");
        $cekid = tc_assesment_hdr::count();
        if ($cekid == 0) {
            $ass_id =  'AS' . '-' . $vardate . '-' . $id;
        } else {
            $continue = tc_assesment_hdr::all()->last();
            $de = substr($continue->assId, -3);
            $ass_id = 'AS' . '-' . $vardate . '-' . str_pad(($de + 1), 8, '0', STR_PAD_LEFT);
        };
        $isRegActive = registrasiCreate::where('fr_tgl_keluar', '=', '')->get();
        $dateNow = Carbon::now()->format("Y-m-d");
        $timeNow = Carbon::now()->format("H:i:s");
        // $timeNow = Carbon::now();
        // $timeNow->toTimeString(); //14:15:16
        // dd($timeNow);
        return view('Pages.assesment-awal', [
            'isRegActive' => $isRegActive,
            'dateNow' => $dateNow,
            'timeNow' => $timeNow,
            'ass_id' => $ass_id
        ]);
    }

    public function getLabelAssHdr(Request $request)
    {
        $isLabelAssHdr = tc_assesment_hdr::where('noMr', $request->noMr)->get();

        return response()->json($isLabelAssHdr);
    }

    public function getAssDetail(Request $request)
    {
        $isAssDetail = tc_assesment_detail::where('AssId', $request->assId)->get();

        return response()->json($isAssDetail);
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
        // dd($request->all());
        $request->validate([
            'tglTrs' => 'required',
            'jamTrs' => 'required',
            'kdReg' => 'required',
            'noMr' => 'required',
            'pasienName' => 'required',
            'jeniskelamin' => 'required',
            'dokter' => 'required',
            'layanan' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $newAssesmentHdr = new tc_assesment_hdr;
            $newAssesmentHdr->assId = $request->assId;
            $newAssesmentHdr->assLabel = 'Assesment Medis';
            $newAssesmentHdr->tglTrs = $request->tglTrs;
            $newAssesmentHdr->jamTrs  = $request->jamTrs;
            $newAssesmentHdr->kdReg    = $request->kdReg;
            $newAssesmentHdr->noMr = $request->noMr;
            $newAssesmentHdr->pasienName = $request->pasienName;
            $newAssesmentHdr->jeniskelamin = $request->jeniskelamin;
            $newAssesmentHdr->dokter = $request->dokter;
            $newAssesmentHdr->layanan = $request->layanan;
            $newAssesmentHdr->user   = Auth::user()->name;
            $newAssesmentHdr->save();

            $assesmentBody = [
                'assId'  => $request->assId,
                'tglTrs'  => $request->tglTrs,
                'jamTrs'  => $request->jamTrs,
                'kdReg'  => $request->kdReg,
                'noMr'  => $request->noMr,
                'user'  => Auth::user()->name,
                'fs_keluhan_utama' => $request->fs_keluhan_utama,
                'fs_anamnesis' => $request->fs_anamnesis,
                'fs_rwyt_penyakit' => $request->fs_rwyt_penyakit,
                'fs_rwyt_skt_klrg' => $request->fs_rwyt_skt_klrg,
                'fs_rwyt_obt_sebelum' => $request->fs_rwyt_obt_sebelum,
                'fs_rwyt_alergi_1' => $request->fs_rwyt_alergi_1,
                'fs_rwyt_alergi_2' => $request->fs_rwyt_alergi_2,
                'fs_rwyt_alergi_3' => $request->fs_rwyt_alergi_3,
                'fs_rwyt_alergi_4' => $request->fs_rwyt_alergi_4,
                'fs_gcs_e' => $request->fs_gcs_e,
                'fs_gcs_V' => $request->fs_gcs_V,
                'fs_gcs_m' => $request->fs_gcs_m,
                'fs_td' => $request->fs_td,
                'fs_N_1' => $request->fs_N_1,
                'fs_R_1' => $request->fs_R_1,
                'fs_S_1' => $request->fs_S_1,
                'fs_kepala' => $request->fs_kepala,
                'fs_leher' => $request->fs_leher,
                'fs_thorax' => $request->fs_thorax,
                'fs_abdomen' => $request->fs_abdomen,
                'fs_ekstremitas' => $request->fs_ekstremitas,
                'fs_genetalia' => $request->fs_genetalia,
                'fs_periksa_penunjang' => $request->fs_periksa_penunjang,
                'fs_diag_banding' => $request->fs_diag_banding,
                'fs_diag_kerja' => $request->fs_diag_kerja,
                'fs_mslh_medis' => $request->fs_mslh_medis,
                'fs_instruksi_medis' => $request->fs_instruksi_medis,
                'fs_kontrol_klinik' => $request->fs_kontrol_klinik,
                'fs_rujuk' => $request->fs_rujuk,
                'fs_meninggal' => $request->fs_meninggal,
                'fs_pasien' => $request->fs_pasien,
                'fs_klrg_pasien' => $request->fs_klrg_pasien,
                'fs_tdk_dpt_edu' => $request->fs_tdk_dpt_edu,
                'fd_tgl_ttd' => $request->fd_tgl_ttd,
                'fs_jam_ttd' => $request->fs_jam_ttd,
                'fs_dokter_assessment' => $request->fs_dokter_assessment,
                'fs_dokter_assessment' => $request->fs_dokter_assessment,
            ];
            tc_assesment_detail::create($assesmentBody);

            DB::commit();

            toastr()->success('Saved!');
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Some Error Occured!');
            return back();
        }
    }
}
