<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yoeunes\Toastr\Toastr;

class AuthController extends Controller
{
    public function login()
    {
        return view('Pages.login');
    }

    public function ProsesLogin(Request $request)
    {
        // validasi
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        // dd($credentials);


        if (auth()->attempt($credentials)) {
            // buat ulang session login
            $request->session()->regenerate();

            // if (auth()->user()->role_id === 1) {
            // jika user superadmin
            return redirect()->intended('/');
            // } else {
            //     // jika user pegawai
            //     return redirect()->intended('/pegawai');
            // }
        }

        // jika email atau password salah
        // kirimkan session error
        toastr()->error('Username Atau Password Salah');
        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
