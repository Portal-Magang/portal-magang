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
        $exists = Pengajuan::where('user_id', Auth::id())->where('status', 'menunggu')->exists();

        if ($exists) {
            return back()->withErrors(['surat_pengantar' => 'Masih ada pengajuan yang menunggu.'])->withInput();
        }

        // validasi
        $request->validate([
            'jenis_pengajuan' => 'required|in:Individu,Instansi',
            'asal_instansi'   => 'required|string|max:255',
            'surat_pengantar' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',

            'nama_pengaju'    => 'required|array|min:1',
            'nama_pengaju.*'  => 'required|string|max:255',
            'jurusan'         => 'required|array|min:1',
            'jurusan.*'       => 'required|string|max:255',
            'no_hp'           => 'required|array|min:1',
            'no_hp.*'         => 'required|string|max:20',
        ]);

        // Simpan file setelah validasi
        $filePath = $request->file('surat_pengantar')->store('surat_pengantar', 'public');

        DB::transaction(function () use ($request, $filePath) {

            $pengajuan = Pengajuan::create([
                'user_id'         => Auth::id(),
                'jenis_pengajuan' => $request->jenis_pengajuan,
                'asal_instansi'   => $request->asal_instansi,
                'surat_pengantar' => $filePath,
                'status'          => 'menunggu',
            ]);

            $nama    = $request->nama_pengaju;
            $jurusan = $request->jurusan;
            $no_hp   = $request->no_hp;

            $jumlah = min(count($nama), count($jurusan), count($no_hp));

            for ($i = 0; $i < $jumlah; $i++) {
                PesertaPengajuan::create([
                    'pengajuan_id' => $pengajuan->id,
                    'nama_pengaju' => $nama[$i],
                    'jurusan'      => $jurusan[$i],
                    'no_hp'        => $no_hp[$i],
                ]);
            }
        });

        return redirect('/riwayat-surat')->with('success', 'Pengajuan berhasil dikirim.');
    }

    public function riwayat()
    {
        $pengajuans = Pengajuan::where('user_id', Auth::id())->latest()->get();

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