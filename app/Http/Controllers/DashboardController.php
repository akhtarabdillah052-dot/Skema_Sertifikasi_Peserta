<?php

namespace App\Http\Controllers;

use App\Models\SkemaSertifikasi;
use App\Models\Peserta;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSkema   = SkemaSertifikasi::count();
        $totalPeserta = Peserta::count();

        return view('dashboard', compact('totalSkema', 'totalPeserta'));
    }
}