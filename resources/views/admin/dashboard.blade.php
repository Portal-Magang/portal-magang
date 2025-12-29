<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Diskominfostaper</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
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

<body>
    <div class="flex">
        <!-- Sidebar -->
        <div class="sidebar w-56 p-8">
            <!-- Logo -->
            <div class="mb-12">
                <img src="{{ asset('asset/logo.png') }}" alt="Diskominfostaper" class="logo">
            </div>

            <!-- Navigation -->
            <nav class="space-y-1">
                <!-- DASHBOARD -->
                <a href="{{ url('/admin/dashboard') }}"
                    class="nav-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-gray-700 font-medium">

                    <!-- Icon Dashboard -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                    </svg>

                    <span class="text-sm">Dashboard</span>
                </a>

                <!-- VERIFIKASI -->
                <a href="{{ url('/admin/verifikasi') }}"
                    class="nav-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-gray-700 font-medium">

                    <!-- Icon Verifikasi -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-9 h-9">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>

                    <span class="text-sm">Menunggu Verifikasi</span>
                </a>

                <!-- Riwayat -->
                <a href="{{ url('/admin/riwayat') }}"
                    class="nav-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-gray-700 
                    font-medium">

                    <!-- Icon Verifikasi -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                    <span class="text-sm">Riwayat</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-12">
            <!-- Page Title -->
            <h1 class="text-5xl font-bold text-white mb-12">Dashboard</h1>

            <!-- Statistics Cards -->
            <div class="space-y-6 max-w-2xl">
                <!-- Card 1: Belum Diverifikasi -->
                <div class="stat-card p-8">
                    <div class="space-y-2">
                        <p class="stat-label">Jumlah Surat Belum diverifikasi</p>
                        <p class="stat-number">{{ $baru }}</p>
                    </div>
                </div>

                <!-- Card 2: Diterima -->
                <div class="stat-card p-8">
                    <div class="space-y-2">
                        <p class="stat-label">Jumlah Surat diterima</p>
                        <p class="stat-number">{{ $diterima }}</p>
                    </div>
                </div>

                <!-- Card 3: Ditolak -->
                <div class="stat-card p-8">
                    <div class="space-y-2">
                        <p class="stat-label">Jumlah Surat ditolak</p>
                        <p class="stat-number">{{ $ditolak }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>