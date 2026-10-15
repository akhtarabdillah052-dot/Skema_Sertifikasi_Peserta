<?php

namespace App\Http\Controllers;

use App\Models\DokumenPeserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VerifikasiDokumenController extends Controller
{
    /**
     * Menampilkan daftar dokumen peserta untuk admin.
     */
    public function index()
    {
        $dokumens = DokumenPeserta::with('peserta')
            ->latest()
            ->get();

        return view('peserta.verifikasi-dokumen', compact('dokumens'));
    }

    /**
     * Memperbarui status verifikasi dokumen.
     */
    public function updateStatus(Request $request, DokumenPeserta $dokumen)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak',
        ]);

        $dokumen->status = $request->status;
        $dokumen->save();

        return redirect()
            ->route('admin.dokumen.index')
            ->with(
                'success',
                'Status dokumen berhasil diperbarui menjadi ' . $request->status . '.'
            );
    }

    /**
     * Menampilkan file dokumen peserta di browser.
     */
    public function lihatFile(DokumenPeserta $dokumen, string $jenis)
    {
        // Pastikan jenis dokumen valid.
        abort_unless(
            in_array($jenis, ['ktp', 'ijazah', 'sertifikat']),
            404,
            'Jenis dokumen tidak valid.'
        );

        // Ambil lokasi file dari kolom database.
        $kolom = $jenis . '_path';
        $path = $dokumen->$kolom;

        // Gunakan disk local untuk memeriksa dan membaca file.
        $storage = Storage::disk('local');

        // Pastikan lokasi file tersedia.
        abort_unless(
            $path && $storage->exists($path),
            404,
            'File dokumen tidak ditemukan di penyimpanan.'
        );

        // Tampilkan file di browser, bukan mengunduhnya secara paksa.
        return response()->file($storage->path($path));
    }
}
