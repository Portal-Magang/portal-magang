<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Register | Diskominfostaper</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Boxicons (Icon Mata) -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-b from-[#001B61] to-black
             flex items-center justify-center px-4">

    <div class="w-full max-w-md bg-white/95 backdrop-blur
                rounded-2xl shadow-2xl p-8 mb-8 mt-8">

        <!-- Title -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-[#001B61]">Register</h1>
            <p class="text-gray-500 text-sm mt-1">
                Buat akun baru untuk melanjutkan
            </p>
        </div>

        <!-- REGISTER FORM -->
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Nama Lengkap -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Nama Lengkap
                </label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus
                       class="mt-2 w-full rounded-lg border border-gray-300
                              px-4 py-3
                              focus:border-[#001B61]
                              focus:ring-[#001B61]">
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Username -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Username
                </label>
                <input type="text" name="username" value="{{ old('username') }}" required
                       class="mt-2 w-full rounded-lg border border-gray-300
                              px-4 py-3
                              focus:border-[#001B61]
                              focus:ring-[#001B61]">
                @error('username')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Email
                </label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="mt-2 w-full rounded-lg border border-gray-300
                              px-4 py-3
                              focus:border-[#001B61]
                              focus:ring-[#001B61]">
                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password + Mata -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Password
                </label>

                <div class="relative mt-2">
                    <input id="password"
                           type="password"
                           name="password"
                           required
                           class="w-full rounded-lg border border-gray-300
                                  px-4 py-3 pr-11
                                  focus:border-[#001B61]
                                  focus:ring-[#001B61]">

                    <i id="togglePassword"
                       class="bx bx-hide absolute top-1/2 right-4 -translate-y-1/2
                              text-xl text-gray-500 cursor-pointer"></i>
                </div>

                @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Konfirmasi Password + Mata -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Konfirmasi Password
                </label>

                <div class="relative mt-2">
                    <input id="password_confirmation"
                           type="password"
                           name="password_confirmation"
                           required
                           class="w-full rounded-lg border border-gray-300
                                  px-4 py-3 pr-11
                                  focus:border-[#001B61]
                                  focus:ring-[#001B61]">

                    <i id="toggleConfirm"
                       class="bx bx-hide absolute top-1/2 right-4 -translate-y-1/2
                              text-xl text-gray-500 cursor-pointer"></i>
                </div>

                @error('password_confirmation')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between pt-4">
                <a href="{{ route('login') }}"
                   class="text-sm text-[#001B61] hover:underline">
                    Sudah punya akun?
                </a>

                <button type="submit"
                        class="bg-[#001B61] hover:bg-[#00133f]
                               text-white px-6 py-2 rounded-xl
                               font-semibold transition">
                    Register
                </button>
            </div>
        </form>

        <!-- Footer -->
        <p class="text-center text-xs text-gray-400 mt-8">
            © {{ date('Y') }} Diskominfostaper
        </p>

    </div>

    <!-- SCRIPT TOGGLE PASSWORD -->
    <script>
        const password = document.getElementById('password');
        const confirm = document.getElementById('password_confirmation');
        const togglePassword = document.getElementById('togglePassword');
        const toggleConfirm = document.getElementById('toggleConfirm');

        togglePassword.addEventListener('click', () => {
            if (password.type === 'password') {
                password.type = 'text';
                togglePassword.classList.replace('bx-hide', 'bx-show');
            } else {
                password.type = 'password';
                togglePassword.classList.replace('bx-show', 'bx-hide');
            }
        });

        toggleConfirm.addEventListener('click', () => {
            if (confirm.type === 'password') {
                confirm.type = 'text';
                toggleConfirm.classList.replace('bx-hide', 'bx-show');
            } else {
                confirm.type = 'password';
                toggleConfirm.classList.replace('bx-show', 'bx-hide');
            }
        });
    </script>

</body>
</html>
