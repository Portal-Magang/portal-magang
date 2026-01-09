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

            <!-- Pagination section -->
            <div class="px-6 py-6 border-t border-white/10 flex items-center justify-between">
                <!-- Pagination info text -->
                <div class="text-sm text-gray-400">
                    {{ $pengajuans->firstItem() ?? 0 }} - {{ $pengajuans->lastItem() ?? 0 }}
                    dari {{ $pengajuans->total() }}
                </div>

                <!-- Pagination controls -->
                <div class="flex items-center gap-2">
                    <!-- Previous button -->
                    @if($pengajuans->onFirstPage())
                        <button disabled
                            class="p-2 rounded-lg bg-slate-200 text-slate-400 cursor-not-allowed">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                    @else
                        <a href="{{ $pengajuans->previousPageUrl() }}"
                        class="p-2 rounded-lg bg-white border hover:bg-slate-100 transition">
                            <i class="fa-solid fa-chevron-left"></i>
                        </a>
                    @endif

                    <!-- Page numbers -->
                    <div class="flex items-center gap-1">
                        @for($page = 1; $page <= $pengajuans->lastPage(); $page++)
                            @if($page == $pengajuans->currentPage())
                                <span
                                    class="px-4 py-2 rounded-full bg-cyan-500 text-white font-medium text-sm">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $pengajuans->url($page) }}"
                                class="px-4 py-2 rounded-full bg-white border hover:bg-slate-100 transition text-sm">
                                    {{ $page }}
                                </a>
                            @endif
                        @endfor
                    </div>

                    <!-- Next button -->
                    @if($pengajuans->hasMorePages())
                        <a href="{{ $pengajuans->nextPageUrl() }}"
                        class="p-2 rounded-lg bg-white border hover:bg-slate-100 transition">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    @else
                        <button disabled
                            class="p-2 rounded-lg bg-slate-200 text-slate-400 cursor-not-allowed">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
