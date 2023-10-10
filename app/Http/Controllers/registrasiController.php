<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dataSosialCreate;
use App\Models\registrasiCreate;
use RealRashid\SweetAlert\Toaster;
use Yoeunes\Toastr\Toastr;
use Illuminate\Support\Facades\DB;


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
            toastr()->success('Data Tersimpan!');
            return back();
        } else {
            toastr()->error('Gagal Tersimpan!');
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
            toastr()->success('Data Tersimpan!');
            return back();
        } else {
            toastr()->error('Gagal Tersimpan!');
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function editDasos(Request $request)
    {
        $y =  DB::table('tc_mr')->where('fs_mr', $request->fs_mr)->update([
            'fs_mr' => $request->fs_mr,
            'fs_nama' => $request->fs_nama,
            'fs_tgl_lahir' => $request->fs_tgl_lahir,
            'fs_jenis_kelamin' => $request->fs_jenis_kelamin,
            'fs_jenis_identitas' => $request->fs_jenis_identitas,
            'fs_no_identitas' => $request->fs_no_identitas,
            'fs_alamat' => $request->fs_alamat,
            'fs_agama' => $request->fs_agama,
            'fs_pekerjaan' => $request->fs_pekerjaan,
            'fs_pendidikan' => $request->fs_pendidikan,
            'fs_status_kawin' => $request->fs_status_kawin,
            'fs_no_hp' => $request->fs_no_hp,
            'fs_user' => $request->fs_user,
        ]);

        if ($y) {
            toastr()->success('Edit Data Saved!');
            return back();
        } else {
            toastr()->error('Gagal Tersimpan!');
            return back();
        }
        // if ($y->save()) {
        //     Toastr('Berhasil Tersimpan', 'success');
        //     return back();
        // } else {
        //     toastr('Gagal Tersimpan!', 'error');
        //     return back();
        // }
    }


    public function deleteDasos(Request $request)
    {
        $delete =  DB::table('tc_mr')->where('fs_mr', $request->fs_mr)->get();
        dd($delete);
        $delete->delete();

        return back();
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
