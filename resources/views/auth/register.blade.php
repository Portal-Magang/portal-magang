<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Registrasi - Portal PKL & Magang</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

<!-- TOP BAR PUTIH -->
<header class="topbar">
  <a href="{{ url('/') }}">
    <img src="{{ asset('asset/logo.png') }}" alt="Logo">
  </a>
</header>

<main class="wrap">
  <section class="shell">

    <!-- LEFT : FORM -->
    <div class="left">
      <div class="badge"><i></i> Registrasi Akun</div>

      <h1>Buat Akun Baru</h1>
      <p class="sub">
        Silakan lengkapi data berikut untuk membuat akun SIMAK 
      </p>

      <form id="registerForm" class="form" method="POST" action="{{ route('register') }}">
        @csrf

        <!-- NAMA -->
        <div class="field">
          <label>Nama Lengkap</label>
          <input
            class="input @error('name') is-error @enderror"
            type="text"
            name="name"
            value="{{ old('name') }}"
            placeholder="Nama lengkap"
            required
          >
          @error('name')
            <div class="err">{{ $message }}</div>
          @enderror
        </div>

        <!-- EMAIL -->
        <div class="field">
          <label>Email</label>
          <input
            class="input @error('email') is-error @enderror"
            type="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="contoh@email.com"
            required
          >
          @error('email')
            <div class="err">{{ $message }}</div>
          @enderror
        </div>

        <!-- PASSWORD -->
        <div class="field">
          <label>Password</label>
          <div class="pw-wrap">
            <input
              id="regPassword"
              class="input @error('password') is-error @enderror"
              type="password"
              name="password"
              placeholder="Minimal 8 karakter"
              required
            >
            <button type="button" class="pw-btn" data-toggle="regPassword" aria-label="Tampilkan password">
            <svg class="eye eye-open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z"/>
              <circle cx="12" cy="12" r="3"/>
            </svg>
            <svg class="eye eye-off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M3 3l18 18"/>
              <path d="M10.58 10.58A3 3 0 0 0 12 15a3 3 0 0 0 2.42-4.42"/>
              <path d="M9.88 5.06A10.94 10.94 0 0 1 12 5c6.5 0 10 7 10 7a18.4 18.4 0 0 1-3.13 4.32"/>
              <path d="M6.61 6.61A18.4 18.4 0 0 0 2 12s3.5 7 10 7a10.94 10.94 0 0 0 3.06-.44"/>
            </svg>
          </button>
          </div>
          @error('password')
            <div class="err">{{ $message }}</div>
          @enderror
        </div>

        <!-- KONFIRMASI PASSWORD -->
        <div class="field">
          <label>Konfirmasi Password</label>
          <div class="pw-wrap">
            <input
              id="regPassword2"
              class="input"
              type="password"
              name="password_confirmation"
              placeholder="Ulangi password"
              required
            >
            <button type="button" class="pw-btn" data-toggle="regPassword2" aria-label="Tampilkan password">
              <svg class="eye eye-open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z"/>
                <circle cx="12" cy="12" r="3"/>
              </svg>
              <svg class="eye eye-off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 3l18 18"/>
                <path d="M10.58 10.58A3 3 0 0 0 12 15a3 3 0 0 0 2.42-4.42"/>
                <path d="M9.88 5.06A10.94 10.94 0 0 1 12 5c6.5 0 10 7 10 7a18.4 18.4 0 0 1-3.13 4.32"/>
                <path d="M6.61 6.61A18.4 18.4 0 0 0 2 12s3.5 7 10 7a10.94 10.94 0 0 0 3.06-.44"/>
              </svg>
            </button>
          </div>
        </div>

        <!-- SUBMIT -->
        <button id="registerBtn" class="btn" type="submit">
          <span class="btn-loading" style="display:none;">
            <span class="spinner"></span> Memproses...
          </span>
          <span class="btn-text">Daftar</span>
        </button>

        <div class="alt">
          Sudah punya akun?
          <a href="{{ route('login') }}">Login</a>
        </div>
      </form>
    </div>

    <!-- RIGHT : INFO -->
    <aside class="right">
      <div class="r-inner">
        <h2 class="r-title">SIMAK Diskominfostaper</h2>
        <div class="r-list">
          <div class="r-item">
            <div class="dot">1</div>
            <div>
              <b>Isi Data</b>
              <span>Lengkapi informasi pribadi dan akademik.</span>
            </div>
          </div>
          <div class="r-item">
            <div class="dot">2</div>
            <div>
              <b>Ajukan PKL</b>
              <span>Kirim permohonan PKL/Magang secara online.</span>
            </div>
          </div>
          <div class="r-item">
            <div class="dot">3</div>
            <div>
              <b>Pantau Status</b>
              <span>Lihat proses verifikasi dan hasil pengajuan.</span>
            </div>
          </div>
        </div>
      </div>
    </aside>

  </section>
</main>

<!-- SCRIPT -->
<script>
  document.querySelectorAll('.pw-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.dataset.toggle;
      const input = document.getElementById(id);
      const isPassword = input.type === 'password';

      input.type = isPassword ? 'text' : 'password';

      // toggle ikon state
      btn.classList.toggle('is-on', isPassword);

      // update label aksesibilitas
      btn.setAttribute('aria-label', isPassword ? 'Sembunyikan password' : 'Tampilkan password');
    });
  });

  const form = document.getElementById('registerForm');
  const submitBtn = document.getElementById('registerBtn');

  form.addEventListener('submit', () => {
    submitBtn.disabled = true;
    submitBtn.querySelector('.btn-text').style.display = 'none';
    submitBtn.querySelector('.btn-loading').style.display = 'inline-flex';
  });
</script>

</body>
</html>