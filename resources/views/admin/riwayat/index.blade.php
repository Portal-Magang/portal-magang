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

        <!-- TABLE -->
        <div class="bg-white/95 rounded-2xl shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[900px]">
                    <thead>
                        <tr class="bg-slate-100 border-b text-slate-600 text-sm font-semibold">
                            <th class="px-6 py-4 text-left">Nama</th>
                            <th class="px-6 py-4 text-left">Asal Instansi</th>
                            <th class="px-6 py-4 text-left">Tanggal Diajukan</th>
                            <th class="px-6 py-4 text-left">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @forelse($pengajuans as $pengajuan)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 font-semibold">
                                    {{ $pengajuan->user->username }}
                                </td>

                                <td class="px-6 py-4 text-slate-600">
                                    {{ $pengajuan->asal_instansi }}<br>
                                    <span class="text-sm text-slate-500">{{ $pengajuan->jurusan }}</span>
                                </td>

                                <td class="px-6 py-4 text-slate-600">
                                    {{ $pengajuan->created_at->translatedFormat('d F Y') }}
                                </td>

                                <td class="px-6 py-4">
                                    @if ($pengajuan->status === 'diterima')
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">Diterima</span>
                                    @else
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">Ditolak</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <a href="{{ url('/admin/riwayat/'.$pengajuan->id) }}"
                                       class="bg-cyan-500 hover:bg-cyan-600 text-white px-4 py-2 rounded-lg text-sm font-semibold">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-16 text-center text-slate-500">
                                    Tidak ada data
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            @php
                $current = $pengajuans->currentPage();
                $last = $pengajuans->lastPage();
                $start = max(1, $current - 2);
                $end = min($last, $current + 2);
            @endphp

            <div class="px-6 py-6 border-t flex justify-between items-center">
                <div class="text-sm text-gray-400">
                    {{ $pengajuans->firstItem() ?? 0 }} - {{ $pengajuans->lastItem() ?? 0 }}
                    dari {{ $pengajuans->total() }}
                </div>

                <div class="flex items-center gap-2">
                    {{-- Prev --}}
                    @if($pengajuans->onFirstPage())
                        <button disabled class="p-2 bg-slate-200 rounded-lg text-slate-400">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                    @else
                        <a href="{{ $pengajuans->previousPageUrl() }}" class="p-2 bg-white border rounded-lg">
                            <i class="fa-solid fa-chevron-left"></i>
                        </a>
                    @endif

                    {{-- First --}}
                    @if($start > 1)
                        <a href="{{ $pengajuans->url(1) }}" class="px-4 py-2 rounded-full bg-white border text-sm">1</a>
                        <span class="px-2 text-gray-400">…</span>
                    @endif

                    {{-- Pages --}}
                    @for($i = $start; $i <= $end; $i++)
                        @if($i == $current)
                            <span class="px-4 py-2 rounded-full bg-cyan-500 text-white text-sm font-semibold">{{ $i }}</span>
                        @else
                            <a href="{{ $pengajuans->url($i) }}"
                               class="px-4 py-2 rounded-full bg-white border text-sm hover:bg-slate-100">
                                {{ $i }}
                            </a>
                        @endif
                    @endfor

                    {{-- Last --}}
                    @if($end < $last)
                        <span class="px-2 text-gray-400">…</span>
                        <a href="{{ $pengajuans->url($last) }}" class="px-4 py-2 rounded-full bg-white border text-sm">
                            {{ $last }}
                        </a>
                    @endif

                    {{-- Next --}}
                    @if($pengajuans->hasMorePages())
                        <a href="{{ $pengajuans->nextPageUrl() }}" class="p-2 bg-white border rounded-lg">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    @else
                        <button disabled class="p-2 bg-slate-200 rounded-lg text-slate-400">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
