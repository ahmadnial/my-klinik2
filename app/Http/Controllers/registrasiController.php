<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dataSosialCreate;
use App\Models\registrasiCreate;
use RealRashid\SweetAlert\Toaster;
use Yoeunes\Toastr\Toastr;

class registrasiController extends Controller
{

    public function index()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'fs_mr' => 'required',
            'fs_nama' => 'required',
            'fs_tgl_lahir' => 'required',
            'fs_jenis_kelamin' => 'required'
        ]);

        $data = dataSosialCreate::create($request->all());

        if ($data->save()) {
            toast('Berhasil Tersimpan', 'success')->autoClose(5000);
            return back();
        } else {
            toast('Gagal Tersimpan!', 'error')->autoClose(5000);
            return back();
        }
    }

    public function registrasiCreate(Request $request)
    {
        $request->validate([
            'fr_kd_reg' => 'required',
            'fr_mr' => 'required',
            // 'fr_nama' => 'required',
            'fr_tgl_lahir' => 'required',
            'fr_jenis_kelamin' => 'required',
            'fr_alamat' => 'required',
            'fr_no_hp' => 'required',
            'fr_layanan' => 'required',
            'fr_dokter' => 'required',
            'fr_jaminan' => 'required'
        ]);

        $data = registrasiCreate::create($request->all());

        if ($data->save()) {
            Toastr('Berhasil Tersimpan', 'success');
            return back();
        } else {
            toastr('Gagal Tersimpan!', 'error');
            return back();
        }
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
