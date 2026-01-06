@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-slate-950 via-blue-950 to-black p-8">
    <div class="max-w-6xl mx-auto">

        <!-- Title -->
        <h1 class="text-4xl font-bold text-white mb-10 text-center">
            Detail Riwayat Pengajuan PKL / Magang
        </h1>

        <!-- INFO PENGAJUAN -->
        <div class="bg-white/95 rounded-2xl shadow-xl mb-8 overflow-hidden">

            <div class="grid grid-cols-2 gap-6 px-8 py-6 text-sm text-slate-700">
                <div>
                    <p class="text-slate-500">Email Pengaju</p>
                    <p class="font-semibold">{{ $pengajuan->user->email }}</p>
                </div>

                <div>
                    <p class="text-slate-500">Asal Instansi</p>
                    <p class="font-semibold">{{ $pengajuan->asal_instansi }}</p>
                </div>

                <div>
                    <p class="text-slate-500">Tanggal Pengajuan</p>
                    <p class="font-semibold">
                        {{ $pengajuan->created_at->translatedFormat('d F Y') }}
                    </p>
                </div>

                <div>
                    <p class="text-slate-500">Surat Pengantar</p>
                    <a href="{{ route('pengajuan.surat.preview', $pengajuan->id) }}"
                       target="_blank"
                       class="text-cyan-600 font-semibold hover:underline">
                        📄 Lihat Surat
                    </a>
                </div>

                <!-- STATUS -->
                <div>
                    <p class="text-slate-500">Status</p>
                    @if ($pengajuan->status === 'diterima')
                        <span class="inline-block mt-1 bg-green-400 text-slate-900 font-bold px-4 py-2 rounded-lg text-sm">
                            Diterima
                        </span>
                    @elseif ($pengajuan->status === 'ditolak')
                        <span class="inline-block mt-1 bg-red-400 text-white font-bold px-4 py-2 rounded-lg text-sm">
                            Ditolak
                        </span>
                    @endif
                </div>

                <!-- CATATAN ADMIN -->
                @if ($pengajuan->catatan_admin)
                <div class="col-span-2">
                    <p class="text-slate-500">Catatan Admin</p>
                    <p class="mt-1 font-semibold text-slate-600">
                        {{ $pengajuan->catatan_admin }}
                    </p>
                </div>
                @endif
            </div>

        </div>

        <!-- LIST PESERTA -->
        <div class="bg-white/95 rounded-2xl shadow-xl overflow-hidden mb-10">

            <!-- Header -->
            <div class="grid grid-cols-12 px-6 py-4 bg-slate-100 text-slate-600 text-sm font-semibold">
                <div class="col-span-1 text-center">No</div>
                <div class="col-span-4">Nama</div>
                <div class="col-span-4">Jurusan</div>
                <div class="col-span-3">No. Telepon / WhatsApp</div>
            </div>

            <!-- Rows -->
            @forelse ($pengajuan->peserta as $index => $p)
                <div class="grid grid-cols-12 px-6 py-4 border-t hover:bg-slate-50 transition">
                    <div class="col-span-1 text-center text-slate-600">
                        {{ $index + 1 }}
                    </div>

                    <div class="col-span-4 font-semibold text-slate-800">
                        {{ $p->nama_pengaju }}
                    </div>

                    <div class="col-span-4 text-slate-600">
                        {{ $p->jurusan }}
                    </div>

                    <div class="col-span-3 text-slate-600">
                        {{ $p->no_hp }}
                    </div>
                </div>
            @empty
                <div class="text-center py-12 text-slate-500">
                    Tidak ada data peserta
                </div>
            @endforelse

        </div>

        <!-- BACK BUTTON -->
        <div class="flex justify-end">
            <a href="{{ url('/admin/riwayat') }}"
               class="px-6 py-2 rounded-lg bg-cyan-400 text-slate-900 font-semibold hover:bg-cyan-500 transition">
                Kembali
            </a>
        </div>

    </div>
</div>
@endsection
