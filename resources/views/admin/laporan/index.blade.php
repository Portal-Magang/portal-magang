@extends('layouts.admin')

@section('content')
<div class="p-8 min-h-screen">

    <!-- Header & Filter -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-white mb-2">Laporan Tahunan</h1>
            <p class="text-gray-400">Data rekapitulasi pengajuan surat tahun {{ $tahun ?? 'Semua' }}</p>
        </div>

        <form action="{{ url('/admin/laporan') }}" method="GET"
              class="flex items-center gap-3 bg-white/5 p-2 rounded-xl border border-white/10">
            <label class="text-sm text-gray-300 ml-2">Pilih Tahun:</label>
            <select name="tahun" onchange="this.form.submit()"
                class="bg-gray-800 text-white text-sm rounded-lg p-2 border-none">
                <!-- Added option for semua tahun as default -->
                <option value="">Semua Tahun</option>
                @foreach($rekapPerTahun as $r)
                    <option value="{{ $r->tahun }}" {{ $tahun == $r->tahun ? 'selected' : '' }}>
                        {{ $r->tahun }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <!-- Removed stat cards section from laporan page -->

    <!-- TABLE -->
    <div class="bg-white/5 rounded-2xl border border-white/10 overflow-hidden">

        <!-- Updated cetak button - disabled if no tahun selected, enabled if tahun is selected -->
        @if($tahun)
            <a href="{{ route('admin.laporan.cetak', ['tahun' => $tahun]) }}"
       target="_blank"
       class="text-gray-300 hover:text-white flex items-center gap-2 text-sm bg-white/10 px-4 py-2 rounded-lg transition">
        <i class="fa-solid fa-print"></i> Cetak Laporan
    </a>
        @else
            <button disabled
       class="text-gray-500 flex items-center gap-2 text-sm bg-gray-700/50 px-4 py-2 rounded-lg cursor-not-allowed">
        <i class="fa-solid fa-print"></i> Cetak Laporan
    </button>
            <p class="text-xs text-gray-400 px-4 pt-2">* Pilih tahun terlebih dahulu untuk mencetak laporan</p>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-white/5 text-gray-400 text-xs uppercase">
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Nama Pengaju</th>
                        <th class="px-6 py-4">Instansi</th>
                        <th class="px-6 py-4">Jurusan</th>
                        <th class="px-6 py-4 text-center">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-white/5">
                    @forelse($dataLaporan as $i => $item)
                        <tr class="hover:bg-white/5 text-gray-300 text-sm">
                            <td class="px-6 py-4">{{ ($dataLaporan->currentPage() - 1) * 10 + $i + 1 }}</td>

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

        <!-- Pagination section -->
        <div class="px-6 py-6 border-t border-white/10 flex items-center justify-between">
            <!-- Pagination info text -->
            <div class="text-sm text-gray-400">
                {{ $dataLaporan->firstItem() ?? 0 }} - {{ $dataLaporan->lastItem() ?? 0 }} dari {{ $dataLaporan->total() }}
            </div>

            <!-- Pagination controls -->
            <div class="flex items-center gap-2">
                <!-- Previous button -->
                @if($dataLaporan->onFirstPage())
                    <button disabled class="p-2 rounded-lg bg-gray-700 text-gray-500 cursor-not-allowed">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                @else
                    <a href="{{ $dataLaporan->previousPageUrl() }}" class="p-2 rounded-lg bg-gray-700 text-gray-300 hover:bg-gray-600 transition">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                @endif

                <!-- Page numbers -->
                <div class="flex items-center gap-1">
                    @for($page = 1; $page <= $dataLaporan->lastPage(); $page++)
                        @if($page == $dataLaporan->currentPage())
                            <button class="px-4 py-2 rounded-full bg-cyan-500 text-white font-medium text-sm">
                                {{ $page }}
                            </button>
                        @else
                            <a href="{{ $dataLaporan->url($page) }}" class="px-4 py-2 rounded-full bg-gray-700 text-gray-300 hover:bg-gray-600 transition text-sm">
                                {{ $page }}
                            </a>
                        @endif
                    @endfor
                </div>

                <!-- Next button -->
                @if($dataLaporan->hasMorePages())
                    <a href="{{ $dataLaporan->nextPageUrl() }}" class="p-2 rounded-lg bg-gray-700 text-gray-300 hover:bg-gray-600 transition">
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                @else
                    <button disabled class="p-2 rounded-lg bg-gray-700 text-gray-500 cursor-not-allowed">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
