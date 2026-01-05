@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-slate-950 via-blue-950 to-black p-8">
    <div class="max-w-6xl mx-auto">

        <!-- Page Title -->
        <h1 class="text-4xl font-bold text-white mb-8 text-center tracking-wide">
            Riwayat Pengajuan PKL / Magang
        </h1>

        <!-- Filter Status -->
        <div class="flex gap-4 mb-10 justify-center flex-wrap">
            <a href="{{ url('/admin/riwayat') }}"
               class="px-5 py-2 rounded-full text-sm font-semibold transition
               {{ !request('status') ? 'bg-cyan-400 text-slate-900' : 'bg-slate-700 text-white hover:bg-slate-600' }}">
                Semua
            </a>

            <a href="{{ url('/admin/riwayat?status=diterima') }}"
               class="px-5 py-2 rounded-full text-sm font-semibold transition
               {{ request('status') === 'diterima' ? 'bg-green-400 text-slate-900' : 'bg-slate-700 text-white hover:bg-slate-600' }}">
                Diterima
            </a>

            <a href="{{ url('/admin/riwayat?status=ditolak') }}"
               class="px-5 py-2 rounded-full text-sm font-semibold transition
               {{ request('status') === 'ditolak' ? 'bg-red-400 text-slate-900' : 'bg-slate-700 text-white hover:bg-slate-600' }}">
                Ditolak
            </a>
        </div>

        <!-- List Container -->
        <div class="bg-white/95 rounded-2xl shadow-xl overflow-hidden">

            <!-- Header -->
            <div class="grid grid-cols-12 px-6 py-4 bg-slate-100 text-slate-600 text-sm font-semibold">
                <div class="col-span-3">Nama</div>
                <div class="col-span-4">Asal Instansi</div>
                <div class="col-span-2">Tanggal</div>
                <div class="col-span-2">Status</div>
                <div class="col-span-1 text-right">Aksi</div>
            </div>

            <!-- Rows -->
            @forelse($pengajuans as $pengajuan)
                <div class="grid grid-cols-12 px-6 py-4 border-t hover:bg-slate-50 transition">

                    <!-- Nama -->
                    <div class="col-span-3">
                        <p class="font-semibold text-slate-800">
                            {{ $pengajuan->user->username }}
                        </p>
                    </div>

                    <!-- Instansi -->
                    <div class="col-span-4 text-slate-600">
                        {{ $pengajuan->asal_instansi }} <br>
                        <span class="text-sm text-slate-500">
                            {{ $pengajuan->jurusan }}
                        </span>
                    </div>

                    <!-- Tanggal -->
                    <div class="col-span-2 text-slate-600">
                        {{ $pengajuan->created_at->translatedFormat('d F Y') }}
                    </div>

                    <!-- Status -->
                    <div class="col-span-2">
                        @if ($pengajuan->status === 'diterima')
                            <span class="inline-block bg-green-100 text-green-700 text-sm font-semibold px-3 py-1 rounded-full">
                                Diterima
                            </span>
                        @elseif ($pengajuan->status === 'ditolak')
                            <span class="inline-block bg-red-100 text-red-700 text-sm font-semibold px-3 py-1 rounded-full">
                                Ditolak
                            </span>
                        @endif
                    </div>

                    <!-- Aksi -->
                    <div class="col-span-1 text-right">
                        <a href="{{ url('/admin/riwayat/' . $pengajuan->id) }}"
                           class="inline-block bg-cyan-500 hover:bg-cyan-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                            Detail
                        </a>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="text-center py-16 text-slate-500">
                    Tidak ada data riwayat pengajuan
                </div>
            @endforelse

        </div>
    </div>
</div>
@endsection
