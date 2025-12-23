@extends('layouts.app')

@section('content')
<h2>Pengajuan PKL / Magang</h2>

<form action="/pengajuan" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Asal Sekolah / Kampus</label>
    <input type="text" name="asal_instansi" required>

    <label>Jurusan</label>
    <input type="text" name="jurusan" required>

    <label>No HP</label>
    <input type="text" name="no_hp" required>

    <label>Surat Pengantar</label>
    <input type="file" name="surat_pengantar" required>

    <button type="submit">Kirim Pengajuan</button>
</form>
@endsection
