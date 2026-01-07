@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">

    {{-- ALERT SUCCESS --}}
    @if (session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-100 text-green-700 font-medium shadow">
            {{ session('success') }}
        </div>
    @endif

    {{-- ALERT STATUS --}}
    @if (session('status'))
        <div class="mb-6 p-4 rounded-xl bg-blue-100 text-blue-700 font-medium shadow">
            {{ session('status') }}
        </div>
    @endif

    <!-- PROFILE CARD -->
    <div class="bg-white rounded-3xl shadow-xl p-8">
        <h1 class="text-2xl font-bold text-[#001B61] mb-8">Profil Saya</h1>

        <div class="flex flex-col sm:flex-row items-center gap-6 mb-8">
            <img src="{{ auth()->user()->photo_profile
                ? asset('storage/' . auth()->user()->photo_profile)
                : asset('asset/default-avatar.png') }}"
                class="w-32 h-32 rounded-full object-cover border-4 border-gray-100 shadow">

            <div class="text-center sm:text-left">
                <p class="text-xl font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                <p class="text-sm text-gray-500">{{ auth()->user()->username }}</p>
                <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
            </div>
        </div>

        <button onclick="openModal()"
            class="px-6 py-2.5 bg-[#001B61] text-white rounded-xl font-semibold hover:bg-[#00133f] transition shadow">
            ✏️ Edit Profil
        </button>
    </div>
</div>

<!-- MODAL -->
<div id="editModal" onclick="closeModal()"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50 flex items-center justify-center">

    <div onclick="event.stopPropagation()"
        class="bg-white w-full max-w-lg rounded-3xl p-6 sm:p-8 relative max-h-[90vh] overflow-y-auto">

        <h2 class="text-xl font-bold text-[#001B61] mb-6">Edit Profil</h2>

        <button onclick="closeModal()"
            class="absolute top-5 right-5 text-gray-400 hover:text-gray-600 text-xl">✕</button>

        @if ($errors->any())
            <script>
                document.addEventListener("DOMContentLoaded", () => openModal());
            </script>
        @endif

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
                        class="text-sm file:bg-[#001B61] file:text-white file:px-4 file:py-2 file:rounded-lg">
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
                    class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-3">
                @error('name')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- PASSWORD --}}
            <div>
                <p class="text-sm text-gray-600 mb-2">Opsional. Isi apabila ingin mengganti password.</p>

                <label class="text-sm font-medium text-gray-700">Password Saat Ini</label>
                <input type="password" name="current_password"
                    class="mt-2 w-full rounded-lg border @error('current_password') border-red-500 @else border-gray-300 @enderror px-4 py-3">
                @error('current_password')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- PASSWORD BARU --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Password Baru</label>
                <div class="relative mt-2">
                    <input id="newPassword" type="password" name="password"
                        class="w-full rounded-lg border @error('password') border-red-500 @else border-gray-300 @enderror px-4 py-3 pr-11">
                    <i class="bx bx-hide absolute top-1/2 right-4 -translate-y-1/2 text-xl text-gray-500 cursor-pointer"
                        onclick="togglePassword('newPassword', this)"></i>
                </div>
                @error('password')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- KONFIRMASI --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>

                <div class="relative mt-2">
                    <input id="confirmPassword" type="password" name="password_confirmation"
                        class="w-full rounded-lg border
                            @error('password') border-red-500 @else border-gray-300 @enderror
                            px-4 py-3 pr-11">

                    <i class="bx bx-hide absolute top-1/2 right-4 -translate-y-1/2
                            text-xl text-gray-500 cursor-pointer"
                    onclick="togglePassword('confirmPassword', this)"></i>
                </div>

                {{-- AMBIL ERROR DARI password.confirmed --}}
                @if ($errors->has('password'))
                    <p class="text-sm text-red-600 mt-2">
                        {{ $errors->first('password') }}
                    </p>
                @endif
            </div>
            
            <div class="flex justify-end gap-3 pt-6">
                <button type="button" onclick="closeModal()"
                    class="px-5 py-2.5 border rounded-xl text-gray-600">Batal</button>

                <button type="submit"
                    class="px-6 py-2.5 bg-[#001B61] text-white rounded-xl font-semibold hover:bg-[#00133f]">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- SCRIPT --}}
<script>
    function openModal() {
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = () => document.getElementById('preview').src = reader.result;
        reader.readAsDataURL(event.target.files[0]);
    }

    function togglePassword(id, icon) {
        const input = document.getElementById(id);
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bx-hide', 'bx-show');
        } else {
            input.type = 'password';
            icon.classList.replace('bx-show', 'bx-hide');
        }
    }
</script>
@endsection
