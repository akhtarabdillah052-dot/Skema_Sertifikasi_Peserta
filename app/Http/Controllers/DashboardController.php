<?php

namespace App\Http\Controllers;

use App\Models\SkemaSertifikasi;
use App\Models\Peserta;
<<<<<<< HEAD
use Illuminate\Support\Facades\Auth;
=======
use Illuminate\Http\Request;
>>>>>>> 8443a6891394839ca84e081da441ff504954d6b6

class DashboardController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        if (Auth::user()->role === 'user') {
            return redirect()->route('peserta-saya.index');
        }

=======
>>>>>>> 8443a6891394839ca84e081da441ff504954d6b6
        $totalSkema   = SkemaSertifikasi::count();
        $totalPeserta = Peserta::count();

        return view('dashboard', compact('totalSkema', 'totalPeserta'));
    }
}