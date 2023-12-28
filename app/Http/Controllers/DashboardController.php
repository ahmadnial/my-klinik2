<?php

namespace App\Http\Controllers;

use App\Models\do_hdr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $dateNow = Carbon::now()->format("Y-m-d");
        $monthNow = Carbon::now()->format("m");
        $yearNow = Carbon::now()->format("Y");
        // $isListPenjualan = tp_hdr::whereyear('tgl_trs', '=', $yearNow)->whereMonth('tgl_trs', '=', $monthNow)->orderBy('created_at', 'desc')->get();
        $isFakturTempo = do_hdr::whereyear('do_hdr_tgl_tempo', '=', $yearNow)->whereMonth('do_hdr_tgl_tempo', '=', $monthNow)->orderBy('do_hdr_tgl_tempo', 'desc')->get();

        return view('Pages.index', [
            'isFakturTempo' => $isFakturTempo
        ]);
    }
}
