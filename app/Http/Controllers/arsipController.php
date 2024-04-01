<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dataSosialCreate;
use App\Models\ChartTindakan;
use Illuminate\Support\Facades\DB;

class arsipController extends Controller
{
    public function arsip()
    {
        return view('pages.arsip');
    }

    public function regSearchArs(Request $request)
    {
        $isdata = [];

        if ($request->filled('q')) {
            $isdata = dataSosialCreate::select("fs_mr", "fs_nama", "fs_alamat", "fs_tgl_lahir")
                ->where('fs_nama', 'LIKE', '%' . $request->get('q') . '%')
                ->orWhere('fs_mr', 'LIKE', '%' . $request->get('q') . '%')
                ->get();
        }
        return response()->json($isdata);
    }

    public function getListChart(request $fs_mr)
    {
        // $isdata2 = dataSosialCreate::where('fs_mr', $fs_mr->fs_mr)->get();
        $isdata2 = DB::table('tc_mr')
            ->leftJoin('chart_tindakan', 'chart_tindakan.chart_mr', 'tc_mr.fs_mr')
            ->select('fs_nama', 'fs_mr', 'fs_alamat', 'chart_id', 'chart_kd_reg', 'chart_tgl_trs', 'chart_layanan')
            ->where('tc_mr.fs_mr', $fs_mr->fs_mr)
            ->get();

        return response()->json($isdata2);
    }

    public function getListChartDetail(request $chart_id)
    {
        // $isListChartDetail = DB::table('chart_tindakan')
        //     ->leftJoin('trs_chart_resep', 'trs_chart_resep.chart_id', 'chart_tindakan.chart_id')
        //     ->where('chart_tindakan.chart_id', $chart_id->chart_id)
        //     ->get();
        $isListChartDetail = ChartTindakan::with('trstdk.nm_trf', 'resep', 'arsipobatpulang')
            ->where('chart_id', $chart_id->chart_id)
            // ->where('labelType', 'medication (Obat Pulang)')
            // ->orderBy('chart_tindakan.created_at', 'DESC')
            ->get();

        return response()->json($isListChartDetail);
    }

    public function getLabel(Request $request)
    {
        $isLabel = DB::table('t_label_timeline')
            ->where('pasienID', $request->pasienID)
            ->orderBy('t_label_timeline.Tgl', 'DESC')
            ->get();

        return response()->json($isLabel);
    }
}
