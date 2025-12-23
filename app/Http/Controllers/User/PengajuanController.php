<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    // tampilkan form
    public function create()
    {
        return view('user.pengajuan.create');
    }

    // simpan pengajuan
    public function store(Request $request)
    {
        $request->validate([
            'asal_instansi'   => 'required|string|max:255',
            'jurusan'         => 'required|string|max:255',
            'no_hp'           => 'required|string|max:20',
            'surat_pengantar' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $filePath = $request->file('surat_pengantar')
            ->store('surat_pengantar', 'public');

        Pengajuan::create([
            'user_id'         => Auth::id(),
            'asal_instansi'   => $request->asal_instansi,
            'jurusan'         => $request->jurusan,
            'no_hp'           => $request->no_hp,
            'surat_pengantar' => $filePath,
            'status'          => 'menunggu',
            'tanggal_ajuan'   => now(),
        ]);

        return redirect('/riwayat')->with('success', 'Pengajuan berhasil dikirim.');
    }

    // riwayat pengajuan user
    public function riwayat()
    {
        $pengajuans = Pengajuan::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.pengajuan.riwayat', compact('pengajuans'));
    }
}