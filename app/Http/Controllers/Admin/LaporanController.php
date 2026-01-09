<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->filled('tahun') ? (int) $request->tahun : null;

        // Data tabel laporan
        $dataLaporan = Pengajuan::with('user')
        ->when($tahun, fn ($q) => $q->whereYear('created_at', $tahun))
        ->latest()
        ->paginate(10)
        ->withQueryString();

        // Rekap per tahun
        $rekapPerTahun = Cache::remember("admin:laporan:rekapPerTahun", now()->addMinutes(30), function(){
            return Pengajuan::selectRaw('YEAR(created_at) as tahun, COUNT(*) as total')
                ->groupByRaw('YEAR(created_at)')
                ->orderByRaw('YEAR(created_at) desc')
                ->get();
        });
        return view('admin.laporan.index', compact('tahun','dataLaporan','rekapPerTahun'));
    }

    public function cetakLaporan(Request $request)
    {
        $request->validate([
            'tahun' => ['required', 'integer'],
        ]);
    
        $tahun = (int) $request->tahun;
    
        $laporanTahunan = Pengajuan::whereYear('created_at', $tahun) ->with(['user', 'peserta'])->latest()->get();
    
        return view('admin.laporan.cetak', compact('tahun', 'laporanTahunan'));
    }    
}