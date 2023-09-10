<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mstr_layanan;

class mastersatuController extends Controller
{

    public function layanan()
    {
        return view('pages.mstr1.mstr-layanan');
    }

    public function layananCreate(Request $request)
    {
        $request->validate([
            'fm_nm_layanan' => 'required',
        ]);

        $data = mstr_layanan::create($request->all());

        if ($data->save()) {
            toast('Berhasil Tersimpan', 'success')->autoClose(5000);
            return back();
        } else {
            toast('Gagal Tersimpan!', 'error')->autoClose(5000);
            return back();
        }
    }


    public function medis()
    {
        return view('pages.mstr1.mstr-medis');
    }


    public function jaminan()
    {
        return view('pages.mstr1.mstr-jaminan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
