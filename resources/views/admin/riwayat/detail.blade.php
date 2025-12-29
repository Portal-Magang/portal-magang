@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-slate-950 via-blue-950 to-black p-8">
    <div class="max-w-4xl mx-auto">

        <!-- Title -->
        <h1 class="text-4xl font-bold text-white mb-12 text-center tracking-wide">Detail Riwayat Pengajuan</h1>

        <!-- Card Detail -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">

                <div>
                    <p class="text-sm text-gray-500 font-semibold uppercase tracking-wide">Nama</p>
                    <p class="font-semibold text-lg mt-1">{{ $pengajuan->user->name }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 font-semibold uppercase tracking-wide">Email</p>
                    <p class="font-semibold text-lg mt-1">{{ $pengajuan->user->email }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 font-semibold uppercase tracking-wide">Asal Instansi</p>
                    <p class="font-semibold text-lg mt-1">{{ $pengajuan->asal_instansi }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 font-semibold uppercase tracking-wide">Jurusan</p>
                    <p class="font-semibold text-lg mt-1">{{ $pengajuan->jurusan }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 font-semibold uppercase tracking-wide">No. HP</p>
                    <p class="font-semibold text-lg mt-1">{{ $pengajuan->no_hp }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 font-semibold uppercase tracking-wide">Surat Pengantar</p>
                    <a href="{{ route('pengajuan.surat.preview', $pengajuan->id) }}"
                       target="_blank"
                       class="inline-flex items-center gap-2 text-blue-600 hover:underline font-semibold text-lg mt-1">
                        📄 Lihat Surat
                    </a>
                </div>

                <!-- Add status badge -->
                <div>
                    <p class="text-sm text-gray-500 font-semibold uppercase tracking-wide">Status</p>
                    <div class="mt-2">
                        @if($pengajuan->status === 'diterima')
                            <span class="bg-green-400 text-slate-900 font-bold py-2 px-4 rounded-lg text-sm inline-block">
                                Diterima
                            </span>
                        @else($pengajuan->status === 'ditolak')
                            <span class="bg-red-400 text-white font-bold py-2 px-4 rounded-lg text-sm inline-block">
                                Ditolak
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Add catatan admin if exists -->
                @if($pengajuan->catatan_admin)
                <div class="md:col-span-2">
                    <p class="text-sm text-gray-500 font-semibold uppercase tracking-wide">Catatan Admin</p>
                    <p class="font-semibold text-lg mt-1 text-gray-600">{{ $pengajuan->catatan_admin }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Back Button -->
        <div class="flex justify-end">
            <a href="{{ url('/admin/riwayat') }}"
               class="px-6 py-2 rounded-lg bg-cyan-400 text-slate-900 font-semibold hover:bg-cyan-500 transition">
                Kembali
            </a>
        </div>

    </div>
</div>
@endsection
