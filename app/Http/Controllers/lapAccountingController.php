<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class lapAccountingController extends Controller
{
    public function laporanLaba()
    {
        return view('pages.laporan.accounting.laporan-laba');
    }
}
