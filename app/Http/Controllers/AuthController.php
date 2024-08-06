<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yoeunes\Toastr\Toastr;
use Illuminate\Support\Facades\Hash;

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
            'password' => 'required',
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

    public function settingAccount()
    {
        return view('Pages.settingAccount');
    }

    public function postChangeProfile(Request $request)
    {
        $this->validate($request, [
            'display_name' => 'required|string',
            'current_password' => 'required|string',
            'new_password' => 'required|confirmed|min:4|string',
        ]);
        $auth = Auth::user();

        // The passwords matches
        if (!Hash::check($request->get('current_password'), $auth->password)) {
            return back()->with('error', 'Current Password is Invalid');
        }

        // Current password and new password same
        if (strcmp($request->get('current_password'), $request->new_password) == 0) {
            return redirect()->back()->with('error', 'New Password cannot be same as your current password.');
        }

        $user = User::find($auth->id);
        $user->password = Hash::make($request->new_password);
        $user->save();
        return back()->with('success', 'Password Changed Successfully');
    }

    public function editUser(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required',
            'password' => 'required|min:4|string',
        ]);

        // The passwords matches
        // if (!Hash::check($request->get('current_password'), $auth->password)) {
        //     return back()->with('error', 'Current Password is Invalid');
        // }

        // Current password and new password same
        // if (strcmp($request->get('current_password'), $request->new_password) == 0) {
        //     return redirect()->back()->with('error', 'New Password cannot be same as your current password.');
        // }

        $put = User::find($request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        // $user->save();
        if ($put) {
            return back()->with('success', 'Changed Successfully');
        }else{
            return back()->with('error', 'some error occured');
        }
    }

    public function voidUser($id)
{
    $item = User::find($id);
    $item->delete();

    return response()->json(['success' => true]);
}
}
