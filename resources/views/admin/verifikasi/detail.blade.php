@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">

    <!-- Title -->
    <h2 class="text-3xl font-bold text-white mt-5 mb-8">
        Detail Pengajuan
    </h2>

    <!-- Card Detail -->
    <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">

            <div>
                <p class="text-sm text-gray-500">Nama</p>
                <p class="font-semibold">{{ $pengajuan->user->name }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Email</p>
                <p class="font-semibold">{{ $pengajuan->user->email }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Asal Instansi</p>
                <p class="font-semibold">{{ $pengajuan->asal_instansi }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Jurusan</p>
                <p class="font-semibold">{{ $pengajuan->jurusan }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">No. HP</p>
                <p class="font-semibold">{{ $pengajuan->no_hp }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Surat Pengantar</p>
                <a href="{{ route('pengajuan.surat.preview', $pengajuan->id) }}" 
                   target="_blank"
                   class="inline-flex items-center gap-2 text-blue-600 hover:underline font-medium">
                    📄 Lihat Surat
                </a>
            </div>

        </div>
    </div>

    <!-- Card Form -->
    <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">

        <form method="POST" action="/admin/verifikasi/{{ $pengajuan->id }}" class="space-y-6">
            @csrf

            <!-- Status -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Status Pengajuan
                </label>
                <select name="status" required
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <option value="">-- Pilih Keputusan --</option>
                    <option value="diterima">Terima</option>
                    <option value="ditolak">Tolak</option>
                </select>
            </div>

            <!-- Catatan -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Catatan Admin
                </label>
                <textarea name="catatan_admin" rows="4"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200"
                    placeholder="Tulis catatan (opsional)..."></textarea>
            </div>

            <!-- Button -->
            <div class="flex justify-end gap-3">
                <a href="{{ url()->previous() }}"
                   class="px-6 py-2 rounded-lg bg-gray-200 text-gray-700 font-medium hover:bg-gray-300 transition">
                    Batal
                </a>

                <button type="submit"
                    class="px-6 py-2 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">
                    Simpan Keputusan
                </button>
            </div>

        </form>
    </div>

</div>
@endsection