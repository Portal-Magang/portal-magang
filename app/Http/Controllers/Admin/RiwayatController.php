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

        $query = Pengajuan::with(['user', 'peserta'])->whereIn('status', ['diterima', 'ditolak'])->latest()->paginate(10)->withQueryString();

        if (in_array($status, ['diterima', 'ditolak'])) {
            $query->where('status', $status);
        }

        $pengajuans = $query->get();

        return view('admin.riwayat.index', compact('pengajuans', 'status'));
    }

    public function detail($id)
    {
        $pengajuan = Pengajuan::with(['user', 'peserta'])->findOrFail($id);
        return view('admin.riwayat.detail', compact('pengajuan'));
    }
}