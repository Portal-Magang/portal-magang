<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Reset Password | Diskominfostaper</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <style>
        * { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-b from-[#001B61] to-black
             flex items-center justify-center px-4">

    <div class="w-full max-w-md bg-white/95 backdrop-blur
                rounded-2xl shadow-2xl p-8 mb-8 mt-8">

        <!-- Title -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-[#001B61]">Reset Password</h1>
            <p class="text-gray-500 text-sm mt-1">
                Masukkan password baru untuk akun Anda
            </p>
        </div>

        <!-- RESET PASSWORD FORM -->
        <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
            @csrf

            <!-- Token & Email (WAJIB, tapi hidden) -->
            <input type="hidden" name="token" value="{{ request()->route('token') }}">
            <input type="hidden" name="email" value="{{ request('email') }}">

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Password Baru
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

                {{-- Error password KECUALI confirmed --}}
                @if ($errors->has('password'))
                    @php($msg = $errors->first('password'))
                    @if (!str_contains($msg, 'Konfirmasi password'))
                        <p class="text-sm text-red-600 mt-1">{{ $msg }}</p>
                    @endif
                @endif
            </div>

            <!-- Konfirmasi Password -->
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

                {{-- Error confirmed HANYA muncul di sini --}}
                @if ($errors->has('password'))
                    @php($msg = $errors->first('password'))
                    @if (str_contains($msg, 'Konfirmasi password'))
                        <p class="text-sm text-red-600 mt-1">{{ $msg }}</p>
                    @endif
                @endif
            </div>

            <!-- Action -->
            <div class="pt-4">
                <button type="submit"
                        class="w-full bg-[#001B61] hover:bg-[#00133f]
                               text-white py-3 rounded-xl
                               font-semibold transition">
                    Reset Password
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
            password.type = password.type === 'password' ? 'text' : 'password';
            togglePassword.classList.toggle('bx-hide');
            togglePassword.classList.toggle('bx-show');
        });

        toggleConfirm.addEventListener('click', () => {
            confirm.type = confirm.type === 'password' ? 'text' : 'password';
            toggleConfirm.classList.toggle('bx-hide');
            toggleConfirm.classList.toggle('bx-show');
        });
    </script>
    </body>
</html>