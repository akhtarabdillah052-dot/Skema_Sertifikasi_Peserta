<?php

namespace App\Http\Controllers;

use App\Models\SkemaSertifikasi;
use App\Models\Peserta;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'user') {
            return redirect()->route('peserta-saya.index');
        }

        $totalSkema   = SkemaSertifikasi::count();
        $totalPeserta = Peserta::count();

        return view('dashboard', compact('totalSkema', 'totalPeserta'));
    }
}
