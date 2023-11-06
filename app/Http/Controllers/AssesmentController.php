<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssesmentController extends Controller
{

    public function assAwal()
    {
        return view('Pages.assesment-awal');
    }
}
