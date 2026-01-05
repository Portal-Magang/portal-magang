<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatSuratController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status'); // menunggu / diterima / ditolak

        $query = Pengajuan::with('peserta') ->where('user_id', Auth::id())->latest()->paginate(10)->withQueryString();;

        if (in_array($status, ['menunggu', 'diterima', 'ditolak'])) {
            $query->where('status', $status);
        }

        $pengajuans = $query->get();

        return view('user.riwayat.index', compact('pengajuans', 'status'));
    }

    public function detail($id)
    {
        $pengajuan = Pengajuan::with('peserta')->where('user_id', Auth::id())->findOrFail($id);

        return view('user.riwayat.detail', compact('pengajuan'));
    }
}