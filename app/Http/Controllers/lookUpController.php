<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class lookUpController extends Controller
{
    public function getuniversalLookUp(Request $request)
    {
        // if (request()->ajax()) {
        //     $isObatReguler = DB::table('mstr_obat')
        //         ->where('isActive', '=', '1')
        //         ->leftJoin('tb_stock', 'mstr_obat.fm_kd_obat', 'tb_stock.kd_obat')
        //         ->select('mstr_obat.*', 'tb_stock.*')
        //         ->get();

        //     return response()->json($isObatReguler);

        $keyword = [];

        if ($request->filled('q')) {
            $keyword = DB::table('mstr_obat')
                ->where('fm_nm_obat', 'LIKE', '%' . $request->get('q') . '%')
                ->orWhere('fm_kandungan_obat', 'LIKE', '%' . $request->get('q') . '%')
                ->where('isActive', '=', '1')
                ->leftJoin('tb_stock', 'mstr_obat.fm_kd_obat', 'tb_stock.kd_obat')
                // ->select('mstr_obat.*', 'tb_stock.*')
                ->get();
        }
        // dd($keyword);
        return response()->json($keyword);
    }
}
