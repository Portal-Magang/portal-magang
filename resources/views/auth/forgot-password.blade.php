<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Lupa Password | Diskominfostaper</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-b from-[#001B61] to-black
             flex items-center justify-center px-4">

    <div class="w-full max-w-md bg-white/95 backdrop-blur
                rounded-2xl shadow-2xl p-8">

        <!-- Title -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-[#001B61]">Lupa Password</h1>
            <p class="text-gray-500 text-sm mt-2 leading-relaxed">
                Masukkan email yang terdaftar. Kami akan mengirimkan
                link untuk reset password Anda.
            </p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600 text-center">
                {{ session('status') }}
            </div>
        @endif

        <!-- FORM -->
        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Email
                </label>
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autofocus
                       class="mt-2 w-full rounded-lg border border-gray-300
                              px-4 py-3
                              focus:border-[#001B61]
                              focus:ring-[#001B61]">

                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Button -->
            <button type="submit"
                    class="w-full bg-[#001B61] hover:bg-[#00133f]
                           text-white py-3 rounded-xl
                           font-semibold transition">
                Kirim Link Reset Password
            </button>
        </form>

        <!-- Back to Login -->
        <div class="text-center mt-6">
            <a href="{{ route('login') }}"
               class="text-sm text-[#001B61] font-medium hover:underline">
                Kembali ke Login
            </a>
        </div>

        <!-- Footer -->
        <p class="text-center text-xs text-gray-400 mt-8">
            © {{ date('Y') }} Diskominfostaper
        </p>

    </div>

</body>
</html>
