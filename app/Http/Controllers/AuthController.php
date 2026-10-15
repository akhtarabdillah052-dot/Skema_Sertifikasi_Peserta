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

        // Admin → dashboard
        if ($user->role === 'admin') {
            return redirect()->intended('dashboard');
        }

        // User biasa → cek apakah sudah terdaftar sebagai peserta
        // (bisa lewat user_id ATAU cocokkan email)
        $peserta = Peserta::where(function ($q) use ($user) {
            $q->where('user_id', $user->id)
              ->orWhere('email', $user->email);
        })->first();

        if ($peserta) {
            // Auto-link user_id kalau peserta diinput manual oleh admin
            if (!$peserta->user_id) {
                $peserta->user_id = $user->id;
                $peserta->save();
            }

            return redirect()->route('peserta-saya.index')
                ->with('success', 'Selamat datang! Anda sudah terdaftar sebagai peserta sertifikasi.');
        }

        // Belum terdaftar sebagai peserta → ke halaman daftar peserta
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