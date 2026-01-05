<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

        $query = Pengajuan::query()
            ->with(['user', 'peserta'])
            ->whereIn('status', ['diterima', 'ditolak']);

        if (in_array($status, ['diterima', 'ditolak'])) {
            $query->where('status', $status);
        }

        $pengajuans = $query->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.riwayat.index', compact('pengajuans', 'status'));
    }

    public function detail($id)
    {
        $pengajuan = Pengajuan::with(['user', 'peserta'])->findOrFail($id);
        return view('admin.riwayat.detail', compact('pengajuan'));
    }
}