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
            <form action="{{ url('/pengajuan') }}" method="POST" enctype="multipart/form-data" id="pengajuanForm">
                @csrf

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <div class="text-red-800 font-semibold mb-2">Terjadi Kesalahan:</div>
                        <ul class="list-disc list-inside text-red-700 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form Fields -->
                <div class="space-y-6">
                    <!-- Nomor Telepon -->
                    <div>
                        <label for="no_hp" class="block text-gray-700 font-semibold mb-2">Nomor Telepon</label>
                        <input 
                            type="tel" 
                            id="no_hp"
                            name="no_hp" 
                            placeholder="Masukkan nomor telepon Anda"
                            value="{{ old('no_hp') }}"
                            required
                            class="w-full px-6 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent text-gray-700 placeholder-gray-400"
                        >
                        @error('no_hp')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Asal Instansi -->
                    <div>
                        <label for="asal_instansi" class="block text-gray-700 font-semibold mb-2">Asal Sekolah / Universitas</label>
                        <input 
                            type="text" 
                            id="asal_instansi"
                            name="asal_instansi" 
                            placeholder="Masukkan nama sekolah atau universitas"
                            value="{{ old('asal_instansi') }}"
                            required
                            class="w-full px-6 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent text-gray-700 placeholder-gray-400"
                        >
                        @error('asal_instansi')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jurusan -->
                    <div>
                        <label for="jurusan" class="block text-gray-700 font-semibold mb-2">Jurusan</label>
                        <input 
                            type="text" 
                            id="jurusan"
                            name="jurusan" 
                            placeholder="Masukkan jurusan Anda"
                            value="{{ old('jurusan') }}"
                            required
                            class="w-full px-6 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent text-gray-700 placeholder-gray-400"
                        >
                        @error('jurusan')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Surat Pengantar -->
                    <div>
                        <label for="surat_pengantar" class="block text-gray-700 font-semibold mb-2">Surat Pengantar</label>
                        <div class="relative">
                            <input 
                                type="file" 
                                id="surat_pengantar"
                                name="surat_pengantar" 
                                accept=".pdf,.jpg,.jpeg,.png"
                                required
                                class="hidden"
                            >
                            <label 
                                for="surat_pengantar"
                                class="w-full px-6 py-3 border-2 border-dashed border-gray-300 rounded-xl text-center cursor-pointer hover:border-cyan-400 hover:bg-cyan-50 transition-colors duration-200 block"
                            >
                                <div id="fileName" class="text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto mb-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33A3 3 0 0116.5 19.5H6.75Z" />
                                    </svg>
                                    <span class="text-gray-600 font-medium">Pilih file atau drag & drop</span>
                                    <p class="text-gray-400 text-xs mt-1">Format: PDF, JPG, JPEG, PNG (Max 2MB)</p>
                                </div>
                            </label>
                        </div>
                        @error('surat_pengantar')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-10 flex justify-center">
                    <button 
                        type="submit"
                        class="bg-cyan-400 hover:bg-cyan-500 text-white font-bold py-3 px-12 rounded-full text-lg transition-all duration-200 transform hover:scale-105 shadow-lg"
                    >
                        Kirim
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Section -->
        <div class="mt-8 text-center text-gray-300 text-sm">
            <p>Pastikan semua data terisi dengan benar sebelum mengirim pengajuan</p>
        </div>
    </div>
</div>

<!-- File Upload Handler Script -->
<script>
    const fileInput = document.getElementById('surat_pengantar');
    const fileLabel = document.getElementById('fileName');

    // Handle file selection
    fileInput.addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            const file = this.files[0];
            const fileName = file.name;
            const fileSize = (file.size / 1024).toFixed(2); // Convert to KB
            fileLabel.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto mb-2 text-green-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-green-600 font-medium">${fileName}</span>
                <p class="text-gray-400 text-xs mt-1">${fileSize} KB</p>
            `;
        }
    });

    // Handle drag & drop
    const label = document.querySelector('label[for="surat_pengantar"]');
    
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        label.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        label.addEventListener(eventName, () => {
            label.classList.add('border-cyan-400', 'bg-cyan-50');
        });
    });

    ['dragleave', 'drop'].forEach(eventName => {
        label.addEventListener(eventName, () => {
            label.classList.remove('border-cyan-400', 'bg-cyan-50');
        });
    });

    label.addEventListener('drop', (e) => {
        const dt = e.dataTransfer;
        const files = dt.files;
        fileInput.files = files;
        
        // Trigger change event
        const event = new Event('change', { bubbles: true });
        fileInput.dispatchEvent(event);
    });
</script>

@endsection
