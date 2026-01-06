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
                                    <input type="radio" name="jenis_pengajuan" value="Individu" checked
                                        onchange="toggleParticipantType()">
                                    Individu
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="jenis_pengajuan" value="Instansi"
                                        onchange="toggleParticipantType()">
                                    Instansi
                                </label>
                            </div>
                        </div>

                        <!-- Asal Instansi -->
                        <div>
                            <label class="block font-semibold mb-2">Asal Sekolah / Universitas</label>
                            <input type="text" name="asal_instansi" required
                                class="w-full px-6 py-3 border rounded-xl bg-gray-50">
                        </div>

                        <!-- Peserta -->
                        <div id="participantContainer" class="space-y-6">

                            <div class="participant-item p-6 bg-gray-50 rounded-2xl border">
                                <h3
                                    class="participant-title font-bold text-gray-800 mb-4 flex items-center justify-between">
                                    <span>Data Peserta</span>
                                    <button type="button" class="remove-participant hidden text-red-500 hover:text-red-700"
                                        onclick="removeParticipant(this)">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </h3>

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
                                        <label class="block text-sm mb-1">No Telepon / WhatsApp</label>
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
                            <label for="surat_pengantar" class="block text-gray-700 font-semibold mb-2">
                                Surat Pengantar
                            </label>

                            <div class="relative">
                                <input type="file" id="surat_pengantar" name="surat_pengantar" accept=".pdf,.jpg,.jpeg,.png"
                                    required class="hidden" onchange="previewSurat(this)">

                                <label for="surat_pengantar" class="w-full px-6 py-3 border-2 border-dashed border-gray-300 rounded-xl
                           text-center cursor-pointer
                           hover:border-cyan-400 hover:bg-cyan-50
                           transition-colors duration-200 block">
                                    <div id="fileName" class="text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto mb-2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775
                                     5.25 5.25 0 0110.233-2.33A3 3 0 0116.5 19.5H6.75Z" />
                                        </svg>

                                        <span class="text-gray-600 font-medium">
                                            Pilih file atau drag & drop
                                        </span>

                                        <p class="text-gray-400 text-xs mt-1">
                                            Format: PDF, JPG, JPEG, PNG (Max 2MB)
                                        </p>
                                    </div>
                                </label>
                            </div>

                            @error('surat_pengantar')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
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
    document.addEventListener('DOMContentLoaded', () => {
        toggleParticipantType();
        updateRemoveButtons();
    });

    function toggleParticipantType() {
        const type = document.querySelector('input[name="jenis_pengajuan"]:checked').value;
        const addBtn = document.getElementById('addParticipantBtn');
        const container = document.getElementById('participantContainer');

        if (type === 'Instansi') {
            addBtn.classList.remove('hidden');
        } else {
            addBtn.classList.add('hidden');

            // Hapus peserta tambahan jika kembali ke Individu
            const items = container.querySelectorAll('.participant-item');
            items.forEach((item, index) => {
                if (index > 0) item.remove();
            });
        }

        updateRemoveButtons();
    }

    function addParticipant() {
        const container = document.getElementById('participantContainer');
        const clone = container.firstElementChild.cloneNode(true);

        clone.querySelectorAll('input').forEach(input => input.value = '');
        container.appendChild(clone);

        updateRemoveButtons();
    }

    /* HAPUS PESERTA */
    function removeParticipant(btn) {
        btn.closest('.participant-item').remove();
        updateRemoveButtons();
    }

    /* ATUR VISIBILITAS TOMBOL HAPUS */
    function updateRemoveButtons() {
        const items = document.querySelectorAll('.participant-item');

        items.forEach((item, index) => {
            const removeBtn = item.querySelector('.remove-participant');

            if (items.length === 1) {
                removeBtn.classList.add('hidden');
            } else {
                removeBtn.classList.toggle('hidden', index === 0);
            }
        });
    }

    function previewSurat(input) {
        const container = document.getElementById('fileName');

        if (input.files.length > 0) {
            const file = input.files[0];

            container.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor"
                     class="w-6 h-6 mx-auto mb-2 text-green-600">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>

                <p class="text-green-600 font-semibold text-sm">
                    ${file.name}
                </p>

                <p class="text-xs text-gray-500 mt-1">
                    File siap dikirim
                </p>
            `;
        }
    }
</script>
@endsection