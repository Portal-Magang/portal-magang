<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Diskominfostaper</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

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

        .nav-link:hover i,
        .nav-link:hover svg {
            color: #ffffff;
        }

        .nav-link.active {
            background-color: #e3f2fd;
            color: #001a4d;
            border-left: 4px solid #001a4d;
        }

        .nav-link.active i,
        .nav-link.active svg {
            color: #001a4d;
        }

        .logo {
            width: 150px;
            height: auto;
        }
    </style>
</head>

<body class="min-h-screen">

<div class="flex">

    <!-- SIDEBAR -->
    <aside class="sidebar w-56 p-8">
        <!-- Logo -->
        <div class="mb-12">
            <img src="{{ asset('asset/logo.png') }}" alt="Diskominfostaper" class="logo">
        </div>

        <!-- MENU -->
        <nav class="space-y-1 flex-1 mb-14">

            <!-- PROFIL -->
            <a href="{{ route('user.profil.index') }}"
               class="nav-link flex items-center gap-2 px-3 py-2.5 rounded-lg font-medium text-gray-700
               {{ request()->routeIs('user.profil.*') ? 'active' : '' }}">
                <i class="fa-regular fa-address-card text-xl"></i>
                <span class="text-sm">Profil</span>
            </a>

            <!-- PENGAJUAN -->
            <a href="{{ route('pengajuan.create') }}"
               class="nav-link flex items-center gap-2 px-3 py-2.5 rounded-lg font-medium text-gray-700
               {{ request()->routeIs('pengajuan.*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-circle-plus text-xl"></i>
                <span class="text-sm">Form Pengajuan</span>
            </a>

            <!-- RIWAYAT -->
            <a href="{{ route('user.riwayat.index') }}"
               class="nav-link flex items-center gap-2 px-3 py-2.5 rounded-lg font-medium text-gray-700
               {{ request()->routeIs('user.riwayat.*') ? 'active' : '' }}">
                <i class="fa-solid fa-clock-rotate-left text-xl"></i>
                <span class="text-sm">Riwayat</span>
            </a>

        </nav>
            <!-- GARIS -->
            <hr class="my-4">

            <!-- LOGOUT (WAJIB POST) -->
            <form action="{{ route('logout') }}" method="POST"
                  onsubmit="return confirm('Yakin ingin logout?')">
                @csrf
                <button type="submit"
                    class="nav-link w-full flex items-center gap-2 px-3 py-2.5 rounded-lg
                    font-medium text-red-600 hover:text-white hover:bg-red-600">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span class="text-sm">Logout</span>
                </button>
            </form>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-8">
        @yield('content')
    </main>

</div>

</body>
</html>
