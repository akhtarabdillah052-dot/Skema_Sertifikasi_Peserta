<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Peserta;
use App\Models\SkemaSertifikasi;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return  redirect()->route('dashboard');
        }

        return view('auth.login');
    }

   public function login(Request $request)
{
    $credentials = $request->validate([
        'email'    => ['required', 'email'],
        'password' => ['required'],
    ]);

    $credentials['email'] = strtolower($credentials['email']);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();

        $user = Auth::user();

        // 1. CEK APAKAH USER ADALAH ADMIN
        if ($user->role === 'admin') {
            return redirect()->route('dashboard')
                ->with('success', 'Selamat datang kembali, Admin!');
        }

        // 2. JIKA BUKAN ADMIN (USER BIASA), BARU CEK PESERTA
        $peserta = Peserta::where(function ($q) use ($user) {
            $q->where('user_id', $user->id)
              ->orWhere('email', $user->email);
        })->first();

        if ($peserta) {
            if (!$peserta->user_id) {
                $peserta->user_id = $user->id;
                $peserta->save();
            }

            return redirect()->route('peserta-saya.index')
                ->with('success', 'Selamat datang! Anda sudah terdaftar sebagai peserta sertifikasi.');
        }

        return redirect()->route('peserta-saya.index')
            ->with('info', 'Anda belum terdaftar sebagai peserta. Silakan lengkapi data di bawah.');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->onlyInput('email');
}

    public function dashboard()
    {
        // 2. Proteksi Manual: Tendang ke halaman login jika belum login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $totalPeserta = Peserta::count();
        $totalSkema = SkemaSertifikasi::count();

        // 3. Mencegah Browser menyimpan Cache HTML halaman Dashboard
        return response()
            ->view('dashboard', compact('totalPeserta', 'totalSkema'))
            ->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
