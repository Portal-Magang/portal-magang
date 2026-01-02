@extends('layouts.admin')

@section('content')
<div class="p-8 min-h-screen">
    <!-- Header & Filter -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-white mb-2">Laporan Tahunan</h1>
            <p class="text-gray-400">Data rekapitulasi pengajuan surat tahun {{ $tahun }}</p>
        </div>
        
        <form action="{{ url('/admin/laporan') }}" method="GET" class="flex items-center gap-3 bg-white/5 p-2 rounded-xl border border-white/10">
            <label for="tahun" class="text-sm font-medium text-gray-300 ml-2">Pilih Tahun:</label>
            <select name="tahun" id="tahun" onchange="this.form.submit()" 
                class="bg-gray-800 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2 border-none">
                @foreach($rekapPerTahun as $r)
                    <option value="{{ $r->tahun }}" {{ $tahun == $r->tahun ? 'selected' : '' }}>{{ $r->tahun }}</option>
                @endforeach
                @if(!$rekapPerTahun->contains('tahun', now()->year))
                    <option value="{{ now()->year }}" {{ $tahun == now()->year ? 'selected' : '' }}>{{ now()->year }}</option>
                @endif
            </select>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition">
                <i class="fa-solid fa-filter mr-2"></i>Filter
            </button>
        </form>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="stat-card p-6">
            <div class="flex items-center justify-between mb-4">
                <span class="stat-label">Total Pengajuan</span>
                <i class="fa-solid fa-file-invoice text-blue-400 text-2xl"></i>
            </div>
            <div class="stat-number">{{ $stats['total'] }}</div>
            <div class="text-xs text-gray-500 mt-2">Seluruh data masuk tahun {{ $tahun }}</div>
        </div>
        
        <div class="stat-card p-6 border-l-4 border-l-green-500">
            <div class="flex items-center justify-between mb-4">
                <span class="stat-label text-green-400">Diterima</span>
                <i class="fa-solid fa-circle-check text-green-500 text-2xl"></i>
            </div>
            <div class="stat-number">{{ $stats['diterima'] }}</div>
        </div>

        <div class="stat-card p-6 border-l-4 border-l-red-500">
            <div class="flex items-center justify-between mb-4">
                <span class="stat-label text-red-400">Ditolak</span>
                <i class="fa-solid fa-circle-xmark text-red-500 text-2xl"></i>
            </div>
            <div class="stat-number">{{ $stats['ditolak'] }}</div>
        </div>

        <div class="stat-card p-6 border-l-4 border-l-yellow-500">
            <div class="flex items-center justify-between mb-4">
                <span class="stat-label text-yellow-400">Menunggu</span>
                <i class="fa-solid fa-clock text-yellow-500 text-2xl"></i>
            </div>
            <div class="stat-number">{{ $stats['menunggu'] }}</div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="bg-white/5 rounded-2xl border border-white/10 overflow-hidden backdrop-blur-sm">
        <div class="p-6 border-b border-white/10 flex justify-between items-center bg-white/5">
            <h2 class="text-xl font-semibold text-white">Detail Laporan {{ $tahun }}</h2>
            <button onclick="window.print()" class="text-gray-300 hover:text-white flex items-center gap-2 text-sm bg-white/10 px-4 py-2 rounded-lg transition">
                <i class="fa-solid fa-print"></i> Cetak Laporan
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white/5 text-gray-400 text-xs uppercase tracking-wider font-semibold">
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Tgl Pengajuan</th>
                        <th class="px-6 py-4">Nama Pemohon</th>
                        <th class="px-6 py-4">Instansi/Sekolah</th>
                        <th class="px-6 py-4">Jurusan</th>
                        <th class="px-6 py-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($dataLaporan as $index => $item)
                        <tr class="hover:bg-white/5 transition text-gray-300 text-sm">
                            <td class="px-6 py-4">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">{{ $item->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 font-medium text-white">{{ $item->user->name ?? 'User' }}</td>
                            <td class="px-6 py-4">{{ $item->asal_instansi }}</td>
                            <td class="px-6 py-4">{{ $item->jurusan }}</td>
                            <td class="px-6 py-4 text-center">
                                @if($item->status == 'diterima')
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-500/10 text-green-400 border border-green-500/20">Diterima</span>
                                @elseif($item->status == 'ditolak')
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-500/10 text-red-400 border border-red-500/20">Ditolak</span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-500/10 text-yellow-400 border border-yellow-500/20">Menunggu</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500 italic">
                                <div class="flex flex-col items-center">
                                    <i class="fa-solid fa-folder-open text-4xl mb-4 opacity-20"></i>
                                    Belum ada data pengajuan untuk tahun {{ $tahun }}
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    @media print {
        .sidebar, form, button { display: none !important; }
        body { background: white !important; color: black !important; }
        .stat-card { border: 1px solid #ccc !important; background: none !important; }
        .stat-number, .stat-label { color: black !important; }
        .bg-white\/5 { background: none !important; }
        table { color: black !important; border: 1px solid #eee !important; }
        th { background-color: #f3f4f6 !important; color: black !important; }
        td { border-bottom: 1px solid #eee !important; color: black !important; }
        .text-white { color: black !important; }
    }
</style>
@endsection
