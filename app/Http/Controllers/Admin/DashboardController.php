<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'baru'     => Pengajuan::where('status', 'menunggu')->count(),
            'diterima' => Pengajuan::where('status', 'diterima')->count(),
            'ditolak'  => Pengajuan::where('status', 'ditolak')->count(),
        ]);
    }
}