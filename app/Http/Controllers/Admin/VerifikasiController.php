<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    // list pengajuan (menunggu)
    public function index()
    {
        $pengajuans = Pengajuan::where('status', 'menunggu')
            ->latest()
            ->get();

        return view('admin.verifikasi.index', compact('pengajuans'));
    }

    // detail pengajuan
    public function detail($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        return view('admin.verifikasi.detail', compact('pengajuan'));
    }

    // aksi acc / tolak
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak',
            'catatan_admin' => 'nullable|string',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
        ]);

        return redirect('/admin/verifikasi')
            ->with('success', 'Pengajuan berhasil diperbarui');
    }
}