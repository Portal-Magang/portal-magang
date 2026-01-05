@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-slate-950 via-blue-950 to-black p-8">
    <div class="max-w-6xl mx-auto">

        <!-- Page Title -->
        <h1 class="text-4xl font-bold text-white mb-12 text-center tracking-wide">
            List Pengajuan PKL / Magang
        </h1>

        <!-- List Container -->
        <div class="bg-white/95 rounded-2xl shadow-xl overflow-hidden">

            <!-- Header -->
            <div class="grid grid-cols-12 px-6 py-4 bg-slate-100 text-slate-600 text-sm font-semibold">
                <div class="col-span-4">Nama</div>
                <div class="col-span-4">Asal Instansi</div>
                <div class="col-span-3">Tanggal Pengajuan</div>
                <div class="col-span-1 text-right">Aksi</div>
            </div>

            <!-- Rows -->
            @forelse($pengajuans as $pengajuan)
                <div class="grid grid-cols-12 px-6 py-4 border-t hover:bg-slate-50 transition">

                    <!-- Nama -->
                    <div class="col-span-4">
                        <p class="font-semibold text-slate-800">
                            {{ $pengajuan->user->username }}
                        </p>
                    </div>

                    <!-- Instansi & Jurusan -->
                    <div class="col-span-4 text-slate-600">
                        {{ $pengajuan->asal_instansi }} <br>
                        <span class="text-sm text-slate-500">
                            {{ $pengajuan->jurusan }}
                        </span>
                    </div>

                    <!-- Tanggal -->
                    <div class="col-span-3 text-slate-600">
                        {{ $pengajuan->created_at->translatedFormat('d F Y') }}
                    </div>

                    <!-- Aksi -->
                    <div class="col-span-1 text-right">
                        <a href="{{ url('/admin/verifikasi/' . $pengajuan->id) }}"
                           class="inline-block bg-cyan-500 hover:bg-cyan-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                            Detail
                        </a>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="text-center py-16 text-slate-500">
                    Tidak ada pengajuan yang menunggu verifikasi
                </div>
            @endforelse

        </div>
    </div>
</div>
@endsection
