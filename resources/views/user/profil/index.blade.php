@extends('layouts.app')

@section('content')
    <div class="p-12">

        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold text-white mb-2">Profile Saya</h1>
        </div>

        @if(session('success'))
            <div class="max-w-xl mx-auto mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="max-w-xl mx-auto bg-white rounded-2xl shadow-lg p-8">

            <!-- Avatar -->
            <div class="flex justify-center mb-6">
                <div
                    class="w-24 h-24 rounded-full bg-cyan-500 flex items-center justify-center text-white text-4xl font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </div>

            <!-- Info -->
            <div class="space-y-4 text-center">
                <div>
                    <p class="text-sm text-gray-500">Nama</p>
                    <p class="text-lg font-semibold text-gray-800">
                        {{ auth()->user()->name }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="text-lg font-semibold text-gray-800">
                        {{ auth()->user()->email }}
                    </p>
                </div>
            </div>

            <!-- Button -->
            <div class="mt-8 text-center">
                <button onclick="openModal()" class="px-6 py-3 rounded-full text-white font-semibold"
                    style="background-color:#38bdf8">
                    Ganti Password
                </button>
            </div>

        </div>
    </div>

    <!-- MODAL -->
    <div id="passwordModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

        <div class="bg-white w-full max-w-md rounded-2xl p-8 relative">

            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
                Reset Password
            </h2>

            <form action="{{ route('user.profil.password') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Password -->
                <div>
                    <label class="block font-semibold mb-2">Password Baru</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-cyan-400" required>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Konfirmasi -->
                <div>
                    <label class="block font-semibold mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-cyan-400" required>
                </div>

                <!-- Action -->
                <div class="flex gap-4 pt-4">
                    <button type="submit" class="flex-1 py-3 rounded-full text-white font-semibold"
                        style="background-color:#38bdf8">
                        Simpan
                    </button>

                    <button type="button" onclick="closeModal()"
                        class="flex-1 py-3 rounded-full border font-semibold text-gray-700 hover:bg-gray-50">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- SCRIPT -->
    <script>
        function openModal() {
            document.getElementById('passwordModal').classList.remove('hidden');
            document.getElementById('passwordModal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('passwordModal').classList.add('hidden');
            document.getElementById('passwordModal').classList.remove('flex');
        }
    </script>
@endsection