<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    //

    public function index()
    {
        return view('blog.login')->with(['tittle' => 'Login']);
    }

    public function authenticate(Request $request)
    {
        $otentikasi = $request->validate([
            'email'     => 'required|email',
            'password'  => 'required',
        ], [
            'email.required'    => 'email harus di isi',
            'email.email'       => 'masukkan email yang benar',
            'password.required' => 'password harus di isi',
        ]);

        if (Auth::attempt($otentikasi)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        };

        // apabila login gagal
        return back()->with('gagal', 'Email atau password salah');
    }

    // fungsi logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
