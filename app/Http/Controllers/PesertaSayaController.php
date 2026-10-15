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
        $user = Auth::user();

        $peserta = Peserta::with(['skema', 'dokumen'])
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhere('email', $user->email);
            })
            ->first();

        // Hubungkan peserta dengan akun yang sedang login.
        if ($peserta && !$peserta->user_id) {
            $peserta->user_id = $user->id;
            $peserta->save();
        }

        $skemas = SkemaSertifikasi::all();

        return view('peserta-saya.index', compact('peserta', 'skemas'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Cegah peserta mendaftar lebih dari sekali.
        $sudahTerdaftar = Peserta::where('user_id', $user->id)
            ->orWhere('email', $user->email)
            ->exists();

        if ($sudahTerdaftar) {
            return redirect()
                ->route('peserta-saya.index')
                ->with('error', 'Anda sudah terdaftar sebagai peserta.');
        }

        // Validasi sesuai field pada model Peserta.
        $validated = $request->validate([
            'skema_id' => 'required|exists:skema_sertifikasi,id',
            'nama_peserta' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|unique:pesertas,email',
        ]);

        // Simpan hanya field yang tersedia pada model Peserta.
        $peserta = new Peserta();

        $peserta->user_id = $user->id;
        $peserta->skema_id = $validated['skema_id'];
        $peserta->nama_peserta = $validated['nama_peserta'];
        $peserta->alamat = $validated['alamat'];
        $peserta->no_hp = $validated['no_hp'];
        $peserta->email = $validated['email'];

        $peserta->save();

        return redirect()
            ->route('peserta-saya.index')
            ->with('success', 'Pendaftaran peserta berhasil!');
    }
}

