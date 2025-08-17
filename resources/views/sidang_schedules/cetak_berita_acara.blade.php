<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Berita Acara Sidang</title>
    <style>
        body {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 12px;
            line-height: 1.6;
        }

        h2,
        h3 {
            text-align: center;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #000;
            padding: 6px;
        }

        .signature {
            margin-top: 50px;
            width: 100%;
            text-align: center;
        }

        .signature td {
            padding: 20px;
        }
    </style>
</head>

<body>
    <h2>BERITA ACARA SIDANG</h2>
    <h3>Program Studi {{ $mahasiswa->mahasiswaProfile->prodi->nama_prodi ?? '-' }}</h3>

    @php
    \Carbon\Carbon::setLocale('id');
    @endphp

    <p>
        Pada hari ini, {{ \Carbon\Carbon::parse($sidangSchedule->tanggal_sidang)->translatedFormat('l, d F Y') }},
        pukul {{ $sidangSchedule->jam_mulai }} s.d {{ $sidangSchedule->jam_selesai }} WIB,
        telah dilaksanakan sidang tugas akhir dengan data sebagai berikut:
    </p>


    <table>
        <tr>
            <td style="width: 25%">Nama Mahasiswa</td>
            <td>: {{ $mahasiswa->name ?? '-' }}</td>
        </tr>
        <tr>
            <td>NIM</td>
            <td>: {{ $mahasiswa->mahasiswaProfile->nim ?? '-' }}</td>
        </tr>
        <tr>
            <td>Judul</td>
            <td>: {{ $sidangSchedule->sidangRegistration->judul_tugas_akhir ?? '-' }}</td>
        </tr>
        <tr>
            <td>Ruang</td>
            <td>: {{ $sidangSchedule->ruangan->nama_ruangan ?? '-' }}</td>
        </tr>
    </table>

    <p>Dosen Penguji yang hadir dalam sidang ini:</p>
    <table class="table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Dosen</th>
                <th>Sebagai</th>
                <th>Paraf</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>{{ $sidangSchedule->pembimbing->name ?? '-' }}</td>
                <td>Pembimbing</td>
                <td></td>
            </tr>
            <tr>
                <td>2</td>
                <td>{{ $sidangSchedule->penguji1->name ?? '-' }}</td>
                <td>Penguji 1</td>
                <td></td>
            </tr>
            <tr>
                <td>3</td>
                <td>{{ $sidangSchedule->penguji2->name ?? '-' }}</td>
                <td>Penguji 2</td>
                <td></td>
            </tr>
            @if ($sidangSchedule->penguji3)
            <tr>
                <td>4</td>
                <td>{{ $sidangSchedule->penguji3->name }}</td>
                <td>Penguji 3</td>
                <td></td>
            </tr>
            @endif
        </tbody>
    </table>

    <p>Demikian berita acara ini dibuat untuk digunakan sebagaimana mestinya.</p>

    <div class="signature">
        <table>
            <tr>
                <td>Pembimbing</td>
                <td>Ketua Penguji</td>
            </tr>
            <tr>
                <td style="height: 80px;"></td>
                <td></td>
            </tr>
            <tr>
                <td>{{ $sidangSchedule->pembimbing->name ?? '-' }}</td>
                <td>{{ $sidangSchedule->penguji1->name ?? '-' }}</td>
            </tr>
        </table>
    </div>
</body>

</html>
