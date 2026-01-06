<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        $data = Cache::remember("admin:dashboard:counts", now()->addSecond(60), function(){
        return[
            'baru'     => Pengajuan::where('status', 'menunggu')->count(),
            'diterima' => Pengajuan::where('status', 'diterima')->count(),
            'ditolak'  => Pengajuan::where('status', 'ditolak')->count(),
            ];
        });

        return view('admin.dashboard', $data);
    }
}