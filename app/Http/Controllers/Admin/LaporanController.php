<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tahun = (int) ($request->get('tahun') ?? now()->year);

        $dataLaporan = Pengajuan::with('user')->whereYear('created_at', $tahun)->latest()->paginate(10)->withQueryString();

        $totalTahunIni = $dataLaporan->count();
        
        $stats = [
            'total' => $totalTahunIni,
            'diterima' => $dataLaporan->where('status', 'diterima')->count(),
            'ditolak' => $dataLaporan->where('status', 'ditolak')->count(),
            'menunggu' => $dataLaporan->where('status', 'menunggu')->count(),
        ];

        $rekapPerTahun = Pengajuan::selectRaw('YEAR(created_at) as tahun, COUNT(*) as total')
            ->groupByRaw('YEAR(created_at)')
            ->orderByRaw('YEAR(created_at) desc')
            ->get();

        return view('admin.laporan.index', compact('totalTahunIni', 'rekapPerTahun', 'tahun', 'dataLaporan', 'stats'));
    }
}