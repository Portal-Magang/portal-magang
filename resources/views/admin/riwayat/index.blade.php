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

        <!-- TABLE CONTAINER -->
        <div class="bg-white/95 rounded-2xl shadow-xl overflow-hidden">

            <!-- Horizontal Scroll Wrapper -->
            <div class="overflow-x-auto">
                <table class="w-full min-w-[900px]">

                    <!-- Header -->
                    <thead>
                        <tr class="bg-slate-100 border-b border-slate-200 text-slate-600 text-sm font-semibold">
                            <th class="px-6 py-4 text-left">Nama</th>
                            <th class="px-6 py-4 text-left">Asal Instansi</th>
                            <th class="px-6 py-4 text-left">Tanggal Diajukan</th>
                            <th class="px-6 py-4 text-left">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>

                    <!-- Body -->
                    <tbody class="divide-y divide-slate-200">
                        @forelse($pengajuans as $pengajuan)
                            <tr class="hover:bg-slate-50 transition">

                                <!-- Nama -->
                                <td class="px-6 py-4 font-semibold text-slate-800">
                                    {{ $pengajuan->user->username }}
                                </td>

                                <!-- Instansi -->
                                <td class="px-6 py-4 text-slate-600">
                                    {{ $pengajuan->asal_instansi }} <br>
                                    <span class="text-sm text-slate-500">
                                        {{ $pengajuan->jurusan }}
                                    </span>
                                </td>

                                <!-- Tanggal -->
                                <td class="px-6 py-4 text-slate-600">
                                    {{ $pengajuan->created_at->translatedFormat('d F Y') }}
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4">
                                    @if ($pengajuan->status === 'diterima')
                                        <span class="inline-block bg-green-100 text-green-700 text-sm font-semibold px-3 py-1 rounded-full">
                                            Diterima
                                        </span>
                                    @elseif ($pengajuan->status === 'ditolak')
                                        <span class="inline-block bg-red-100 text-red-700 text-sm font-semibold px-3 py-1 rounded-full">
                                            Ditolak
                                        </span>
                                    @endif
                                </td>

                                <!-- Aksi -->
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ url('/admin/riwayat/' . $pengajuan->id) }}"
                                       class="inline-block bg-cyan-500 hover:bg-cyan-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                                        Detail
                                    </a>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center text-slate-500">
                                    Tidak ada data riwayat pengajuan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <!-- Pagination Info + Navigation -->
    <div class="px-6 py-4 bg-slate-50 border-t border-slate-200
                flex flex-col sm:flex-row items-center justify-between gap-3
                text-sm text-slate-600">

        <!-- Info jumlah data -->
        <div>
            {{ $pengajuans->firstItem() }} – {{ $pengajuans->lastItem() }}
            dari {{ $pengajuans->total() }}
        </div>

        <!-- Navigation -->
        <div class="flex items-center gap-2">

            <!-- Previous -->
            @if ($pengajuans->onFirstPage())
                <span class="px-3 py-1 rounded-lg bg-slate-200 text-slate-400 cursor-not-allowed">
                    <i class="fa-solid fa-chevron-left"></i>
                </span>
            @else
                <a href="{{ $pengajuans->previousPageUrl() }}"
                class="px-3 py-1 rounded-lg bg-white border hover:bg-slate-100 transition">
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            @endif

            <!-- Page Number -->
            <span class="px-3 py-1 rounded-lg bg-cyan-500 text-white font-semibold">
                {{ $pengajuans->currentPage() }}
            </span>

            <!-- Next -->
            @if ($pengajuans->hasMorePages())
                <a href="{{ $pengajuans->nextPageUrl() }}"
                class="px-3 py-1 rounded-lg bg-white border hover:bg-slate-100 transition">
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            @else
                <span class="px-3 py-1 rounded-lg bg-slate-200 text-slate-400 cursor-not-allowed">
                    <i class="fa-solid fa-chevron-right"></i>
                </span>
            @endif

        </div>
    </div>


        </div>
    </div>
</div>
@endsection
