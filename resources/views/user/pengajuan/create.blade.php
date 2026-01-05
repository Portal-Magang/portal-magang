@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-2xl">

        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold text-white mb-2">Isi Data Diri</h1>
            <p class="text-cyan-400 text-lg">Lengkapi data untuk pengajuan PKL/Magang Anda</p>
        </div>

        <!-- Form Container -->
        <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-12">
            <form action="{{ url('/pengajuan') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Error -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <ul class="list-disc list-inside text-red-700 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="space-y-6">

                    <!-- Jenis Pengajuan -->
                    <div>
                        <label class="block font-semibold mb-3">Jenis Pengajuan</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="flex items-center gap-2">
                                <input type="radio" name="jenis_pengajuan" value="Individu" checked onchange="toggleParticipantType()">
                                Individu
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="radio" name="jenis_pengajuan" value="Instansi" onchange="toggleParticipantType()">
                                Instansi
                            </label>
                        </div>
                    </div>

                    <!-- Asal Instansi -->
                    <div>
                        <label class="block font-semibold mb-2">Asal Sekolah / Universitas</label>
                        <input type="text" name="asal_instansi" required
                            class="w-full px-6 py-3 border rounded-xl">
                    </div>

                    <!-- Peserta -->
                    <div id="participantContainer" class="space-y-6">

                        <div class="participant-item p-6 bg-gray-50 rounded-2xl border">
                            <h3 class="participant-title font-bold mb-4">Data Peserta</h3>

                            <div class="mb-4">
                                <label class="block text-sm mb-1">Nama Lengkap</label>
                                <input type="text" name="nama_pengaju[]" required
                                    class="w-full px-4 py-2 border rounded-xl">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm mb-1">Jurusan</label>
                                    <input type="text" name="jurusan[]" required
                                        class="w-full px-4 py-2 border rounded-xl">
                                </div>
                                <div>
                                    <label class="block text-sm mb-1">No HP / WA</label>
                                    <input type="text" name="no_hp[]" required
                                        class="w-full px-4 py-2 border rounded-xl">
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Tambah Peserta -->
                    <div id="addParticipantBtn" class="hidden">
                        <button type="button" onclick="addParticipant()" class="text-cyan-500 font-semibold">
                            + Tambah Peserta
                        </button>
                    </div>

                    <!-- Surat Pengantar -->
                    <div>
                        <label class="block font-semibold mb-2">Surat Pengantar</label>
                        <input type="file" name="surat_pengantar" required
                            accept=".pdf,.jpg,.jpeg,.png"
                            class="w-full border rounded-xl px-4 py-2">
                    </div>
                </div>

                <!-- Submit -->
                <div class="mt-10 text-center">
                    <button type="submit"
                        class="bg-cyan-400 hover:bg-cyan-500 text-white font-bold px-12 py-3 rounded-full">
                        Kirim
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
function toggleParticipantType() {
    const type = document.querySelector('input[name="jenis_pengajuan"]:checked').value;
    document.getElementById('addParticipantBtn')
        .classList.toggle('hidden', type !== 'Instansi');
}

function addParticipant() {
    const container = document.getElementById('participantContainer');
    const clone = container.firstElementChild.cloneNode(true);
    clone.querySelectorAll('input').forEach(i => i.value = '');
    container.appendChild(clone);
}
</script>
@endsection
