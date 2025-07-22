<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatCuci;

class RiwayatController extends Controller
{
    public function index()
    {
        $riwayat = RiwayatCuci::with('pelanggan')->latest()->get();
        return view('admin.riwayat.index', compact('riwayat'));
    }
}
