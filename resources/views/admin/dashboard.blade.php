@extends('layouts.admin')

@section('content')
<div class="flex-1 p-12">

    <!-- Page Title -->
    <h1 class="text-5xl font-bold text-white mb-12">
        Dashboard
    </h1>

    <!-- Statistics Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl">

        <!-- Diterima Card - Green -->
        <a href="{{ url('/admin/riwayat?status=diterima') }}" class="stat-card p-8 border-t-4 border-green-400 hover:border-green-300 cursor-pointer">
            <p class="stat-label mb-4 text-green-400">
                Diterima
            </p>
            <p class="stat-number">
                {{ $diterima }}
            </p>
        </a>

        <!-- Ditolak Card - Red -->
        <a href="{{ url('/admin/riwayat?status=ditolak') }}" class="stat-card p-8 border-t-4 border-red-400 hover:border-red-300 cursor-pointer">
            <p class="stat-label mb-4 text-red-400">
                Ditolak
            </p>
            <p class="stat-number">
                {{ $ditolak }}
            </p>
        </a>

        <!-- Menunggu Card - Yellow -->
        <a href="{{ url('/admin/verifikasi') }}" class="stat-card p-8 border-t-4 border-yellow-400 hover:border-yellow-300 cursor-pointer">
            <p class="stat-label mb-4 text-yellow-400">
                Menunggu
            </p>
            <p class="stat-number">
                {{ $baru }}
            </p>
        </a>

        <!-- Total Pengajuan Card - Blue -->
        <a class="stat-card p-8 border-t-4 border-blue-400">
            <p class="stat-label mb-4">
                Total Pengajuan
            </p>
            <p class="stat-number">
                {{ $totalSurat }}
            </p>
        </a>

        <!-- Total User Card - Purple -->
        <div class="stat-card p-8 border-t-4 border-purple-400">
            <p class="stat-label mb-4 text-purple-400">
                Total User
            </p>
            <p class="stat-number">
                {{ $totalUsers }}
            </p>
        </div>

        <!-- Total Peserta Card - Indigo -->
        <div class="stat-card p-8 border-t-4 border-indigo-400">
            <p class="stat-label mb-4 text-indigo-400">
                Total Peserta
            </p>
            <p class="stat-number">
                {{ $totalPeserta }}
            </p>
        </div>

    </div>
</div>
@endsection
