<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\SkemaSertifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesertaSayaController extends Controller
{

    public function index()
{
    $peserta = Peserta::where(function ($q) {
        $q->where('user_id', Auth::id())
          ->orWhere('email', Auth::user()->email);
    })->first();

    // AUTO-LINK
    if ($peserta && is_null($peserta->user_id)) {
        $peserta->user_id = Auth::id();
        $peserta->save();
    }

    $skemas = SkemaSertifikasi::all();

    return view('peserta-saya.index', compact('peserta', 'skemas'));
}

    public function store(Request $request)
    {
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
            'email'        => $request->email,
        ]);

        return redirect()->route('peserta-saya.index')
            ->with('success', 'Pendaftaran peserta berhasil!');
    }

    
}
