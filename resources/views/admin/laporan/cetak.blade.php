<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pengajuan Tahun {{ $tahun }}</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #000;
            margin: 40px;
        }

        h1, h2 {
            text-align: center;
            margin: 0;
        }

        h1 {
            font-size: 18px;
            margin-bottom: 6px;
        }

        h2 {
            font-size: 14px;
            font-weight: normal;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px 8px;
        }

        th {
            background-color: #f0f0f0;
            text-align: center;
        }

        td.center {
            text-align: center;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
        }

        @media print {
            body {
                margin: 20px;
            }
        }
    </style>
</head>
<body onload="window.print()">

    <h1>LAPORAN PENGAJUAN SURAT</h1>
    <!-- Display tahun correctly on print page -->
    <h2>Tahun {{ $tahun }}</h2>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Tanggal</th>
                <th width="20%">Nama Peserta</th>
                <th width="25%">Instansi / Sekolah</th>
                <th width="20%">Jurusan</th>
                <th width="15%">Status</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp

            @forelse($laporanTahunan as $pengajuan)
                @foreach($pengajuan->peserta as $peserta)
                    <tr>
                        <td class="center">{{ $no++ }}</td>
                        <td class="center">{{ $pengajuan->created_at->format('d-m-Y') }}</td>
                        <td>{{ $peserta->nama_pengaju }}</td>
                        <td>{{ $pengajuan->asal_instansi }}</td>
                        <td>{{ $peserta->jurusan }}</td>
                        <td class="center">{{ ucfirst($pengajuan->status) }}</td>
                    </tr>
                @endforeach
            @empty
                <tr>
                    <td colspan="6" class="center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>{{ now()->translatedFormat('d F Y') }}</p>
    </div>

</body>
</html>
