<?php

namespace App\Http\Controllers;

use App\Models\SkemaSertifikasi;
use App\Models\Peserta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // ADMIN: langsung ke dashboard admin
        if (Auth::user()->role === 'admin') {
            $totalPeserta = Peserta::count();
            $totalSkema = SkemaSertifikasi::count();

            return response()
                ->view('dashboard', compact('totalPeserta', 'totalSkema'))
                ->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');
        }

        // USER BIASA: cari data peserta berdasarkan user_id atau email
        $peserta = Peserta::where(function ($q) {
            $q->where('user_id', Auth::id())
              ->orWhere('email', Auth::user()->email);
        })->first();

        // Hubungkan akun dengan data peserta jika belum terhubung
        if ($peserta && is_null($peserta->user_id)) {
            $peserta->user_id = Auth::id();
            $peserta->save();
        }

        $skemas = SkemaSertifikasi::all();

        return view('peserta-saya.index', compact('peserta', 'skemas'));
    }

    public function store(Request $request)
    {
        // Admin tidak boleh mendaftar sebagai peserta melalui form user
        if (Auth::user()->role === 'admin') {
            return redirect()->route('dashboard');
        }

        if (Peserta::where('user_id', Auth::id())->exists()) {
            return redirect()->route('peserta-saya.index')
                ->with('error', 'Anda sudah terdaftar sebagai peserta.');
        }

        $request->validate([
            'skema_id'     => 'required|exists:skema_sertifikasi,id',
            'nama_peserta' => 'required|string|max:255',
            'alamat'       => 'required|string',
            'no_hp'        => 'required|string|max:20',
            'email'        => 'required|email|unique:pesertas,email',
        ]);

        Peserta::create([
            'user_id'      => Auth::id(),
            'skema_id'     => $request->skema_id,
            'nama_peserta' => $request->nama_peserta,
            'alamat'       => $request->alamat,
            'no_hp'        => $request->no_hp,
            'email'        => strtolower($request->email),
        ]);

        return redirect()->route('peserta-saya.index')
            ->with('success', 'Pendaftaran peserta berhasil!');
    }
}
