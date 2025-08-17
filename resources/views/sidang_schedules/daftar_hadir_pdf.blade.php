<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Daftar Hadir Sidang</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h3 align="center">DAFTAR HADIR SIDANG TUGAS AKHIR</h3>

    <p>Nama Mahasiswa: {{ $mahasiswa->name ?? '-' }}</p>
    <p>Tanggal Sidang: {{ \Carbon\Carbon::parse($sidangSchedule->tanggal_sidang)->format('d-m-Y') }}</p>
    <p>Jam: {{ $sidangSchedule->jam_mulai }} - {{ $sidangSchedule->jam_selesai }}</p>
    <p>Ruangan: {{ $sidangSchedule->ruangan->nama_ruangan ?? '-' }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Dosen</th>
                <th>Sebagai</th>
                <th>Tanda Tangan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>{{ $sidangSchedule->pembimbing->name }}</td>
                <td>Pembimbing</td>
                <td></td>
            </tr>
            <tr>
                <td>2</td>
                <td>{{ $sidangSchedule->penguji1->name }}</td>
                <td>Penguji I</td>
                <td></td>
            </tr>
            @if($sidangSchedule->penguji2)
            <tr>
                <td>3</td>
                <td>{{ $sidangSchedule->penguji2->name }}</td>
                <td>Penguji II</td>
                <td></td>
            </tr>
            @endif
            @if($sidangSchedule->penguji3)
            <tr>
                <td>4</td>
                <td>{{ $sidangSchedule->penguji3->name }}</td>
                <td>Penguji III</td>
                <td></td>
            </tr>
            @endif
        </tbody>
    </table>
</body>

</html>
