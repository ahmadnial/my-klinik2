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
            $listHutangSupplier = DB::table('hutang_supplier')->where('isLunas', '=', '0')->get();

            return DataTables::of($listHutangSupplier)
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" id="' . $row->fm_kd_obat . '" onClick="SelectItemObatEdit(this)" data-kdmr="' . $row->fm_kd_obat . '"
                    data-fm_kd_obat="' . $row->fm_kd_obat . '" data-fm_nm_obat="' . $row->fm_nm_obat . '" data-fm_satuan_jual="' . $row->fm_satuan_jual . '"
                    data-fm_hrg_jual="' . $row->fm_hrg_jual_non_resep . '" data-qty="' . $row->qty . '" data-fm_hrg_beli_detail="' . $row->fm_hrg_beli_detail . '" data-fm_isi_satuan_pembelian="' . $row->fm_isi_satuan_pembelian . '"
                    class="edit btn btn-xs btn-sm" style="background-color:#10F3A4; color:#ffffff;">Select</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
            return response()->json($listHutangSupplier);
        }
    }
}
