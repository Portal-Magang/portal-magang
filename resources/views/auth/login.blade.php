<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Portal PKL/Magang</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

<header class="topbar">
  <a href="{{ url('/') }}">
    <img src="{{ asset('asset/logo.png') }}" alt="Logo">
  </a>
</header>

<main class="wrap">
  <section class="shell">
    <div class="left">
      <div class="badge"><i></i> Login Akun</div>
      <h1>Selamat datang</h1>
      <p class="sub">Masuk untuk melanjutkan pendaftaran PKL/Magang dan melihat status pengajuan.</p>

      {{-- contoh tampil error (optional) --}}
      @if ($errors->any())
        <p class="sub" style="color:#b91c1c;font-weight:800;">
          {{ $errors->first() }}
        </p>
      @endif

      <form id="loginForm" class="form" method="POST" action="{{ url('/login') }}">
        @csrf

        <div class="field">
            <label>Email</label>
            <input
            class="input @error('email') is-error @enderror"
            type="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="contoh: nama@email.com"
            required
            autofocus
            >
            @error('email')
            <div class="err">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label>Password</label>

            <div class="pw-wrap">
            <input
                id="loginPassword"
                class="input @error('password') is-error @enderror"
                type="password"
                name="password"
                placeholder="••••••••"
                required
            >
            <button type="button" class="pw-btn" data-toggle="loginPassword" aria-label="Tampilkan password">
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

        <div class="row">
            <label class="check">
            <input type="checkbox" name="remember">
            Ingat saya
            </label>
        </div>

        <button id="loginBtn" class="btn" type="submit">
            <span class="btn-loading" style="display:none;">
            <span class="spinner"></span> Memproses...
            </span>
            <span class="btn-text">Masuk</span>
        </button>

        <div class="alt">
            Belum punya akun? <a href="{{ route('register') }}">Registrasi</a>
        </div>
        </form>

        <script>
          // show/hide password + toggle icon
          document.querySelectorAll('.pw-btn').forEach(btn => {
            btn.addEventListener('click', () => {
              const id = btn.dataset.toggle;
              const input = document.getElementById(id);
              if (!input) return; // safety

              const isPassword = input.type === 'password';
              input.type = isPassword ? 'text' : 'password';
              btn.classList.toggle('is-on', isPassword);
              btn.setAttribute('aria-label', isPassword ? 'Sembunyikan password' : 'Tampilkan password');
            });
          });

          // loading state (LOGIN)
          const form = document.getElementById('loginForm');
          const submitBtn = document.getElementById('loginBtn');

          form.addEventListener('submit', () => {
            submitBtn.disabled = true;
            submitBtn.querySelector('.btn-text').style.display = 'none';
            submitBtn.querySelector('.btn-loading').style.display = 'inline-flex';
          });
        </script>
    </div>

    <aside class="right">
      <div class="r-inner">
        <h2 class="r-title">SIMAK Diskominfostaper</h2>

        <div class="r-list">
          <div class="r-item">
            <div class="dot">1</div>
            <div><b>Pendaftaran cepat</b><span>Isi data dan unggah dokumen sesuai persyaratan.</span></div>
          </div>
          <div class="r-item">
            <div class="dot">2</div>
            <div><b>Status jelas</b><span>Pantau proses verifikasi dan hasil seleksi.</span></div>
          </div>
          <div class="r-item">
            <div class="dot">3</div>
            <div><b>Lebih tertata</b><span>Data tersimpan aman dan mudah diakses.</span></div>
          </div>
        </div>
      </div>
    </aside>
  </section>
</main>
</body>
</html>