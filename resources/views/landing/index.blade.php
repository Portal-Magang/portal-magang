<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>SIMAK Diskominfostaper</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    * {
      font-family: 'Inter', sans-serif;
    }

    .hero-bg {
    background-image: url("/asset/landing.png");
    background-size: cover;
    background-position: center;
  }
  </style>
</head>

<body class="bg-white text-gray-800">

  <!-- TOP BAR -->
  <header class="w-full bg-white shadow-sm fixed top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
      <img src="{{ asset('asset/logo.png') }}" alt="Diskominfostaper" class="h-10">

    </div>
  </header>

  <!-- HERO -->
  <section class="min-h-screen flex items-center justify-center text-center relative hero-bg">

    <div class="absolute inset-0 bg-black/60"></div>

    <div class="relative z-10 max-w-3xl px-6">
      <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight">
        SIMAK Diskominfostaper
      </h1>

      <p class="text-gray-200 mt-6 text-lg leading-relaxed">
        Sistem Informasi Magang dan Praktik Kerja Lapangan sebagai portal resmi
        pendaftaran Magang dan Praktik Kerja Lapangan di
        <span class="font-semibold text-white">Diskominfostaper Kabupaten Paser</span>.
      </p>

      <div class="mt-8 flex justify-center gap-4 flex-wrap">
        @auth
          <a href="{{ route('dashboard') }}"
            class="bg-[#001B61] text-white px-6 py-3 rounded-xl font-semibold hover:bg-[#00133f] transition">
            Masuk Dashboard
          </a>
        @endauth
      </div>
    </div>
  </section>

  <!-- FITUR -->
  <section class="py-20 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6 text-center">
      <h2 class="text-3xl font-bold text-[#001B61] mb-6">
        Kenapa SIMAK?
      </h2>

      <div class="grid md:grid-cols-3 gap-8 mt-12">
        <div class="bg-white p-8 rounded-2xl shadow hover:shadow-lg transition">
          <h3 class="font-semibold text-lg mb-2">Pendaftaran Terpusat</h3>
          <p class="text-gray-600 text-sm">
            Semua proses PKL & Magang dilakukan dalam satu sistem yang terintegrasi.
          </p>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow hover:shadow-lg transition">
          <h3 class="font-semibold text-lg mb-2">Transparan & Terpantau</h3>
          <p class="text-gray-600 text-sm">
            Pantau status pengajuan secara real-time tanpa harus datang langsung.
          </p>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow hover:shadow-lg transition">
          <h3 class="font-semibold text-lg mb-2">Mudah & Cepat</h3>
          <p class="text-gray-600 text-sm">
            Proses pendaftaran lebih praktis, efisien, dan terdokumentasi dengan baik.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- ALUR -->
  <section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-6 text-center">
      <h2 class="text-3xl font-bold text-[#001B61] mb-10">
        Alur Pendaftaran
      </h2>

      <div class="grid md:grid-cols-4 gap-6 text-sm">
        <div class="p-6 border rounded-xl">
          <span class="font-bold text-[#001B61]">1.</span>
          <p class="mt-2">Registrasi Akun</p>
        </div>
        <div class="p-6 border rounded-xl">
          <span class="font-bold text-[#001B61]">2.</span>
          <p class="mt-2">Isi Form Pengajuan</p>
        </div>
        <div class="p-6 border rounded-xl">
          <span class="font-bold text-[#001B61]">3.</span>
          <p class="mt-2">Menunggu Verifikasi</p>
        </div>
        <div class="p-6 border rounded-xl">
          <span class="font-bold text-[#001B61]">4.</span>
          <p class="mt-2">Pengumuman Hasil</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="py-20 bg-[#001B61] text-center text-white">
    <h2 class="text-3xl font-bold mb-4">
      Siap Mengembangkan Kompetensimu?
    </h2>
    <p class="text-gray-200 mb-8">
      Daftar sekarang dan mulai pengalaman profesionalmu bersama Diskominfostaper.
    </p>

    <a href="{{ route('login') }}"
      class="bg-white text-[#001B61] px-6 py-3 rounded-xl font-semibold hover:bg-gray-100 transition mr-4">
      Daftar Sekarang
    </a>
  </section>

  <!-- FOOTER -->
  <footer class="py-6 text-center text-sm text-gray-500">
    © {{ date('Y') }} Diskominfostaper — SIMAK
  </footer>

</body>

</html>