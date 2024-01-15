<?php

namespace App\Http\Controllers;

use App\Models\HutangSupplier;
use App\Models\pelunasanHutangSupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class HutangSupplierController extends Controller
{
    public function pelunasanHutang()
    {
        // KD HUTANG
        $numb = str_pad(000001, 6, 0, STR_PAD_LEFT);
        $Yr = date("Y");
        $Mh = date("m");
        $cekids = pelunasanHutangSupplier::count();
        if ($cekids == 0) {
            $noRefTL =  'TL'  . '-' . substr($Yr, -2) . $Mh . '-' . $numb;
        } else {
            $continues = pelunasanHutangSupplier::all()->last();
            $getKd = substr($continues->hs_kd_hutang, -6);
            $noRefTL = 'TL' . '-' . substr($Yr, -2) . $Mh  . '-' . str_pad(($getKd + 1), 6, '0', STR_PAD_LEFT);
        };

        $listHutangSupplier = DB::table('hutang_supplier')->where('isLunas', '=', '0')->get();

        $dateNow = Carbon::now()->format("Y-m-d");

        return view(
            'Pages.keu.pelunasan-hutang',
            [
                'noRefTL' => $noRefTL,
                'dateNow' => $dateNow,
                'listHutangSupplier' => $listHutangSupplier
            ]
        );
    }

    public function getListHutang()
    {

        if (request()->ajax()) {
            $listHutangSuppliers = DB::table('hutang_supplier')->where('isLunas', '=', '0')->get();
            // dd($listHutangSupplier);
            return DataTables::of($listHutangSuppliers)
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" id="' . $row->hs_kd_hutang . '" onClick="SelectItemHutang(this)" data-kdtrs="' . $row->hs_kd_hutang_buat . '"
                    data-no_faktur="' . $row->hs_no_faktur . '" data-tgl_hutang="' . $row->hs_tanggal_hutang . '" data-hutang_awal="' . $row->hs_nilai_hutang . '"
                    class="edit btn btn-xs btn-sm" style="background-color:#10F3A4; color:#ffffff;">Select</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
            return response()->json($listHutangSuppliers);
        }
    }
}
