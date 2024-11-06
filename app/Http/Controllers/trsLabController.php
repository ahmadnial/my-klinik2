<?php

namespace App\Http\Controllers;

use App\Models\registrasiCreate;
use App\Models\trs_lab_detail;
use App\Models\trs_lab_hdr;
use App\Models\trs_order_lab;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class trsLabController extends Controller
{
    public function pemeriksaanLab()
    {
        $dateNow = Carbon::now()->format('Y-m-d');

        $listOrderLab = trs_order_lab::select('kd_trs', 'chart_id', 'kd_reg', 'mr_pasien', 'nm_pasien', 'jns_kelamin')->distinct()->where('isImplementasi', '=', '0')->get();
        return view('pages.laborat.pemeriksaan-lab', ['isListOrderLabs' => $listOrderLab, 'dateNow' => $dateNow]);
    }

    public function getListOrderLab(Request $request)
    {
        $tl_jenis_kelamin = $request->tl_jenis_kelamin;
        if ($tl_jenis_kelamin == 'Perempuan') {
            $isListOrderLab = DB::table('trs_order_lab')
                ->leftJoin('tc_mr', 'trs_order_lab.mr_pasien', 'tc_mr.fs_mr')
                ->leftJoin('tarif_lab_hdr', 'trs_order_lab.kd_lab', 'tarif_lab_hdr.kd_tarif')
                ->leftJoin('tarif_lab_detail', 'trs_order_lab.kd_lab', 'tarif_lab_detail.kd_tarif')
                ->select('trs_order_lab.*', 'tc_mr.*', 'tarif_lab_hdr.nilai_tarif', 'tarif_lab_detail.*')
                // ->distinct()
                ->where('trs_order_lab.kd_trs', $request->kd_trs)
                ->where('tarif_lab_detail.jenis_kelamin', '=', 'Wanita')
                ->where('isimplementasi', '=', '0')
                ->get();
        } elseif ($tl_jenis_kelamin == 'Laki-laki') {
            $isListOrderLab = DB::table('trs_order_lab')
                ->leftJoin('tc_mr', 'trs_order_lab.mr_pasien', 'tc_mr.fs_mr')
                ->leftJoin('tarif_lab_hdr', 'trs_order_lab.kd_lab', 'tarif_lab_hdr.kd_tarif')
                ->leftJoin('tarif_lab_detail', 'trs_order_lab.kd_lab', 'tarif_lab_detail.kd_tarif')
                ->select('trs_order_lab.*', 'tc_mr.*', 'tarif_lab_hdr.nilai_tarif', 'tarif_lab_detail.*')
                // ->distinct()
                ->where('trs_order_lab.kd_trs', $request->kd_trs)
                ->where('tarif_lab_detail.jenis_kelamin', '=', 'Pria')
                ->where('isimplementasi', '=', '0')
                ->get();
        }

        // $isListOrderLab = trs_order_lab::with('detailOrder')
        // ->leftJoin('tc_mr', 'trs_order_lab.mr_pasien', 'tc_mr.fs_mr')
        //  ->select('trs_order_lab.*', 'tc_mr.*', 'tarif_lab_hdr.nilai_tarif', 'tarif_lab_detail.*')
        // ->distinct()
        // ->where('trs_order_lab.kd_trs', $kd_trs->kd_trs)
        // ->where('isimplementasi', '=', '0')
        // ->get();
        return response()->json($isListOrderLab);
    }

    public function inserttrsLab(Request $request)
    {
        // dd($request->all());
        $num = str_pad(000001, 6, 0, STR_PAD_LEFT);
        $Y = date('Y');
        $M = date('m');
        $cekid = trs_lab_hdr::count();
        if ($cekid == 0) {
            $noRef = 'LB' . '-' . substr($Y, -2) . $M . '-' . $num;
        } else {
            $continue = trs_lab_hdr::all()->last();
            $de = substr($continue->kd_trs, -6);
            $noRef = 'LB' . '-' . substr($Y, -2) . $M . '-' . str_pad($de + 1, 6, '0', STR_PAD_LEFT);
        }

        $request->validate([
            'tgl_trs' => 'required',
            'tl_no_mr' => 'required',
            'tl_kd_reg' => 'required',
        ]);

        DB::beginTransaction();

        $trsHdr = [
            'kd_trs' => $noRef,
            'tl_kd_reg' => $request->tl_kd_reg,
            'tl_tgl_trs' => $request->tgl_trs,
            'tl_layanan' => $request->tl_layanan,
            'tl_dokter_pengirim' => $request->tl_dokter,
            'tl_no_mr' => $request->tl_no_mr,
            'tl_nama' => $request->tl_nama,
            'tl_alamat' => $request->tl_alamat,
            'tl_jenis_kelamin' => $request->tl_jns_kel,
            'tl_tgl_lahir' => $request->tl_tgl_lahir,
            'user' => Auth::user()->name,
            'isVerifikasi' => '0',
            'tl_total_tarif' => $request->tl_total_tarif,
        ];
        trs_lab_hdr::create($trsHdr);

        foreach ($request->kd_tarif as $key => $xf) {
            $trsDetail = [
                'kd_trs' => $noRef,
                'kd_reg' => $request->tl_kd_reg,
                'tl_tgl_trs' => $request->tgl_trs,
                'kd_tarif' => $request->x[$key],
                'nm_tarif' => $request->nm_tarif[$key],
                'hasil' => $request->hasil[$key],
                'satuan_hasil' => $request->satuan_hasil[$key],
                'nilai_rujukan_normal' => $request->nilai_rujukan_normal[$key],
                'sub_total' => $request->x[$key],
                'user' => Auth::user()->name,
                'isVerifikasi' => '0',
            ];
            trs_lab_detail::create($trsDetail);

            DB::commit();

            $sessionFlash = [
                'message' => 'Saved!',
                'alert-type' => 'success',
            ];

            return Redirect::to('/pemeriksaan-lab')->with($sessionFlash);
            // } catch (\Exception $e) {
            DB::rollback();

            $sessionFlashErr = [
                'message' => 'Error!',
                'alert-type' => 'error',
            ];
            return Redirect::to('/pemeriksaan-lab')->with($sessionFlashErr);
        }
    }
}
