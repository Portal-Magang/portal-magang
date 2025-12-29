@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-slate-950 via-blue-950 to-black p-8">
    <div class="max-w-5xl mx-auto">
        <!-- Page Title -->
        <h1 class="text-5xl font-bold text-white mb-8 text-center tracking-wide">Riwayat Pengajuan PKL/Magang</h1>

        <!-- Filter Status -->
        <div class="flex gap-4 mb-8 justify-center flex-wrap">
            <a href="{{ url('/admin/riwayat') }}" 
               class="px-6 py-2 rounded-full font-semibold transition-all {{ !request('status') ? 'bg-cyan-400 text-slate-900' : 'bg-slate-600 text-white hover:bg-slate-500' }}">
                Semua
            </a>
            <a href="{{ url('/admin/riwayat?status=diterima') }}" 
               class="px-6 py-2 rounded-full font-semibold transition-all {{ request('status') === 'diterima' ? 'bg-green-400 text-slate-900' : 'bg-slate-600 text-white hover:bg-slate-500' }}">
                Diterima
            </a>
            <a href="{{ url('/admin/riwayat?status=ditolak') }}" 
               class="px-6 py-2 rounded-full font-semibold transition-all {{ request('status') === 'ditolak' ? 'bg-red-400 text-slate-900' : 'bg-slate-600 text-white hover:bg-slate-500' }}">
                Ditolak
            </a>
        </div>

        <!-- Pengajuan List Container -->
        <div class="space-y-5">
            @forelse($pengajuans as $pengajuan)
                <!-- List Item Card -->
                <div class="bg-white rounded-3xl px-8 py-6 flex items-center justify-between shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-101">
                    <!-- Left Content -->
                    <div class="flex-1">
                        <div class="flex flex-col gap-1">
                            <!-- Applicant Name -->
                            <h2 class="text-slate-800 text-xl font-semibold">{{ $pengajuan->user->name }}</h2>
                            <!-- Institution & Major -->
                            <p class="text-slate-600 text-sm">{{ $pengajuan->asal_instansi }} • {{ $pengajuan->jurusan }}</p>
                        </div>
                    </div>

                    <!-- Status Badge -->
                    <div class="mx-6">
                        @if($pengajuan->status === 'diterima')
                            <span class="bg-green-400 text-slate-900 font-bold py-2 px-6 rounded-full text-sm">
                                ✅ Diterima
                            </span>
                        @elseif($pengajuan->status === 'ditolak')
                            <span class="bg-red-400 text-white font-bold py-2 px-6 rounded-full text-sm">
                                ❌ Ditolak
                            </span>
                        @else
                            <span class="bg-yellow-400 text-slate-900 font-bold py-2 px-6 rounded-full text-sm">
                                ⏳ Menunggu
                            </span>
                        @endif
                    </div>
                    
                    <!-- Detail Button -->
                    <a href="/admin/riwayat/{{ $pengajuan->id }}" class="ml-6 bg-cyan-400 hover:bg-cyan-500 text-slate-900 font-bold py-2 px-8 rounded-full transition-colors duration-200 whitespace-nowrap shadow-md hover:shadow-lg">
                        Detail
                    </a>
                </div>
            @empty
                <!-- Empty State -->
                <div class="text-center py-20">
                    <p class="text-gray-400 text-lg font-medium">Tidak ada data riwayat pengajuan</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
