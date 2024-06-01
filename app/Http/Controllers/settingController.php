<?php

namespace App\Http\Controllers;

use App\Models\profilePerusahaan;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\table;

class settingController extends Controller
{
    public function hakAkses()
    {
        $isDataUser = DB::table('users')->leftJoin('role', 'users.role_id', 'role.id')->get();

        return view('Pages.hak-akses', ['isDataUser' => $isDataUser]);
    }

    public function userCreate(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            // 'remember_token' => 
        ]);

        // return response()->json($user);


        if ($user->save()) {
            toastr()->success('Create User Berhasil!');
            return back();
        } else {
            toastr()->error('Gagal Tersimpan!');
            return back();
        }
    }

    public function profilePerusahaan()
    {
        $profil = profilePerusahaan::all();
        return view('Pages.profile-perusahaan', ['profil' => $profil]);
    }

    public function createProfile(Request $request)
    {
        $createProfile = profilePerusahaan::create($request->all());

        if ($createProfile->save()) {
            toastr()->success('Tersimpan!');
            return back();
        } else {
            toastr()->error('Gagal Tersimpan!');
            return back();
        }
    }
}
