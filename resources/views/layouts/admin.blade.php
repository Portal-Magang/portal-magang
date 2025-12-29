<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Diskominfostaper</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(#001B61 0%, #000000 100%);
        }

        .sidebar {
            background: white;
            min-height: 100vh;
        }

        .nav-link {
            transition: all 0.25s ease;
        }

        .nav-link:hover {
            background-color: #1C2541;
            color: #ffffff;
        }

        .nav-link:hover svg {
            color: #38bdf8;
            /* cyan-400 */
        }

        /* ACTIVE MENU */
        .nav-link.active {
            background-color: #e3f2fd;
            color: #001a4d;
            border-left: 4px solid #001a4d;
        }

        .nav-link.active svg {
            color: #001a4d;
        }

        .stat-card {
            background: linear-gradient(135deg, #1e3a5f 0%, #0d1b35 100%);
            border: 1px solid #2a4a7a;
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: #6FFFE9;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: white;
        }

        .stat-label {
            font-size: 1.25rem;
            color: #ccc;
            font-weight: 500;
        }

        .logo {
            width: 150px;
            height: auto;
        }
    </style>
</head>

<body class="min-h-screen">

    {{-- Sidebar / Navbar --}}
    <div class="flex">
        {{-- Sidebar --}}
        <div class="sidebar w-56 p-8 flex flex-col min-h-screen">

            <!-- Logo -->
            <div class="mb-12">
                <img src="{{ asset('asset/logo.png') }}" alt="Diskominfostaper" class="logo">
            </div>

            <!-- MENU -->
            <nav class="space-y-1 flex-1">

                <a href="{{ url('/admin/dashboard') }}"
                    class="nav-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-gray-700 font-medium">
                    <i class="fa-solid fa-house"></i>
                    <span class="text-sm">Dashboard</span>
                </a>

                <a href="{{ url('/admin/verifikasi') }}"
                    class="nav-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-gray-700 font-medium">
                    <i class="fa-solid fa-clock"></i>
                    <span class="text-sm">Menunggu Verifikasi</span>
                </a>

                <a href="{{ url('/admin/riwayat') }}"
                    class="nav-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-gray-700 font-medium">
                    <i class="fa-solid fa-rotate-left"></i>
                    <span class="text-sm">Riwayat</span>
                </a>

            </nav>

            <!-- GARIS -->
            <div class="mt-auto">
            <hr class="my-4">

            <!-- LOGOUT -->
            <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Yakin ingin logout?')">
                @csrf
                <button type="submit" class="w-full flex items-center gap-2 px-3 py-2.5 rounded-lg
                   font-medium text-red-600
                   hover:bg-red-600 hover:text-white transition">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span class="text-sm">Logout</span>
                </button>
            </form>
            </div>

        </div>


        {{-- MAIN CONTENT --}}
        <main class="flex-1">
            @yield('content') {{-- 🔴 INI WAJIB --}}
        </main>
    </div>

</body>

</html>