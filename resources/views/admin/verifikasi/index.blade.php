@extends('layouts.admin')

@section('content')
<h2>Verifikasi Surat Magang</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>Nama</th>
        <th>Asal Instansi</th>
        <th>Tanggal</th>
        <th>Aksi</th>
    </tr>

    @foreach($pengajuans as $p)
    <tr>
        <td>{{ $p->user->name }}</td>
        <td>{{ $p->asal_instansi }}</td>
        <td>{{ $p->tanggal_ajuan->format('d/m/Y') }}</td>
        <td>
            <a href="/admin/verifikasi/{{ $p->id }}">Detail</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection