@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-slate-950 via-blue-950 to-black p-8">
    <div class="max-w-6xl mx-auto">

        <!-- Title -->
        <h1 class="text-4xl font-bold text-white mb-10 text-center">
            Detail Pengajuan PKL / Magang
        </h1>

        <!-- INFO PENGAJUAN -->
        <div class="bg-white/95 rounded-2xl shadow-xl mb-8 overflow-hidden">

            <div class="grid grid-cols-2 gap-6 px-8 py-6 text-sm text-slate-700">
                <div>
                    <p class="text-slate-500">Asal Instansi</p>
                    <p class="font-semibold">{{ $pengajuan->asal_instansi }}</p>
                </div>

                <div>
                    <p class="text-slate-500">Email Pengaju</p>
                    <p class="font-semibold">{{ $pengajuan->user->email }}</p>
                </div>

                <div>
                    <p class="text-slate-500">Tanggal Pengajuan</p>
                    <p class="font-semibold">
                        {{ $pengajuan->created_at->translatedFormat('d F Y') }}
                    </p>
                </div>

                <div>
                    <p class="text-slate-500">Surat Pengantar</p>
                    <a href="{{ route('pengajuan.surat.preview', $pengajuan->id) }}"
                       target="_blank"
                       class="text-cyan-600 font-semibold hover:underline">
                        📄 Lihat Surat
                    </a>
                </div>
            </div>

        </div>

        <!-- LIST PESERTA -->
        <div class="bg-white/95 rounded-2xl shadow-xl overflow-hidden mb-10">

            <!-- Header -->
            <div class="grid grid-cols-12 px-6 py-4 bg-slate-100 text-slate-600 text-sm font-semibold">
                <div class="col-span-1 text-center">No</div>
                <div class="col-span-4">Nama</div>
                <div class="col-span-4">Jurusan</div>
                <div class="col-span-3">No. Telepon / whatsApp</div>
            </div>

            <!-- Rows -->
            @forelse ($pengajuan->peserta as $index => $p)
                <div class="grid grid-cols-12 px-6 py-4 border-t hover:bg-slate-50 transition">
                    <div class="col-span-1 text-center text-slate-600">
                        {{ $index + 1 }}
                    </div>

                    <div class="col-span-4 font-semibold text-slate-800">
                        {{ $p->nama_pengaju }}
                    </div>

                    <div class="col-span-4 text-slate-600">
                        {{ $p->jurusan }}
                    </div>

                    <div class="col-span-3 text-slate-600">
                        {{ $p->no_hp }}
                    </div>
                </div>
            @empty
                <div class="text-center py-10 text-slate-500">
                    Tidak ada data peserta
                </div>
            @endforelse

        </div>

        <!-- FORM VERIFIKASI -->
        <div class="bg-white rounded-2xl shadow-lg p-8">

            <form method="POST" action="/admin/verifikasi/{{ $pengajuan->id }}" class="space-y-6">
                @csrf

                <!-- Status -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Status Pengajuan
                    </label>
                    <select name="status" required
                        class="w-full rounded-lg border border-gray-300 px-4 py-3
                               focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <option value="">-- Pilih Keputusan --</option>
                        <option value="diterima">Terima</option>
                        <option value="ditolak">Tolak</option>
                    </select>
                </div>

                <!-- Catatan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Catatan Admin <span class="text-red-500">*</span>
                    </label>

                    <textarea name="catatan_admin" rows="4"
                        class="w-full rounded-lg border p-3
                        {{ $errors->has('catatan_admin')
                            ? 'border-red-500 focus:border-red-500 focus:ring-red-200'
                            : 'border-gray-300 focus:border-blue-500 focus:ring-blue-200' }}
                        focus:ring"
                        placeholder="Wajib diisi jika pengajuan ditolak">{{ old('catatan_admin') }}</textarea>

                    @error('catatan_admin')
                        <p class="text-sm text-red-600 mt-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Button -->
                <div class="flex justify-end gap-3">
                    <a href="{{ url()->previous() }}"
                        class="px-6 py-2 rounded-lg bg-gray-200 text-gray-700 font-medium hover:bg-gray-300 transition">
                        Kembali
                    </a>

                    <button type="submit"
                        class="px-6 py-2 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">
                        Simpan Keputusan
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
