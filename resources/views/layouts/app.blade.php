<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>User Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

</head>

<body class="min-h-screen">

    {{-- Sidebar / Navbar --}}
    <div class="flex">
        {{-- Sidebar --}}
        <div class="sidebar w-56 p-8">
            <!-- Logo -->
            <div class="mb-12">
                <img src="{{ asset('asset/logo.png') }}" alt="Diskominfostaper" class="logo">
            </div>

            <!-- Navigation -->
            <nav class="space-y-1">
                <!-- PENDAFTARAN -->
                <a href="{{ url('/pengajuan') }}"
                    class="nav-link flex items-center gap-2 px-3 py-2.5 rounded-lg font-medium text-gray-700">

                    <i class="fa-regular fa-address-card text-xl"></i>
                    <span class="text-sm"><b>Form Pengajuan</b></span>
                </a>


                <!-- Riwayat -->
                <a href="{{ url('/riwayat-surat') }}" class="nav-link flex items-center gap-2 px-3 py-2.5 rounded-lg text-gray-700 
                    font-medium">

                    <!-- Icon Riwayat -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                    <span class="text-sm"><b>Riwayat</b></span>
                </a>
            </nav>
        </div>

        {{-- MAIN CONTENT --}}
        <main class="flex-1">
            @yield('content') {{-- 🔴 INI WAJIB --}}
        </main>
    </div>

</body>

</html>