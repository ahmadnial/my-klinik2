<?php

namespace App\Http\Controllers;

use App\Models\mstr_supplier;
use Illuminate\Http\Request;

class poDoController extends Controller
{

    public function po()
    {
        // $num = str_pad(00001, 5, 0, STR_PAD_LEFT);
        // $cekid = mstr_supplier::count();
        // if ($cekid == 0) {
        //     $kd_po =  'PO'  . $num;
        // } else {
        //     $continue = mstr_supplier::all()->last();
        //     $de = substr($continue->fm_kd_supplier, -5);
        //     // dd($de);
        //     $kd_po = 'PO' . str_pad(($de + 1), 5, '0', STR_PAD_LEFT);
        //     // dd($kd_reg);
        // };

        $supplier = mstr_supplier::all();
        return view('pages.purchase-order', ['supplier' => $supplier]);
    }

    public function do()
    {
        $supplier = mstr_supplier::all();
        return view('pages.delivery-order', ['supplier' => $supplier]);
    }
}
