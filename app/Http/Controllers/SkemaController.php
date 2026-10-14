<?php

namespace App\Http\Controllers;

use App\Models\SkemaSertifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SkemaController extends Controller
{
    /**
     * Menampilkan daftar skema sertifikasi.
     */
    public function index()
    {
        try {
            $skemas = SkemaSertifikasi::all();

            return view('skema.index', compact('skemas'));
        } catch (\Exception $e) {
            Log::error('Gagal memuat halaman indeks skema: ' . $e->getMessage());

            return redirect()->route('dashboard')->with('error', 'Terjadi kesalahan sistem saat mengambil data skema.');
        }
    }

    /**
     * Menampilkan form tambah skema.
     */
    public function create()
    {
        return view('skema.create');
    }

    /**
     * Menampilkan detail skema.
     */
    public function show(int $id)
    {
        try {
            $skema = SkemaSertifikasi::findOrFail($id);
            return view('skema.show', compact('skema'));
        } catch (\Exception $e) {
            Log::error('Skema tidak ditemukan ID ' . $id . ': ' . $e->getMessage());
            return redirect()->route('skema.index')->with('error', 'Data skema tidak ditemukan.');
        }
    }

    /**
     * Menyimpan data skema baru.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_skema'  => 'required|unique:skema_sertifikasi,kode_skema',
            'nama_skema'  => 'required|string|max:255',
            'jenis'       => 'required|string',
            'jumlah_unit' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            SkemaSertifikasi::create($validatedData);
            DB::commit();

            return redirect()->route('skema.index')->with('success', 'Skema berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menyimpan skema baru: ' . $e->getMessage());

            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data karena kendala sistem.');
        }
    }

    /**
     * Menampilkan form edit skema.
     */
    public function edit(int $id)
    {
        try {
            $skema = SkemaSertifikasi::findOrFail($id);
            return view('skema.edit', compact('skema'));
        } catch (\Exception $e) {
            Log::error('Skema tidak ditemukan untuk edit ID ' . $id . ': ' . $e->getMessage());
            return redirect()->route('skema.index')->with('error', 'Data skema tidak ditemukan.');
        }
    }

    /**
     * Memperbarui data skema.
     */
    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'kode_skema'  => 'required|unique:skema_sertifikasi,kode_skema,' . $id,
            'nama_skema'  => 'required|string|max:255',
            'jenis'       => 'required|string',
            'jumlah_unit' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $skema = SkemaSertifikasi::findOrFail($id);
            $skema->update($validatedData);
            DB::commit();

            return redirect()->route('skema.index')->with('success', 'Skema berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal memperbarui skema ID ' . $id . ': ' . $e->getMessage());

            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data karena kendala sistem.');
        }
    }

    /**
     * Menghapus data skema.
     */
    public function destroy(int $id)
    {
        DB::beginTransaction();

        try {
            $skema = SkemaSertifikasi::findOrFail($id);
            $skema->delete();
            DB::commit();

            return redirect()->route('skema.index')->with('success', 'Skema berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menghapus skema ID ' . $id . ': ' . $e->getMessage());

            return redirect()->route('skema.index')->with('error', 'Skema tidak dapat dihapus karena masih digunakan oleh data peserta.');
        }
    }
}
