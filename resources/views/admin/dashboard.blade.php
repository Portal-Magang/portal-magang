@extends('layouts.admin')

@section('content')
<div class="flex-1 p-12">

    <!-- Page Title -->
    <h1 class="text-5xl font-bold text-white mb-12">
        Dashboard
    </h1>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 gap-6 max-w-2xl">

        <!-- Belum Diverifikasi -->
        <div class="stat-card p-8">
            <p class="stat-label mb-2">
                Jumlah Surat Belum Diverifikasi
            </p>
            <p class="stat-number">
                {{ $baru }}
            </p>
        </div>

        <!-- Diterima -->
        <div class="stat-card p-8">
            <p class="stat-label mb-2">
                Jumlah Surat Diterima
            </p>
            <p class="stat-number">
                {{ $diterima }}
            </p>
        </div>

        <!-- Ditolak -->
        <div class="stat-card p-8">
            <p class="stat-label mb-2">
                Jumlah Surat Ditolak
            </p>
            <p class="stat-number">
                {{ $ditolak }}
            </p>
        </div>

    </div>
</div>
@endsection
