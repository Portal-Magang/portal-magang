<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\PesertaPengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            'jenis_pengajuan' => 'required|in:Individu,Instansi',
            'asal_instansi'   => 'required|string|max:255',
            'surat_pengantar' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $nama = $request->input('nama_pengaju');
        $jurusan = $request->input('jurusan');
        $no_hp = $request->input('no_hp');

        $peserta = [];

        if (is_array($nama)) {
            for($i = 0; $i < count($nama); $i++) {
                if (!isset($nama[$i], $jurusan[$i], $hp[$i])) continue;

                $peserta[] = [
                    'nama'    => $nama[$i],
                    'jurusan' => $jurusan[$i],
                    'no_hp'   => $no_hp[$i],
                ];
            }
        } else {
            $peserta[] = [
                'nama'    => $nama,
                'jurusan' => $jurusan,
                'no_hp'   => $no_hp,
            ];
        }
        
        if (count($peserta) < 1){
            return back()->withErrors(['nama_pengaju' => 'Minimal harus ada satu peserta yang diisi.'])->withInput();
        }

        foreach ($peserta as $idx => $p){
            if (empty($p['nama_pengaju']) || empty($p['jurusan']) || empty($p['no_hp'])){
                return back()-> withErrors(['nama_pengaju' => "Data peserta ke-" . ($idx + 1) . " tidak lengkap."])->withInput();
            }

            if (mb_strlen($p['nama_pengaju']) > 255 || mb_strlen($p['jurusan']) > 255 || mb_strlen($p['no_hp']) > 20){
                return back()-> withErrors(['nama_pengaju' => "Data peserta ke-" . ($idx + 1) . " melebihi batas maximum."])->withInput();
            }
        }

        // simpan file ke storage/app/public/surat_pengantar
        $filePath = $request->file('surat_pengantar')
            ->store('surat_pengantar', 'public');

         DB::transaction(function () use ($request, $filePath, $peserta) {

            $pengajuan = Pengajuan::create([
                'user_id'         => Auth::id(),
                'jenis_pengajuan' => $request->jenis_pengajuan,
                'asal_instansi'   => $request->asal_instansi,
                'surat_pengantar' => $filePath,
                'status'          => 'menunggu',
            ]);

            foreach ($peserta as $p) {
                PesertaPengajuan::create([
                    'pengajuan_id' => $pengajuan->id,
                    'nama_pengaju' => $p['nama_pengaju'],
                    'jurusan'      => $p['jurusan'],
                    'no_hp'        => $p['no_hp'],
                ]);
            }
        });

        return redirect('/riwayat-surat')->with('success', 'Pengajuan berhasil dikirim.');
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

        $user = Auth::user();
        if (!$user) abort(401);

        if (Auth::user()->role !== 'admin' && $pengajuan->user_id !== Auth::id()) {
            abort(403);
        }

        $path = $this->suratPath($pengajuan);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }
}