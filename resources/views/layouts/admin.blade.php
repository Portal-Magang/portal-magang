<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen">

    {{-- Sidebar / Navbar --}}
    <div class="flex">
        {{-- Sidebar --}}
        <aside class="w-64 bg-white">
            {{-- sidebar content --}}
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="flex-1">
            @yield('content')  {{-- 🔴 INI WAJIB --}}
        </main>
    </div>

</body>
</html>
