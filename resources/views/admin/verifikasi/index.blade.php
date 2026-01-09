@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-slate-950 via-blue-950 to-black p-8">
    <div class="max-w-6xl mx-auto">

        <!-- Page Title -->
        <h1 class="text-4xl font-bold text-white mb-12 text-center tracking-wide">
            List Pengajuan PKL / Magang
        </h1>

        <!-- Wrapper untuk horizontal scroll dengan styling -->
        <div class="w-full bg-white/95 rounded-2xl shadow-xl overflow-hidden">
            
            <!-- Table container dengan overflow-x-auto untuk horizontal scroll -->
            <div class="overflow-x-auto">
                <table class="w-full min-w-[800px]">
                    <!-- Header -->
                    <thead>
                        <tr class="bg-slate-100 border-b border-slate-200">
                            <th class="px-6 py-4 text-left text-slate-700 font-semibold text-sm">Nama</th>
                            <th class="px-6 py-4 text-left text-slate-700 font-semibold text-sm">Asal Instansi</th>
                            <th class="px-6 py-4 text-left text-slate-700 font-semibold text-sm">Tanggal Pengajuan</th>
                            <th class="px-6 py-4 text-right text-slate-700 font-semibold text-sm">Aksi</th>
                        </tr>
                    </thead>

                    <!-- Data Rows -->
                    <tbody class="divide-y divide-slate-200">
                        @forelse($pengajuans as $pengajuan)
                            <tr class="hover:bg-slate-50 transition duration-200">
                                <!-- Nama -->
                                <td class="px-6 py-4 text-slate-800 font-medium">
                                    {{ $pengajuan->user->username }}
                                </td>

                                <!-- Asal Instansi -->
                                <td class="px-6 py-4 text-slate-600">
                                    {{ $pengajuan->asal_instansi }}
                                </td>

                                <!-- Tanggal Pengajuan -->
                                <td class="px-6 py-4 text-slate-600">
                                    {{ $pengajuan->created_at->translatedFormat('d F Y') }}
                                </td>

                                <!-- Aksi -->
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ url('/admin/verifikasi/' . $pengajuan->id) }}"
                                       class="inline-block bg-cyan-500 hover:bg-cyan-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition duration-200">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-16 text-center text-slate-500 text-sm">
                                    Tidak ada pengajuan yang menunggu verifikasi
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
                    {{ $pengajuans->firstItem() ?? 0 }} - {{ $pengajuans->lastItem() ?? 0 }} dari {{ $pengajuans->total() }}
                </div>

                <!-- Pagination controls -->
                <div class="flex items-center gap-2">
                    <!-- Previous button -->
                    @if($pengajuans->onFirstPage())
                        <button disabled class="p-2 rounded-lg bg-slate-200 text-slate-400 cursor-not-allowed">
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
                                <span class="px-4 py-2 rounded-full bg-cyan-500 text-white font-medium text-sm">
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
                        <button disabled class="p-2 rounded-lg bg-slate-200 text-slate-400 cursor-not-allowed">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection