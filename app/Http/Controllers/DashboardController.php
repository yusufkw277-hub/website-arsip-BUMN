<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $arsipPerTahun = Arsip::selectRaw('tahun_pemberkasan, COUNT(*) as total')
        ->groupBy('tahun_pemberkasan')
        ->orderBy('tahun_pemberkasan')
        ->pluck('total', 'tahun_pemberkasan');

    $totalArsip = Arsip::count();

    return view('dashboard', compact('arsipPerTahun', 'totalArsip'));
}
}