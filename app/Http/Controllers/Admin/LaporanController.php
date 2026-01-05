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
        $laporanTahunan = Pengajuan::whereYear('created_at', $tahun);

        $stats = [
            'total'     => $laporanTahunan->count(),
            'diterima'  => (clone $laporanTahunan)->where('status', 'diterima')->count(),
            'ditolak'   => (clone $laporanTahunan)->where('status', 'ditolak')->count(),
            'menunggu'  => (clone $laporanTahunan)->where('status', 'menunggu')->count(),
        ];

        // Data tabel laporan
        $dataLaporan = Pengajuan::with('user')->whereYear('created_at', $tahun)->latest()->paginate(10)->withQueryString();

        // Rekap per tahun
        $rekapPerTahun = Pengajuan::selectRaw('YEAR(created_at) as tahun, COUNT(*) as total')
            ->groupByRaw('YEAR(created_at)')
            ->orderByRaw('YEAR(created_at) desc')
            ->get();

        return view('admin.laporan.index', compact('tahun','stats','dataLaporan','rekapPerTahun'));
    }
}