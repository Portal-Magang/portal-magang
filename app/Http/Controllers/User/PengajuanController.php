<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    public function create()
    {
        return view('user.pengajuan.create');
    }

    public function store(Request $request)
    {
        // Cegah spam: masih ada pengajuan menunggu
        $exists = Pengajuan::where('user_id', Auth::id())
            ->where('status', 'menunggu')
            ->exists();

        if ($exists) {
            return back()
                ->withErrors(['surat_pengantar' => 'Masih ada pengajuan yang menunggu.'])
                ->withInput();
        }

        $request->validate([
            'asal_instansi'   => 'required|string|max:255',
            'jurusan'         => 'required|string|max:255',
            'no_hp'           => 'required|string|max:20',
            'surat_pengantar' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // simpan file ke storage/app/public/surat_pengantar
        $filePath = $request->file('surat_pengantar')
            ->store('surat_pengantar', 'public');

        Pengajuan::create([
            'user_id'         => Auth::id(),
            'asal_instansi'   => $request->asal_instansi,
            'jurusan'         => $request->jurusan,
            'no_hp'           => $request->no_hp,
            'surat_pengantar' => $filePath,
            'status'          => 'menunggu',
        ]);

        return redirect('/riwayat')->with('success', 'Pengajuan berhasil dikirim.');
    }

    public function riwayat()
    {
        $pengajuans = Pengajuan::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.pengajuan.riwayat', compact('pengajuans'));
    }

    private function suratPath(Pengajuan $pengajuan): string
    {
        return storage_path('app/public/' . $pengajuan->surat_pengantar);
    }

    public function previewSurat($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        if (Auth::user()->role !== 'admin' && $pengajuan->user_id !== Auth::id()) {
            abort(403);
        }

        $path = $this->suratPath($pengajuan);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }

    public function downloadSurat($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $path = $this->suratPath($pengajuan);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->download($path);
    }
}