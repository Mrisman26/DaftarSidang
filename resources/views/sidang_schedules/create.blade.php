@extends('Template.Index')

@section('title', 'Create Jadwal Sidang | SIPASTA')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tambah Jadwal Sidang</h5>
        </div>
        <div class="card-body">

            @if ($errors->has('peran'))
            <div class="alert alert-danger">
                {{ $errors->first('peran') }}
            </div>
            @endif

            @php
            $pendaftarData = $pendaftar->mapWithKeys(function($p) {
            return [$p->id => ['pembimbing_id' => $p->pembimbing_id, 'pembimbing_nama' => $p->pembimbing->name ?? '']];
            });
            @endphp
            <script>
                const pendaftarMap = @json($pendaftarData);

                function setPembimbing(val) {
                    const pembimbing = pendaftarMap[val];
                    document.getElementById('pembimbing_name').value = pembimbing ? pembimbing.pembimbing_nama : '';
                    document.getElementById('pembimbing_id').value = pembimbing ? pembimbing.pembimbing_id : '';
                }
            </script>


            <form action="{{ route('sidang-schedules.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="sidang_registration_id">Mahasiswa</label>
                    <select name="sidang_registration_id" class="form-control" onchange="setPembimbing(this.value)"
                        required>
                        <option value="">-- Pilih Mahasiswa --</option>
                        @foreach($pendaftar as $p)
                        <option value="{{ $p->id }}">{{ $p->user->name }} - {{ $p->judul_tugas_akhir }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="mb-3">
                    <label for="tanggal_sidang">Tanggal</label>
                    <input type="date" name="tanggal_sidang" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="jam_mulai">Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="jam_selesai">Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="ruangan_id" class="form-label">Ruangan Sidang</label>
                    <select name="ruangan_id" id="ruangan_id" class="form-control" required>
                        <option value="">-- Pilih Ruangan --</option>
                        @foreach($ruangans as $ruangan)
                        <option value="{{ $ruangan->id }}">{{ $ruangan->kode_ruangan }} - {{ $ruangan->nama_ruangan }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="pembimbing_name">Dosen Pembimbing</label>
                    <input type="text" id="pembimbing_name" class="form-control" disabled>
                    <input type="hidden" name="pembimbing_id" id="pembimbing_id">
                </div>

                <div class="mb-3">
                    <label for="penguji_id_1">Penguji 1</label>
                    <select name="penguji_id_1" class="form-control" required>
                        <option value="">-- Pilih Penguji 1 --</option>
                        @foreach($pengujis as $dosen)
                        <option value="{{ $dosen->id }}">{{ $dosen->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="penguji_id_2">Penguji 2</label>
                    <select name="penguji_id_2" class="form-control">
                        <option value="">-- Pilih Penguji 2 --</option>
                        @foreach($pengujis as $dosen)
                        <option value="{{ $dosen->id }}">{{ $dosen->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="penguji_id_3">Penguji 3</label>
                    <select name="penguji_id_3" class="form-control">
                        <option value="">-- Pilih Penguji 3 --</option>
                        @foreach($pengujis as $dosen)
                        <option value="{{ $dosen->id }}">{{ $dosen->name }}</option>
                        @endforeach
                    </select>
                </div>



                <button class="btn btn-primary">Simpan Jadwal</button>
                <a href="{{ route('sidang-schedules.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
