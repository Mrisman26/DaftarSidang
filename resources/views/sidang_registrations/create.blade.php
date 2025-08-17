@extends('Template.Index')

@section('title', 'Form Pendaftaran TA | SIPASTA')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h3 class="text-2xl font-semibold mb-6">Form Pendaftaran Sidang Tugas Akhir</h3>

    @if (session('success'))
    <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    @if ($periode)
    <div class="alert alert-info">
        Pendaftaran dibuka untuk: <strong>{{ $periode->nama_periode }}</strong>
        ({{ \Carbon\Carbon::parse($periode->tanggal_mulai)->translatedFormat('d F Y') }} s.d.
        {{ \Carbon\Carbon::parse($periode->tanggal_selesai)->translatedFormat('d F Y') }})
    </div>
    @endif

    @if($periode)
    <p>Periode Aktif: <strong>{{ $periode->nama_periode }}</strong></p>
    @endif


    <form action="{{ route('sidang-registrations.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Data Mahasiswa --}}
        <div class="card shadow-lg mb-3">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Data Mahasiswa</h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <label class="form-label text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                </div>

                <div class="mb-4">
                    <label class="form-label text-sm font-medium text-gray-700">NIM</label>
                    <input type="text" class="form-control" value="{{ auth()->user()->mahasiswaProfile->nim }}"
                        disabled>
                </div>

                @php
                $user = auth()->user();
                $isMahasiswa = $user->hasRole('Mahasiswa');
                $isDosen = $user->hasRole('Dosen');

                // Ambil nama prodi + jenjang dari relasi yang sesuai
                $prodiNama = '';
                $prodiJenjang = '';

                if ($isMahasiswa && $user->mahasiswaProfile && $user->mahasiswaProfile->prodi) {
                $prodiNama = $user->mahasiswaProfile->prodi->nama_prodi;
                $prodiJenjang = $user->mahasiswaProfile->prodi->jenjang;
                } elseif ($isDosen && $user->dosenProfile && $user->dosenProfile->prodi) {
                $prodiNama = $user->dosenProfile->prodi->nama_prodi;
                $prodiJenjang = $user->dosenProfile->prodi->jenjang;
                }
                @endphp

                @if($prodiNama)
                <div class="mb-4">
                    <label class="form-label text-sm font-medium text-gray-700">Program Studi</label>
                    <input type="text" class="form-control" value="{{ $prodiNama }} ({{ $prodiJenjang }})" disabled>
                </div>
                @endif

            </div>
        </div>

        {{-- Judul Tugas Akhir --}}
        <div class="card shadow-lg mb-3">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Judul Tugas Akhir</h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <label class="form-label text-sm font-medium text-gray-700">Judul Tugas Akhir</label>
                    <input type="text" name="judul_tugas_akhir" class="form-control"
                        value="{{ old('judul_tugas_akhir') }}" required>
                    @error('judul_tugas_akhir')
                    <div class="text-danger mt-1 text-sm">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Pilih Dosen Pembimbing --}}
        <div class="card shadow-lg mb-3">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Pilih Dosen Pembimbing</h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <label for="pembimbing_id">Pilih Dosen Pembimbing</label>
                    <select name="pembimbing_id" id="pembimbing_id" class="form-control" required>
                        <option value="">-- Pilih Dosen Pembimbing --</option>
                        @foreach($dosen as $d)
                        <option value="{{ $d->id }}">
                            {{ $d->name }}
                            ({{ $d->dosenProfile->prodi->nama_prodi ?? '-' }})
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- Berkas Persyaratan --}}
        <div class="card shadow-lg mb-3">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Upload Berkas Persyaratan</h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <label class="form-label text-sm font-medium text-gray-700">Proposal Tugas Akhir (PDF)</label>
                    <input type="file" name="proposal" class="form-control" accept=".pdf" required>
                </div>

                <div class="mb-4">
                    <label class="form-label text-sm font-medium text-gray-700">Transkrip Nilai (PDF)</label>
                    <input type="file" name="transkrip" class="form-control" accept=".pdf" required>
                </div>

                <div class="mb-4">
                    <label class="form-label text-sm font-medium text-gray-700">Kartu Bimbingan (PDF)</label>
                    <input type="file" name="kartu_bimbingan" class="form-control" accept=".pdf" required>
                </div>
            </div>
        </div>

        {{-- Tombol --}}
        <div class="d-flex justify-content-between">
            <a href="{{ route('sidang-registrations.index') }}" class="btn btn-secondary"><i
                    class="fas fa-arrow-left mr-1"></i>Kembali</a>
            <button type="submit"
                class="btn btn-primary px-6 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Daftar Sidang
            </button>
        </div>

    </form>
</div>

@endsection
