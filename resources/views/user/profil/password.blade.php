@extends('layouts.app')

@section('content')
    <div class="p-12">

        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold text-white mb-2">Profile Saya</h1>
            <p class="text-cyan-400 text-lg">Lengkapi data untuk pengajuan PKL/Magang Anda</p>
        </div>
        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 max-w-xl mx-auto">
                {{ session('success') }}
            </div>
        @endif

        <!-- UBAH PASSWORD -->
        <div class="max-w-xl mx-auto">
            <div class="bg-white rounded-2xl p-8 shadow-lg">

                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
                    Ubah Password
                </h2>

                <form action="{{ route('user.profil.password') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Password Baru -->
                <div>
                    <label class="block font-semibold mb-2">Password Baru</label>
                    <input
                        type="password"
                        name="password"
                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-cyan-400"
                        required
                    >
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Konfirmasi -->
                <div>
                    <label class="block font-semibold mb-2">Konfirmasi Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-cyan-400"
                        required
                    >
                </div>

                <!-- Info -->
                <div class="bg-blue-50 border border-blue-200 p-4 rounded">
                    <p class="text-sm text-blue-700">
                        Gunakan kombinasi huruf besar, huruf kecil, angka, dan simbol untuk keamanan akun.
                    </p>
                </div>

                <!-- Action -->
                <div class="flex gap-4 pt-4">
                    <button
                        type="submit"
                        class="flex-1 py-3 rounded-full text-white font-semibold"
                        style="background-color:#38bdf8"
                    >
                        Update Password
                    </button>

                    <a
                        href="{{ route('user.profil.index') }}"
                        class="flex-1 py-3 rounded-full border text-center font-semibold text-gray-700 hover:bg-gray-50"
                    >
                        Batal
                    </a>
                </div>

            </form>
            </div>
        </div>

    </div>
@endsection