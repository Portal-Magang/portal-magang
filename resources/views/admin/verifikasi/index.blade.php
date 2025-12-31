@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-slate-950 via-blue-950 to-black p-8">
    <div class="max-w-5xl mx-auto">
        <!-- Page Title -->
        <h1 class="text-5xl font-bold text-white mb-16 text-center tracking-wide">List Pengajuan PKL/Magang</h1>

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
                            <p class="text-slate-600 text-sm">{{ $pengajuan->asal_instansi }} • {{ $pengajuan->jurusan }} • {{ $pengajuan->created_at->translatedFormat('d F Y') }}</p>
                        </div>
                    </div>
                    
                    <!-- Detail Button -->
                    <a href="/admin/verifikasi/{{ $pengajuan->id }}" class="ml-6 bg-cyan-400 hover:bg-cyan-500 text-slate-900 font-bold py-2 px-8 rounded-full transition-colors duration-200 whitespace-nowrap shadow-md hover:shadow-lg">
                        Detail
                    </a>
                </div>
            @empty
                <!-- Empty State -->
                <div class="text-center py-20">
                    <p class="text-gray-400 text-lg font-medium">Tidak ada pengajuan yang menunggu verifikasi</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
