<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Diskominfostaper</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Boxicons (Icon Mata) -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-b from-[#001B61] to-black flex items-center justify-center px-4">

    <div class="w-full max-w-md bg-white/95 backdrop-blur rounded-2xl shadow-2xl p-8">

        <!-- Title -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-[#001B61]">Login</h1>
            <p class="text-gray-500 text-sm mt-1">
                Silakan masuk untuk melanjutkan
            </p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600 text-center">
                {{ session('status') }}
            </div>
        @endif

        <!-- FORM LOGIN -->
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email / Username -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Email atau Username
                </label>
                <input type="text"
                       name="login"
                       value="{{ old('login') }}"
                       required autofocus
                       class="mt-2 w-full rounded-lg border border-gray-300
                              px-4 py-3
                              focus:border-[#001B61]
                              focus:ring-[#001B61]">

                @error('login')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password + Icon Mata -->
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

                    <i id="toggleIcon"
                       class="bx bx-hide absolute top-1/2 right-4 -translate-y-1/2
                              text-xl text-gray-500 cursor-pointer"></i>
                </div>

                @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember & Forgot -->
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2 text-gray-600">
                    <input type="checkbox" name="remember"
                           class="rounded border-gray-300
                                  text-[#001B61]
                                  focus:ring-[#001B61]">
                    Remember me
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-[#001B61] hover:underline">
                        Lupa password?
                    </a>
                @endif
            </div>

            <!-- Button -->
            <button type="submit"
                    class="w-full bg-[#001B61] hover:bg-[#00133f]
                           text-white py-3 rounded-xl
                           font-semibold transition">
                Log in
            </button>
        </form>

        <!-- Register -->
        <div class="text-center mt-6">
            <p class="text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}"
                   class="font-semibold text-[#001B61] hover:underline">
                    Daftar di sini
                </a>
            </p>
        </div>

        <!-- Footer -->
        <p class="text-center text-xs text-gray-400 mt-8">
            © {{ date('Y') }} Diskominfostaper
        </p>
    </div>

    <!-- SCRIPT SHOW / HIDE PASSWORD -->
    <script>
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');

        toggleIcon.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bx-hide');
                toggleIcon.classList.add('bx-show');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bx-show');
                toggleIcon.classList.add('bx-hide');
            }
        });
    </script>

</body>
</html>
