<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\DokumenPeserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DokumenPesertaController extends Controller
{

    public function store(Request $request)
    {
        $user = Auth::user();

        $peserta = Peserta::where('user_id', $user->id)->first();

        if (!$peserta) {
            return redirect()
                ->route('peserta-saya.index')
                ->with('error', 'Data peserta tidak ditemukan. Silakan daftar terlebih dahulu.');
        }

        $validated = $request->validate([
            'ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'ijazah' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'sertifikat' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $dokumen = DokumenPeserta::firstOrNew([
            'peserta_id' => $peserta->id,
        ]);

        // Simpan file di storage Laravel
        $ktpPath = $request->file('ktp')->store('dokumen/ktp', 'local');
        $ijazahPath = $request->file('ijazah')->store('dokumen/ijazah', 'local');
        $sertifikatPath = $request->file('sertifikat')
            ->store('dokumen/sertifikat', 'local');

        $dokumen->sertifikat_path = $sertifikatPath;

        $dokumen->ktp_path = $ktpPath;
        $dokumen->ijazah_path = $ijazahPath;
        $dokumen->status = 'menunggu konfirmasi';
        $dokumen->save();

        return redirect()
            ->route('peserta-saya.index')
            ->with('success', 'Dokumen berhasil dikirim. Silakan menunggu konfirmasi admin.');
    }
}
