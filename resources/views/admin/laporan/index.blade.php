@extends('layouts.admin')

@section('content')
<div class="p-8 min-h-screen">

    <!-- Header & Filter -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-white mb-2">Laporan Tahunan</h1>
            <p class="text-gray-400">Data rekapitulasi pengajuan surat tahun {{ $tahun }}</p>
        </div>

        <form action="{{ url('/admin/laporan') }}" method="GET"
              class="flex items-center gap-3 bg-white/5 p-2 rounded-xl border border-white/10">
            <label class="text-sm text-gray-300 ml-2">Pilih Tahun:</label>
            <select name="tahun" onchange="this.form.submit()"
                class="bg-gray-800 text-white text-sm rounded-lg p-2 border-none">
                @foreach($rekapPerTahun as $r)
                    <option value="{{ $r->tahun }}" {{ $tahun == $r->tahun ? 'selected' : '' }}>
                        {{ $r->tahun }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <!-- STAT -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="stat-card p-4">
            <span class="stat-label">Total Pengajuan</span>
            <div class="stat-number">{{ $stats['total'] }}</div>
        </div>

        <div class="stat-card p-4 border-l-4 border-green-500">
            <span class="stat-label text-green-400">Diterima</span>
            <div class="stat-number">{{ $stats['diterima'] }}</div>
        </div>

        <div class="stat-card p-4 border-l-4 border-red-500">
            <span class="stat-label text-red-400">Ditolak</span>
            <div class="stat-number">{{ $stats['ditolak'] }}</div>
        </div>

        <div class="stat-card p-4 border-l-4 border-yellow-500">
            <span class="stat-label text-yellow-400">Menunggu</span>
            <div class="stat-number">{{ $stats['menunggu'] }}</div>
        </div>
    </div>

    <!-- TABLE -->
    <div class="bg-white/5 rounded-2xl border border-white/10 overflow-hidden">

        <a href="{{ route('admin.laporan.cetak', ['tahun' => $tahun]) }}"
   target="_blank"
   class="text-gray-300 hover:text-white flex items-center gap-2 text-sm bg-white/10 px-4 py-2 rounded-lg transition">
    <i class="fa-solid fa-print"></i> Cetak Laporan
</a>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-white/5 text-gray-400 text-xs uppercase">
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Nama Peserta</th>
                        <th class="px-6 py-4">Instansi</th>
                        <th class="px-6 py-4">Jurusan</th>
                        <th class="px-6 py-4 text-center">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-white/5">
                    @forelse($dataLaporan as $i => $item)
                        <tr class="hover:bg-white/5 text-gray-300 text-sm">
                            <td class="px-6 py-4">{{ $i + 1 }}</td>

                            <td class="px-6 py-4">
                                {{ $item->created_at->translatedFormat('d M Y') }}
                            </td>

                            <!-- NAMA PESERTA -->
                            <td class="px-6 py-4 font-medium text-white">
                                    {{ $item->user->username}}
                            </td>

                            <td class="px-6 py-4">
                                {{ $item->asal_instansi }}
                            </td>

                            <!-- JURUSAN -->
                            <td class="px-6 py-4">
                                @foreach($item->peserta as $p)
                                    {{ $p->jurusan }}@if(!$loop->last), @endif
                                @endforeach
                            </td>

                            <!-- STATUS -->
                            <td class="px-6 py-4 text-center">
                                @if($item->status === 'diterima')
                                    <span class="px-3 py-1 rounded-full text-xs bg-green-500/20 text-green-400">
                                        Diterima
                                    </span>
                                @elseif($item->status === 'ditolak')
                                    <span class="px-3 py-1 rounded-full text-xs bg-red-500/20 text-red-400">
                                        Ditolak
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs bg-yellow-500/20 text-yellow-400">
                                        Menunggu
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-500 italic">
                                Tidak ada data laporan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
