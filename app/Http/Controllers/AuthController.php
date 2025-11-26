<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        // 1. Validasi Input
        $credentials = $request->validate([
            'name'     => 'required',
            'nim'      => 'required',
            'password' => 'required',
            'role_display' => 'required', // Validasi input dropdown
        ]);

        // 2. Cek Username, NIM, dan Password
        // Kita hanya ambil name, nim, password untuk attempt login
        $loginData = [
            'name' => $request->name, 
            'nim' => $request->nim, 
            'password' => $request->password
        ];

        if (Auth::attempt($loginData)) {
            
            $request->session()->regenerate();
            $user = Auth::user();

            // --- PERBAIKAN LOGIKA DISINI ---
            // 3. Cek apakah Role yang dipilih di form SAMA dengan Role di Database
            if ($request->role_display !== $user->role) {
                
                // Jika beda, tendang keluar (Logout paksa)
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'role_display' => 'Login gagal! Akun Anda terdaftar sebagai ' . ucfirst($user->role) . ', bukan ' . ucfirst($request->role_display),
                ]);
            }

            // 4. Jika Role Cocok, Arahkan ke Dashboard
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } else {
                return redirect()->intended('/mahasiswa/dashboard');
            }
        }

        // 5. Jika Data Salah
        return back()->withErrors([
            'name' => 'Username, NIM, atau Password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}