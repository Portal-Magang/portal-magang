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
        $pengajuans = Pengajuan::with(['user', 'peserta'])->where('status', 'menunggu')->latest()->paginate(10)->withQueryString();

        return view('admin.verifikasi.index', compact('pengajuans'));
    }

    // detail pengajuan
    public function detail($id)
    {
        $pengajuan = Pengajuan::with(['user','peserta'])->findOrFail($id);
        return view('admin.verifikasi.detail', compact('pengajuan'));
    }

    // aksi acc / tolak
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak',
            'catatan_admin' => 'nullable|required_if:status,ditolak|string',
        ],
        [
            'catatan_admin.required_if' => 'Catatan admin wajib diisi jika pengajuan ditolak.',
        ]);

        $pengajuan = Pengajuan::with(['user', 'peserta'])->findOrFail($id);
        $pengajuan->update(['status' => $request->status,'catatan_admin' => $request->catatan_admin,
        ]);

        return redirect('/admin/verifikasi')->with('success', 'Pengajuan berhasil diperbarui');
    }
}