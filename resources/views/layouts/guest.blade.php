<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Diskominfostaper') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-b from-[#001B61] to-black flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-white/95 backdrop-blur rounded-2xl shadow-2xl p-8 my-8">
        {{ $slot }}
    </div>
</body>
</html>
