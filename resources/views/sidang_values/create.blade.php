@extends('Template.Index')

@section('title', 'Sidang Value | SIPASTA')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tambah Nilai</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('sidang_values.store') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label for="sidang_schedule_id">Pilih Jadwal Sidang</label>
                    <select name="sidang_schedule_id" id="sidang_schedule_id" class="form-control" required>
                        <option value="">-- Pilih Jadwal --</option>
                        @foreach ($jadwalSidangs as $jadwal)
                        @php
                        $tanggal = \Carbon\Carbon::parse($jadwal->tanggal_sidang)->translatedFormat('d F Y');
                        $ruangan = $jadwal->ruangan->nama_ruangan ?? '-';
                        $mahasiswa = $jadwal->sidangRegistration?->user?->name ?? '-';
                        $pengujiList = [
                        $jadwal->penguji1?->name ?? '-',
                        $jadwal->penguji2?->name ?? '-',
                        $jadwal->penguji3?->name ?? '-',
                        ];
                        $pengujiFormatted = implode(', ', $pengujiList);
                        $label = "{$tanggal} | Ruangan: {$ruangan} | Mahasiswa: {$mahasiswa} | Penguji:
                        {$pengujiFormatted}";
                        @endphp
                        <option value="{{ $jadwal->id }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group mb-3">
                    <label for="nilai">Nilai (0 - 100)</label>
                    <input type="number" name="nilai" id="nilai" class="form-control" min="0" max="100" required>
                </div>

                <div class="form-group mb-3">
                    <label for="komentar">Komentar (Opsional)</label>
                    <textarea name="komentar" id="komentar" class="form-control"></textarea>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('sidang_values.index') }}" class="btn btn-secondary"><i
                            class="fas fa-arrow-left mr-1"></i>Kembali</a>
                    <button type="submit"
                        class="btn btn-primary px-6 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
