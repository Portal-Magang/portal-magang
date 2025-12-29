@extends('layouts.app')

@section('content')
<div class="p-8 min-h-screen">
    <!-- Page Header -->
    <div class="mb-12">
        <h1 class="text-4xl font-bold text-white text-center">Detail</h1>
    </div>

    <!-- Detail Card -->
    <div class="max-w-2xl mx-auto bg-white rounded-2xl p-8 shadow-lg">
        <div class="space-y-6">
            <!-- Nama -->
            <div class="flex items-start gap-4">
                <span class="font-semibold text-gray-800 min-w-fit">Nama:</span>
                <p class="text-gray-700">{{ $pengajuan->user->name }}</p>
            </div>

            <!-- Email -->
            <div class="flex items-start gap-4">
                <span class="font-semibold text-gray-800 min-w-fit">E-mail:</span>
                <p class="text-gray-700">{{ $pengajuan->user->email }}</p>
            </div>

            <!-- Nomor Telepon -->
            <div class="flex items-start gap-4">
                <span class="font-semibold text-gray-800 min-w-fit">No. Telp:</span>
                <p class="text-gray-700">{{ $pengajuan->no_hp }}</p>
            </div>

            <!-- Asal Instansi -->
            <div class="flex items-start gap-4">
                <span class="font-semibold text-gray-800 min-w-fit">Asal Instansi:</span>
                <p class="text-gray-700">{{ $pengajuan->asal_instansi }}</p>
            </div>

            <!-- Jurusan -->
            <div class="flex items-start gap-4">
                <span class="font-semibold text-gray-800 min-w-fit">Jurusan:</span>
                <p class="text-gray-700">{{ $pengajuan->jurusan }}</p>
            </div>

            <!-- Surat Pengantar -->
            <div class="flex items-start gap-4">
                <span class="font-semibold text-gray-800 min-w-fit">Surat Pengantar:</span>
                <div class="flex items-center gap-2">
                    @if($pengajuan->surat_pengantar)
                        <a href="{{ asset('storage/' . $pengajuan->surat_pengantar) }}" 
                           target="_blank"
                           class="inline-flex items-center gap-2 text-cyan-500 hover:text-cyan-600 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>
                            <span class="underline">Unduh</span>
                        </a>
                    @else
                        <p class="text-gray-500">Tidak ada file</p>
                    @endif
                </div>
            </div>

            <!-- Status -->
            <div class="flex items-start gap-4 pt-4 border-t border-gray-200">
                <span class="font-semibold text-gray-800 min-w-fit">Status:</span>
                <div>
                    @if($pengajuan->status === 'diterima')
                        <span class="inline-block px-4 py-2 bg-cyan-300 text-gray-900 font-semibold rounded-full text-sm">
                            Diterima
                        </span>
                    @elseif($pengajuan->status === 'ditolak')
                        <span class="inline-block px-4 py-2 bg-red-400 text-white font-semibold rounded-full text-sm">
                            Ditolak
                        </span>
                    @else
                        <span class="inline-block px-4 py-2 bg-yellow-300 text-gray-900 font-semibold rounded-full text-sm">
                            Menunggu
                        </span>
                    @endif
                </div>
            </div>

            <!-- Catatan Admin (jika ada) -->
            @if($pengajuan->catatan_admin)
                <div class="pt-4 border-t border-gray-200">
                    <span class="font-semibold text-gray-800 block mb-2">Catatan Admin:</span>
                    <p class="text-gray-700 bg-gray-50 p-4 rounded-lg">{{ $pengajuan->catatan_admin }}</p>
                </div>
            @endif
        </div>

        <!-- Back Button -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <a href="{{ url('/user/riwayat') }}" 
               class="inline-flex items-center gap-2 px-6 py-2 bg-gray-200 text-gray-800 font-semibold rounded-lg hover:bg-gray-300 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                <span>Kembali</span>
            </a>
        </div>
    </div>
</div>
@endsection
