<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    // Halaman login admin
    public function showAdminLoginForm()
    {
        return view('auth.login.admin');
    }

    // Proses login admin
    public function adminLogin(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek kredensial admin dengan guard 'admin'
        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            Alert::toast('Selamat datang, Admin!', 'success');
            return redirect()->intended('/admin/dashboard');
        }

        Alert::toast('Username atau Password Salah!', 'error');
        return back();
    }

    // Logout admin
    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        Alert::toast('Anda telah berhasil logout.', 'success');
        return redirect('/');
    }

    // Halaman login user
    public function showUserLoginForm()
    {
        return view('auth.login.user');
    }

    // Proses login user
    public function userLogin(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek kredensial user
        if (Auth::attempt($request->only('email', 'password'))) {
            Alert::toast('Selamat datang, User!', 'success');
            return redirect()->intended('/dashboard');
        }

        Alert::toast('Username atau Password Salah!', 'error');
        return back();
    }

    // Logout user
    public function userLogout()
    {
        Auth::logout();
        Alert::toast('Anda telah berhasil logout.', 'success');
        return redirect('/');
    }
}