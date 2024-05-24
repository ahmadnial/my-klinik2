<?php

namespace App\Http\Controllers;

use App\Models\chart_images;
use App\Models\ChartTindakan;
use App\Models\mstr_dokter;
use App\Models\mstr_icdx;
use App\Models\mstr_obat;
use App\Models\mstr_tindakan;
use App\Models\registrasiCreate;
use App\Models\t_label_detail;
use App\Models\t_label_hdr;
use App\Models\t_label_timeline;
use App\Models\trs_chart;
use App\Models\trs_chart_resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
// use Illuminate\Support\Carbon;
use Yoeunes\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;

class TindakanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function tindakanMedis(Request $request)
    {
        // $id = str_pad(00000001, 8, 0, STR_PAD_LEFT);
        // $vardate = date("Y-m");
        // $cekid = ChartTindakan::count();
        // if ($cekid == 0) {
        //     $chart_id =  'CH' . '-' . $vardate . $id;
        // } else {
        //     $continue = ChartTindakan::all()->last();
        //     $de = substr($continue->chart_id, -7);
        //     // $de = preg_replace('/[^0-9]/', '', $continue->chart_id);
        //     $chart_id = 'CH' . '-' . $vardate . str_pad(($de + 1), 8, '0', STR_PAD_LEFT);
        // };

        // kd_chart
        // $idc = str_pad(00000001, 8, 0, STR_PAD_LEFT);
        // $vardate = date("m");
        // $cekidc = trs_chart::count();
        // if ($cekidc == 0) {
        //     $kd_trs =  'TU' . '-' . $vardate . $idc;
        // } else {
        //     $continue = trs_chart::all()->last();
        //     $dec = substr($continue->kd_trs, -6);
        //     // $kd_trs = 'TU' . '-' . $vardate . str_pad(($dec + 1), 8, '0', STR_PAD_LEFT);
        //     $kd_trs = 'TU' . '-' . $vardate . str_pad(($dec + 1), 8, '0', STR_PAD_LEFT);
        // };
        // dd($continue);
        $isTindakanChart = ChartTindakan::where('chart_mr', '=', $request)->get();

        $isRegActive = registrasiCreate::where([
            ['fr_tgl_keluar', '=', ''],
            ['fr_dokter', '=', Auth::user()->name]
        ])->get();

        $icdx = mstr_icdx::all();
        $isTindakanTarif = mstr_tindakan::all();
        $isHistoryTindakan = trs_chart::all();
        $dateNow = Carbon::now()->format("Y-m-d");

        // $data = response()->json($chart_id);
        // $isLastChartID = $chart_id;
        // dd($kd_trs);

        return view('pages.tindakan-medis', [
            'isRegActive' => $isRegActive,
            // 'isLastChartID' => $chart_id,
            'isTindakanChart' => $isTindakanChart,
            'icdx' => $icdx,
            'isTindakanTarif' => $isTindakanTarif,
            // 'kd_trs' => $kd_trs,
            'isHistoryTindakan' => $isHistoryTindakan,
            'dateNow' => $dateNow,
        ]);
        // return response()->json($chart_id);
    }

    public function obatSearchCH(Request $request)
    {
        $isdataObat = [];

        if ($request->filled('q')) {
            $isdataObat = mstr_obat::select("fm_kd_obat", "fm_nm_obat", "fm_satuan_pembelian", "fm_hrg_beli", "qty", "fm_satuan_jual")
                ->leftJoin('tb_stock', 'mstr_obat.fm_kd_obat', 'tb_stock.kd_obat')
                ->where('mstr_obat.fm_nm_obat', 'LIKE', '%' . $request->get('q') . '%')
                ->where('mstr_obat.isActive', '=', '1')
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
        // $isRegSearch = registrasiCreate::where('fr_kd_reg', $request->fr_kd_reg)->get();
        $isRegSearch = registrasiCreate::with('tcmr')
            ->where('fr_kd_reg', $request->fr_kd_reg)->get();

        //  $isTimelineHistory = ChartTindakan::with('trstdk.nm_trf', 'resep')
        //     ->where('chart_mr', $request->chart_mr)
        return response()->json($isRegSearch);
    }


    public function chartCreate(Request $request)
    {
        // $yes = $request->all();
        // dd($yes);

        $request->validate([
            // 'user' => 'required',
            // 'chart_id' => 'required',
            // 'chart_tgl_trs' => 'required',
            'chart_kd_reg' => 'required',
            'chart_mr' => 'required',
            'chart_nm_pasien' => 'required',
            'chart_layanan' => 'required',
            'chart_dokter' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,pdf|max:10048',
            // 'user_create' => 'required',
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
        $id = str_pad(00000001, 8, 0, STR_PAD_LEFT);
        $vardate = date("Y-m");
        $cekid = ChartTindakan::count();
        if ($cekid == 0) {
            $chartId =  'CH' . '-' . $vardate . $id;
        } else {
            $continue = ChartTindakan::all()->last();
            $de = substr($continue->chart_id, -7);
            // $de = preg_replace('/[^0-9]/', '', $continue->chart_id);
            $chartId = 'CH' . '-' . $vardate . str_pad(($de + 1), 8, '0', STR_PAD_LEFT);
        };

        $idc = str_pad(00000001, 8, 0, STR_PAD_LEFT);
        $vardate = date("m");
        $cekidc = trs_chart::count();
        if ($cekidc == 0) {
            $kd_trs =  'TU' . '-' . $vardate . $idc;
        } else {
            $continue = trs_chart::all()->last();
            $dec = substr($continue->kd_trs, -6);
            // $kd_trs = 'TU' . '-' . $vardate . str_pad(($dec + 1), 8, '0', STR_PAD_LEFT);
            $kd_trs = 'TU' . '-' . $vardate . str_pad(($dec + 1), 8, '0', STR_PAD_LEFT);
        };

        $nerChart = new ChartTindakan;
        $nerChart->chart_id = $chartId;
        $nerChart->chart_tgl_trs = $request->chart_tgl_trs;
        $nerChart->chart_kd_reg  = $request->chart_kd_reg;
        $nerChart->chart_mr    = $request->chart_mr;
        $nerChart->chart_nm_pasien = $request->chart_nm_pasien;
        $nerChart->chart_layanan = $request->chart_layanan;
        $nerChart->chart_dokter = $request->chart_dokter;
        $nerChart->user   = Auth::user()->name;
        $nerChart->chart_S = $request->chart_S;
        $nerChart->chart_O = $request->chart_O;
        $nerChart->chart_A    = $request->chart_A;
        $nerChart->chart_A_diagnosa = $request->chart_A_diagnosa;
        $nerChart->chart_P = $request->chart_P;

        $nerChart->ttv_BW = $request->ttv_BW;
        $nerChart->ttv_BH = $request->ttv_BH;
        $nerChart->ttv_BPs = $request->ttv_BPs;
        $nerChart->ttv_BPd = $request->ttv_BPd;
        $nerChart->ttv_BT = $request->ttv_BT;
        $nerChart->ttv_HR = $request->ttv_HR;
        $nerChart->ttv_RR = $request->ttv_RR;
        $nerChart->ttv_SN = $request->ttv_SN;
        $nerChart->ttv_SPO2 = $request->ttv_SPO2;

        $nerChart->save();

        if ($request->nm_tarif != null) {
            foreach ($request->nm_tarif as $key => $val) {
                $newData = [
                    'kd_trs' => $kd_trs,
                    'chart_id' => $chartId,
                    'tgl_trs' => $request->chart_tgl_trs,
                    'layanan' => $request->chart_layanan,
                    'kd_reg' => $request->chart_kd_reg,
                    'mr_pasien' => $request->chart_mr,
                    'nm_pasien' => $request->chart_nm_pasien,
                    'nm_tarif' => $request->nm_tarif[$key],
                    'nm_tarif_dasar' => $request->nm_tarif_dasar,
                    'nm_dokter_jm' => $request->chart_dokter,
                    'sub_total' => $request->sub_total,
                    'user' => Auth::user()->name,
                ];
                trs_chart::create($newData);
            };
        } else {
            $newData = [
                'kd_trs' => $kd_trs,
                'chart_id' => $chartId,
                'tgl_trs' => $request->chart_tgl_trs,
                'layanan' => $request->chart_layanan,
                'kd_reg' => $request->chart_kd_reg,
                'mr_pasien' => $request->chart_mr,
                'nm_pasien' => $request->chart_nm_pasien,
                'nm_tarif_dasar' => $request->nm_tarif_dasar,
                'nm_dokter_jm' => $request->chart_dokter,
                // 'nm_dokter_jm' => $request->chart_dokter,
                // 'sub_total' => $request->sub_total,
                'user' => Auth::user()->name,
            ];
            trs_chart::create($newData);
        };

        if (!empty($request->ch_kd_obat)) {
            foreach ($request->ch_kd_obat as $far => $val) {
                $newDataResep = [
                    'kd_trs' => $kd_trs,
                    'chart_id' => $chartId,
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
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $fileOriginalName = $image->getClientOriginalExtension();
                $fileNewName = $request->chartId . '-'  . uniqid() . '.' . $fileOriginalName;
                $image->storeAs('images', $fileNewName, 'public');
                chart_images::create([
                    'chart_id' => $chartId,
                    'chart_noRm' => $request->chart_mr,
                    'chart_kd_reg' => $request->chart_kd_reg,
                    'chart_imageName' => $fileNewName,
                    'chart_note' => $request->imgNote,
                    'chart_tglTrs' => $request->chart_tgl_trs
                ]);
            }
        }

        // $insertLabel = [];
        // foreach ($request->ch_kd_obat as $label => $val) {
        //     $newDataLabel = [
        //         'reffID' => $request->kd_trs,
        //         'Tgl' => Carbon::now(),
        //         'labelType' => 'Prescription (Resep)',
        //         'pasienID' => $request->chart_mr,
        //         'layananID' => $request->chart_layanan,
        //         'kdReg' => $request->chart_kd_reg,
        //         'pasienName' => $request->chart_nm_pasien,
        //         'userID' => Auth::user()->name,
        //         'ketFile' => '',
        //         'ketHTML' => htmlentities('<tr><td>' . $request->ch_nm_obat[$label] . '</td><td>' . $request->ch_qty_obat[$label] . '</td><td>' . $request->ch_satuan_obat[$label] . '</td><td>' . $request->ch_cara_pakai[$label] . '</td></tr>')
        //     ];
        //     $insertLabel[] = $newDataLabel;
        // };
        // t_label_timeline::insert($insertLabel);
        if ($request->ch_kd_obat != '') {
            $newDataLabel = [
                'reffID' => $kd_trs,
                'Tgl' => Carbon::now(),
                'labelType' => 'Prescription (Resep)',
                'pasienID' => $request->chart_mr,
                'layananID' => $request->chart_layanan,
                'kdReg' => $request->chart_kd_reg,
                'pasienName' => $request->chart_nm_pasien,
                'userID' => Auth::user()->name,
                'ketFile' => '',
            ];
            $ketHTML = [];
            foreach ($request->ch_kd_obat as $label => $val) {
                $ketHTML[] = htmlentities('<tr><td>' . $request->ch_nm_obat[$label] . '</td><td>' . $request->ch_qty_obat[$label] . '</td><td>' . $request->ch_satuan_obat[$label] . '</td><td>' . $request->ch_cara_pakai[$label] . '</td></tr>');
            };
            // array_push($newDataLabel, ['ketHTML' => json_encode($ketHTML)]);
            // $newDataLabel['ketHTML'][] = json_encode($ketHTML);
            $newDataLabel['ketHTML'] = json_encode($ketHTML, JSON_UNESCAPED_SLASHES);
            // dd($ketHTML);
            // dd($newDataLabel);
            // $newDataLabel[] = ['ketHTML' => $ketHTML];
            t_label_timeline::create($newDataLabel);
        }

        DB::commit();

        $sessionFlash = [
            'message' => 'Saved!',
            'alert-type' => 'success'
        ];

        return Redirect::to('/tindakan-medis')->with($sessionFlash);
        // } catch (\Exception $e) {
        DB::rollback();

        $sessionFlashErr = [
            'message' => 'Some Error Occured!',
            'alert-type' => 'error'
        ];
        return Redirect::to('/tindakan-medis')->with($sessionFlashErr);
        // }
        // toastr()->success('Data Tersimpan!');
        // return back();
        // // return redirect()->route('/tindakan-medis');
        // // } catch (\Exception $e) {
        // DB::rollback();
        // toastr()->error('Gagal Tersimpan!');
        // return back();
        // // }
    }



    // get timeline pemeriksaan
    public function getTimeline(Request $request)
    {
        $isTimelineHistory = ChartTindakan::with('trstdk.nm_trf', 'resep', 'images')
            ->where('chart_mr', $request->chart_mr)
            ->orderBy('chart_tindakan.created_at', 'DESC')
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

    public function getLabel(Request $request)
    {
        // $isLabel = DB::table('t_label_hdr')
        //     ->leftJoin('t_label_detail', 't_label_hdr.pasienID', 't_label_detail.pasienID')
        //     ->where('t_label_hdr.pasienID', $request->pasienID)
        //     ->select('t_label_hdr.*', 'kd_obat', 'nm_obat', 'qty_obat', 'satuan_obat', 'cara_pakai', 'tindakan')
        //     ->orderBy('t_label_hdr.Tgl', 'DESC')
        //     ->get();
        $isLabel = DB::table('t_label_timeline')
            ->where('pasienID', $request->pasienID)
            ->orderBy('t_label_timeline.Tgl', 'DESC')
            ->get();


        return response()->json($isLabel);
    }

    // Get ChartID utk Edit
    public function chartIdSearch(Request $request)
    {
        $isChartID = ChartTindakan::with('trstdk.nm_trf', 'resep', 'images')
            ->where('chart_id', $request->chartid)
            ->get();

        return response()->json($isChartID);
    }

    public function getIcdX(Request $request)
    {
        $isICDX = [];

        if ($request->filled('q')) {
            $isICDX = mstr_icdx::select("code", "name_id")
                ->where('name_id', 'LIKE', '%' . $request->get('q') . '%')
                ->orWhere('code', 'LIKE', '%' . $request->get('q') . '%')
                ->get();
        }
        // dd($data);
        return response()->json($isICDX);
    }

    public function chartUpdate(Request $request)
    {
        // dd($request->all());
        $c =  DB::table('chart_tindakan')->where('chart_id', $request->chart_id)->update([
            'chart_S' => $request->chart_S,
            'chart_O' => $request->chart_O,
            'chart_A' => $request->chart_A,
            'chart_A_diagnosa' => $request->chart_A_diagnosa,
            'chart_P' => $request->chart_P,
            'ttv_BW' => $request->ttv_BW,
            'ttv_BH' => $request->ttv_BH,
            'ttv_BPs' => $request->ttv_BPs,
            'ttv_BPd' => $request->ttv_BPd,
            'ttv_BT' => $request->ttv_BT,
            'ttv_HR' => $request->ttv_HR,
            'ttv_RR' => $request->ttv_RR,
            'ttv_SN' => $request->ttv_SN,
            'ttv_SPO2' => $request->ttv_SPO2,
        ]);

        // if ($c) {
        //     toastr()->success('Edit Data Berhasil!');
        //     return back();
        // } else {
        //     toastr()->error('Gagal Tersimpan!');
        //     return back();
        // }
    }

    public function chartDelete(Request $request)
    {
        DB::table('chart_tindakan')->where('chart_id', $request->chartid)->delete();
        DB::table('trs_chart_resep')->where('chart_id', $request->chartid)->delete();
        DB::table('trs_chart')->where('chart_id', $request->chartid)->delete();
        DB::table('chart_images')->where('chart_id', $request->chartid)->delete();

        return back();
    }

    public function getTemplateOrder()
    {
        $isTemplateOrder = DB::table('t_template_order_hdr')->get();
        // $isTemplateOrder = DB::table('t_template_order_hdr')->leftJoin('t_template_order_detail', 't_template_order_detail.kd_to', 't_template_order_hdr.kd_to')->get();

        return response()->json($isTemplateOrder);
    }

    public function selectTemplateOrder(Request $request)
    {
        $isDataTemplate = DB::table('t_template_order_detail')->where('kd_to', $request->kd_to)->get();
        // $isTemplateOrder = DB::table('t_template_order_hdr')->leftJoin('t_template_order_detail', 't_template_order_detail.kd_to', 't_template_order_hdr.kd_to')->get();

        return response()->json($isDataTemplate);
    }
}
