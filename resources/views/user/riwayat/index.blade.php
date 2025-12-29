@extends('layouts.app')

@section('content')
<div class="p-8 min-h-screen">
    <!-- Page Header -->
    <div class="mb-12">
        <h1 class="text-4xl font-bold text-white text-center">Riwayat Pengajuan</h1>
    </div>

    <!-- Riwayat List -->
    <div class="max-w-4xl mx-auto space-y-4">
        @forelse($pengajuans as $pengajuan)
            <div class="bg-white rounded-2xl p-6 flex items-center justify-between shadow-lg hover:shadow-xl transition-shadow">
                <!-- Left Content -->
                <div class="flex-1">
                    <div class="flex items-center gap-4">
                        <div>
                            <!-- Name -->
                            <p class="text-lg font-bold text-gray-800 mb-2">{{ $pengajuan->user->name }}</p>
                            
                            <!-- Institution and Major -->
                            <div class="text-sm text-gray-600 space-y-1">
                                <p><span class="font-semibold">Catatan Instansi:</span> {{ $pengajuan->catatan_admin }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Badge -->
                <div>
                    @if($pengajuan->status === 'diterima')
                        <span class="inline-block px-6 py-2 bg-cyan-300 text-gray-900 font-bold rounded-full text-sm">
                            Diterima
                        </span>
                    @elseif($pengajuan->status === 'ditolak')
                        <span class="inline-block px-6 py-2 bg-red-400 text-white font-bold rounded-full text-sm">
                            Ditolak
                        </span>
                    @else
                        <span class="inline-block px-6 py-2 bg-yellow-300 text-gray-900 font-bold rounded-full text-sm">
                            Menunggu
                        </span>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <p class="text-white text-lg">Belum ada riwayat pengajuan</p>
            </div>
        @endforelse
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .max-w-4xl {
            padding-left: 1rem;
            padding-right: 1rem;
        }
    }
</style>
@endsection
