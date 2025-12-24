<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
</head>
<body style="margin:0;padding:0;background:#f4f6f8;font-family:Arial,sans-serif;">

  <div style="max-width:600px;margin:40px auto;background:#ffffff;
              border-radius:8px;overflow:hidden;
              box-shadow:0 4px 16px rgba(0,0,0,.08);">

    <div style="background:#194E85;padding:20px;color:#ffffff;">
      <h2 style="margin:0;">SIMAK Diskominfostaper</h2>
    </div>

    <div style="padding:24px;color:#333333;">
      <p>Halo <b>{{ $pengajuan->user->name }}</b>,</p>

      <p style="margin:0 0 14px 0;">
        Pengajuan PKL/Magang Anda telah
        <span style="
          display:inline-block;
          padding:6px 14px;
          border-radius:999px;
          font-weight:700;
          font-size:14px;
          background:#ffffff;
          color:#194E85;
          border:2px solid #194E85;
          vertical-align:middle;
        ">
          {{ strtoupper($pengajuan->status) }}
        </span>
      </p>

      @if($pengajuan->catatan_admin)
        <div style="margin-top:16px;padding:12px;
                    background:#f1f5f9;border-left:4px solid #194E85;">
          <b>Catatan Admin:</b><br>
          {{ $pengajuan->catatan_admin }}
        </div>
      @endif

      <p style="margin-top:24px;">
        Silakan login ke sistem SIMAK untuk melihat detail pengajuan Anda.
      </p>

      <p style="margin-top:32px;margin-bottom:0;">
        Hormat kami,<br>
        <b>Diskominfostaper Kab. Paser</b>
      </p>
    </div>

    <div style="background:#f1f5f9;padding:14px;
                text-align:center;font-size:12px;color:#64748b;">
      Email ini dikirim otomatis oleh sistem SIMAK.
    </div>

  </div>

</body>
</html>