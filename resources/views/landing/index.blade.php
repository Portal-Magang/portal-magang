<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>SIMAK Diskominfostaper</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>

<body>

<!-- TOP BAR PUTIH -->
<header class="topbar">
  <img src="{{ asset('asset/logo.png') }}" alt="Diskominfostaper">
</header>

<!-- HERO FULL BACKGROUND -->
<section class="hero" style="--bg: url('{{ asset('asset/landing.png') }}');">

  <div class="hero-content">
    <h1>SIMAK Diskominfostaper</h1>

    <p>
      SIMAK adalah Sistem Informasi Magang & PKL<br>
      Portal ini disediakan sebagai sarana pendaftaran Praktik Kerja Lapangan (PKL)
      dan Magang bagi mahasiswa maupun pelajar yang ingin mengembangkan kompetensi,
      pengalaman kerja, serta pemahaman dunia profesional secara langsung di Diskominfostaper.
    </p>

    <h2>Daftar Disini</h2>

    <div class="actions">
      <a href="{{ route('login') }}" class="btn">Login</a>
      <a href="{{ route('register') }}" class="btn">Registrasi</a>
    </div>
  </div>

</section>

</body>
</html>