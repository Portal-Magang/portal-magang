<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Diskominfostaper</title>

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmLogout(form) {
            event.preventDefault();

            Swal.fire({
                title: 'Yakin ingin logout?',
                text: 'Sesi akan berakhir.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#9ca3af',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });

            return false;
        }
    </script>
</head>

<body class="min-h-screen overflow-x-hidden">
    <!-- BURGER BUTTON -->
    <button id="burgerBtn" class="fixed top-4 left-4 z-50 p-2 lg:hidden">
        <i class="fa-solid fa-bars text-xl text-gray-800 text-white text-2xl"></i>
    </button>
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-40 hidden z-30 lg:hidden">
    </div>

    <div class="flex">

        <!-- SIDEBAR -->
        <aside id="sidebar" class="sidebar fixed lg:static top-0 left-0 w-56 p-8
           transform -translate-x-full lg:translate-x-0
           transition-transform duration-300 z-40">

            <!-- Logo -->
            <div class="mb-12">
                <img src="{{ asset('asset/logo.png') }}" alt="Diskominfostaper" class="logo">
            </div>

            <!-- MENU -->
            <nav class="space-y-1 flex-1 mb-14">

                <!-- PROFIL -->
                <a href="{{ route('profile.edit') }}" class="nav-link flex items-center gap-2 px-3 py-2.5 rounded-lg font-medium text-gray-700
                {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <i class="fa-regular fa-address-card text-xl"></i>
                    <span class="text-sm">Profil</span>
                </a>

                <!-- PENGAJUAN -->
                <a href="{{ route('pengajuan.create') }}" class="nav-link flex items-center gap-2 px-3 py-2.5 rounded-lg font-medium text-gray-700
               {{ request()->routeIs('pengajuan.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-file-circle-plus text-xl"></i>
                    <span class="text-sm">Form Pengajuan</span>
                </a>

                <!-- RIWAYAT -->
                <a href="{{ route('user.riwayat.index') }}" class="nav-link flex items-center gap-2 px-3 py-2.5 rounded-lg font-medium text-gray-700
               {{ request()->routeIs('user.riwayat.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-clock-rotate-left text-xl"></i>
                    <span class="text-sm">Riwayat</span>
                </a>

            </nav>
            <!-- GARIS -->
            <hr class="my-4">

            <!-- LOGOUT (WAJIB POST) -->
            <form action="{{ route('logout') }}" method="POST" onsubmit="return confirmLogout(this)">
                @csrf
                <button type="submit" class="nav-link w-full flex items-center gap-2 px-3 py-2.5 rounded-lg
        font-medium text-red-600 hover:text-white hover:bg-red-600 transition">
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
    <script>
        const burgerBtn = document.getElementById('burgerBtn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        burgerBtn.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
    </script>

</body>

</html>