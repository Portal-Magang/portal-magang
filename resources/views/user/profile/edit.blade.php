@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-10">

        {{-- ALERT SUCCESS --}}
        @if (session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-100 text-green-700 font-medium shadow">
                {{ session('success') }}
            </div>
        @endif

        {{-- ALERT STATUS (profile-updated / photo-updated / password-updated dll) --}}
        @if (session('status'))
            <div class="mb-6 p-4 rounded-xl bg-blue-100 text-blue-700 font-medium shadow">
                {{ session('status') }}
            </div>
        @endif

        <!-- PROFILE CARD -->
        <div class="bg-white rounded-3xl shadow-xl p-8 relative">
            <h1 class="text-2xl font-bold text-[#001B61] mb-8">
                Profil Saya
            </h1>

            <!-- FOTO & INFO -->
            <div class="flex flex-col sm:flex-row items-center gap-6 mb-8">
                <img src="{{ auth()->user()->photo_profile
                        ? asset('storage/' . auth()->user()->photo_profile)
                        : asset('asset/default-avatar.png') }}"
                     class="w-32 h-32 rounded-full object-cover border-4 border-gray-100 shadow">

                <div class="text-center sm:text-left">
                    <p class="text-xl font-semibold text-gray-800">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="text-sm text-gray-500">
                        {{ auth()->user()->username }}
                    </p>
                    <p class="text-sm text-gray-500">
                        {{ auth()->user()->email }}
                    </p>
                </div>
            </div>

            <!-- BUTTON EDIT -->
            <button onclick="openModal()" class="inline-flex items-center gap-2 px-6 py-2.5
                        bg-[#001B61] text-white rounded-xl font-semibold
                        hover:bg-[#00133f] transition shadow">
                ✏️ Edit Profil
            </button>
        </div>
    </div>

    <!-- MODAL EDIT -->
    <div id="editModal" onclick="closeModal()" class="fixed inset-0 bg-black/50 backdrop-blur-sm
                flex items-center justify-center hidden z-50">

        <div class="bg-white w-full max-w-lg rounded-3xl p-6 sm:p-8 relative
            max-h-[90vh] overflow-y-auto animate-[fadeIn_.25s_ease-out]"onclick="event.stopPropagation()">

            <h2 class="text-xl font-bold text-[#001B61] mb-6">
                Edit Profil
            </h2>

            <!-- CLOSE -->
            <button onclick="closeModal()" class="absolute top-5 right-5 text-gray-400
                        hover:text-gray-600 text-xl">
                ✕
            </button>

            {{-- ERROR BAG UMUM (profile/photo) --}}
            @if ($errors->any())
                <div class="mb-5 p-3 rounded-xl bg-red-50 text-red-700 text-sm">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- ERROR BAG PASSWORD (breeze) --}}
            @if ($errors->updatePassword->any())
                <div class="mb-5 p-3 rounded-xl bg-red-50 text-red-700 text-sm">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->updatePassword->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Kalau ada error, otomatis buka modal lagi --}}
            @if ($errors->any() || $errors->updatePassword->any())
                <script>
                    document.addEventListener("DOMContentLoaded", () => openModal());
                </script>
            @endif

            <div class="space-y-8">

                <!-- UPDATE PROFIL -->
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    {{-- FOTO --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700">Foto Profil</label>
                        <div class="flex items-center gap-4 mt-2">
                            <img id="preview"
                                src="{{ auth()->user()->photo_profile
                                        ? asset('storage/' . auth()->user()->photo_profile)
                                        : asset('asset/default-avatar.png') }}"
                                class="w-20 h-20 rounded-full object-cover border shadow">

                            <input type="file" name="photo_profile" accept="image/*" onchange="previewImage(event)"
                                class="text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0
                                        file:bg-[#001B61] file:text-white file:px-4 file:py-2 hover:file:bg-[#00133f]">
                        </div>
                        @error('photo_profile')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <hr>

                    {{-- NAMA --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                            class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-3
                                    focus:border-[#001B61] focus:ring-[#001B61]">
                        @error('name')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- USERNAME --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700">Username</label>
                        <input type="text" value="{{ auth()->user()->username }}" disabled
                            class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-3 bg-gray-50 cursor-not-allowed">
                    </div>

                    {{-- EMAIL --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700">Email</label>
                        <input type="email" value="{{ auth()->user()->email }}" disabled
                            class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-3 bg-gray-50 cursor-not-allowed">
                    </div>

                    {{-- PASSWORD --}}
                    <div>
                        <p class="text-sm text-gray-600"> Opsional. Isi kalau ingin mengganti password. </p>
                        <hr>
                        <label class="text-sm font-medium text-gray-700">Password Saat Ini</label>
                        <input type="password" name="current_password"
                            class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-3">
                        @error('current_password')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Password Baru</label>
                        <input type="password" name="password"
                            class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-3">
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation"
                            class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-3">
                    </div>

                    {{-- ACTIONS --}}
                    <div class="flex justify-end gap-3 pt-6">
                        <button type="button" onclick="closeModal()"
                                class="px-5 py-2.5 rounded-xl border text-gray-600 hover:bg-gray-100 transition">
                            Batal
                        </button>

                        <button type="submit"
                                class="px-6 py-2.5 bg-[#001B61] text-white rounded-xl font-semibold hover:bg-[#00133f] transition shadow">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SCRIPT -->
    <script>
        function openModal() {
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        function previewImage(event) {
            const file = event.target.files?.[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function () {
                const preview = document.getElementById('preview');
                if (preview) preview.src = reader.result;
            };
            reader.readAsDataURL(file);
        }
    </script>
@endsection