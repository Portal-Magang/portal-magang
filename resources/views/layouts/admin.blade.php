<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Diskominfostaper</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
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
            color: #ffffff;
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

        /* BURGER + RESPONSIVE SIDEBAR */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -100%;
                top: 0;
                width: 14rem;
                /* w-56 */
                z-index: 50;
                transition: left 0.3s ease;
            }

            .sidebar.show {
                left: 0;
            }

            @media (max-width: 768px) {
                .sidebar-overlay.show {
                    display: block;
                }
            }

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

<body class="min-h-screen">
    <!-- BURGER BUTTON -->
    <button id="burgerBtn" class="md:hidden fixed top-4 left-4 z-50 text-gray-700 p-2 rounded-lg shadow">
        <i class="fa-solid fa-bars text-white text-2xl"></i>
    </button>

    <!-- OVERLAY -->
    <div id="sidebarOverlay" class="sidebar-overlay hidden fixed inset-0 bg-black/50 z-40 md:hidden"></div>

    {{-- Sidebar / Navbar --}}
    <div class="flex">
        {{-- Sidebar --}}
        <div id="sidebar" class="sidebar w-56 p-8 flex flex-col min-h-screen">

            <!-- Logo -->
            <div class="mb-12">
                <img src="{{ asset('asset/logo.png') }}" alt="Diskominfostaper" class="logo">
            </div>

            <!-- MENU -->
            <nav class="space-y-1 flex-1">

                <a href="{{ url('/admin/dashboard') }}" class="nav-link flex items-center gap-2 px-3 py-2.5 rounded-lg font-medium text-gray-700
   {{ request()->is('admin/dashboard*') ? 'active' : '' }}">
                    <i class="fa-solid fa-house"></i>
                    <span class="text-sm">Dashboard</span>
                </a>

                <a href="{{ url('/admin/verifikasi') }}" class="nav-link flex items-center gap-2 px-3 py-2.5 rounded-lg font-medium text-gray-700
   {{ request()->is('admin/verifikasi*') ? 'active' : '' }}">
                    <i class="fa-solid fa-file-circle-check"></i>
                    <span class="text-sm">Verifikasi Surat</span>
                </a>

                <a href="{{ url('/admin/riwayat') }}" class="nav-link flex items-center gap-2 px-3 py-2.5 rounded-lg font-medium text-gray-700
   {{ request()->is('admin/riwayat*') ? 'active' : '' }}">
                    <i class="fa-solid fa-rotate-left"></i>
                    <span class="text-sm">Riwayat</span>
                </a>

                {{-- Added Laporan menu link --}}
                <a href="{{ url('/admin/laporan') }}" class="nav-link flex items-center gap-2 px-3 py-2.5 rounded-lg font-medium text-gray-700
   {{ request()->is('admin/laporan*') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-bar"></i>
                    <span class="text-sm">Laporan</span>
                </a>

            </nav>

            <!-- GARIS -->
            <div class="mt-auto">
                <hr class="my-4">

                <!-- LOGOUT -->
                <form action="{{ route('logout') }}" method="POST" onsubmit="return confirmLogout(this)">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-2 px-3 py-2.5 rounded-lg
                    font-medium text-red-600 hover:bg-red-600 hover:text-white transition">
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
    <script>
        const burgerBtn = document.getElementById('burgerBtn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        burgerBtn.addEventListener('click', () => {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });
    </script>

</body>

</html>