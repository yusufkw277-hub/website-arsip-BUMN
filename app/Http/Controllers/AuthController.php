<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function prosesLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = DB::table('users')
            ->where('email', $request->email)
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('login', true);
            Session::put('user_id', $user->id);
            Session::put('user_name', $user->username);

            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Email atau Password salah');
    }

    public function logout()
    {
        Session::flush();
        return redirect('/')->with('success', 'Logout berhasil');
    }
}
