@extends('layouts.admin')

@section('content')
<h2>Detail Pengajuan</h2>

<p><strong>Nama:</strong> {{ $pengajuan->user->name }}</p>
<p><strong>Email:</strong> {{ $pengajuan->user->email }}</p>
<p><strong>Asal Instansi:</strong> {{ $pengajuan->asal_instansi }}</p>
<p><strong>Jurusan:</strong> {{ $pengajuan->jurusan }}</p>
<p><strong>No HP:</strong> {{ $pengajuan->no_hp }}</p>

<p>
    <strong>Surat Pengantar:</strong><br>
    <a href="{{ asset('storage/'.$pengajuan->surat_pengantar) }}" target="_blank">
        Lihat Surat
    </a>
</p>

<hr>

<form method="POST" action="/admin/verifikasi/{{ $pengajuan->id }}">
    @csrf

    <label>Status</label><br>
    <select name="status" required>
        <option value="">-- Pilih --</option>
        <option value="diterima">Terima</option>
        <option value="ditolak">Tolak</option>
    </select>

    <br><br>

    <label>Catatan Admin</label><br>
    <textarea name="catatan_admin" rows="4"></textarea>

    <br><br>

    <button type="submit">Simpan Keputusan</button>
</form>
@endsection