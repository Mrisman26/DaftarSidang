<!-- resources/views/dashboard/mahasiswa.blade.php -->
@extends('Template.Index')

@section('title', 'Dashboard | SIPASTA')

@section('content')

<div id="wrapper">
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">

            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Dashboard {{ Auth::user()->getRoleNames()->first() }} - SIPASTA</h1>

                <div class="row">

                    <!-- Card Informasi Profil -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow rounded-lg">
                            <div class="card-header bg-primary text-white">
                                <i class="fas fa-user"></i> Informasi Mahasiswa
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>Nama:</strong> {{ Auth::user()->name }}</li>
                                    <li class="list-group-item"><strong>Email:</strong> {{ Auth::user()->email }}</li>

                                    {{-- Menampilkan NIM atau NIDN sesuai dengan role --}}
                                    @if(Auth::user()->hasRole('Mahasiswa'))
                                    <li class="list-group-item"><strong>NIM:</strong>
                                        {{ Auth::user()->mahasiswaProfile->nim ?? 'NIM tidak tersedia' }}</li>
                                    @elseif(Auth::user()->hasRole('Dosen'))
                                    <li class="list-group-item"><strong>NIDN:</strong>
                                        {{ Auth::user()->dosenProfile->nidn ?? 'NIDN tidak tersedia' }}</li>
                                    @endif

                                    {{-- Menampilkan Program Studi, No. HP, dan Alamat --}}
                                    <li class="list-group-item"><strong>Program Studi:</strong>
                                        {{ Auth::user()->hasRole('Mahasiswa') ? Auth::user()->mahasiswaProfile->prodi->nama_prodi ?? 'Prodi tidak tersedia' : 'Tidak berlaku' }}
                                    </li>
                                    <li class="list-group-item"><strong>No. HP:</strong>
                                        {{ Auth::user()->hasRole('Mahasiswa') ? Auth::user()->profile->no_hp ?? 'No. HP tidak tersedia' : (Auth::user()->hasRole('Dosen') ? Auth::user()->dosenProfile->no_hp ?? 'No. HP tidak tersedia' : 'Tidak berlaku') }}
                                    </li>
                                    <li class="list-group-item"><strong>Alamat:</strong>
                                        {{ Auth::user()->hasRole('Mahasiswa') ? Auth::user()->profile->alamat ?? 'Alamat tidak tersedia' : (Auth::user()->hasRole('Dosen') ? Auth::user()->dosenProfile->alamat ?? 'Alamat tidak tersedia' : 'Tidak berlaku') }}
                                    </li>
                                </ul>

                                {{-- Peringatan jika profil belum lengkap --}}
                                @php
                                $user = Auth::user();
                                $isMahasiswa = $user->hasRole('Mahasiswa');
                                $isDosen = $user->hasRole('Dosen');

                                $mahasiswaProfile = $user->mahasiswaProfile;
                                $dosenProfile = $user->dosenProfile;
                                $profile = $user->profile;

                                $nimOrNidn = $isMahasiswa ? ($mahasiswaProfile?->nim) : ($isDosen ?
                                ($dosenProfile?->nidn) : null);
                                $prodiId = $isMahasiswa ? ($mahasiswaProfile?->prodi_id) : ($isDosen ?
                                ($dosenProfile?->prodi_id) : null);
                                @endphp

                                @if(empty($nimOrNidn) || empty($prodiId) || empty($profile?->no_hp) ||
                                empty($profile?->alamat))
                                <div class="alert alert-warning mt-3" role="alert">
                                    <strong>Perhatian!</strong> Profil Anda belum lengkap. Silakan lengkapi data
                                    {{ $isMahasiswa ? 'NIM' : 'NIDN' }},
                                    Program Studi, No. HP, dan Alamat pada halaman <a
                                        href="{{ route('profile.edit') }}">Profil Saya</a>.
                                </div>
                                @endif

                            </div>

                        </div>
                    </div>

                    <!-- Card Status Sidang -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow rounded-lg">
                            <div class="card-header bg-warning text-white">
                                <i class="fas fa-file-alt"></i> Status Pendaftaran Sidang
                            </div>
                            <div class="card-body">
                                @if($sidangRegistration && $sidangRegistration->sidangSchedule)
                                <div class="mt-2">
                                    <h5 class="card-title text-primary">Jadwal Sidang</h5>
                                    <ul class="list-group">

                                        <div class="row mb-2">
                                            {{-- Status Verifikasi Admin --}}
                                            <div class="col-md-6">
                                                <strong>Admin:</strong>
                                                @if($sidangRegistration->verifikasi_admin == 'pending')
                                                <span class="badge bg-warning text-dark">Pending</span>
                                                @elseif($sidangRegistration->verifikasi_admin == 'diterima')
                                                <span class="badge bg-success text-white">Diterima</span>
                                                @elseif($sidangRegistration->verifikasi_admin == 'ditolak')
                                                <span class="badge bg-danger text-white">Ditolak</span>
                                                @else
                                                <span class="badge bg-secondary">-</span>
                                                @endif
                                            </div>
                                            {{-- Status Verifikasi Kaprodi --}}
                                            <div class="col-md-6">
                                                <strong>Kaprodi:</strong>
                                                @if($sidangRegistration->verifikasi_kaprodi == 'pending')
                                                <span class="badge bg-warning text-dark">Pending</span>
                                                @elseif($sidangRegistration->verifikasi_kaprodi == 'diterima')
                                                <span class="badge bg-success text-white">Diterima</span>
                                                @elseif($sidangRegistration->verifikasi_kaprodi == 'ditolak')
                                                <span class="badge bg-danger text-white">Ditolak</span>
                                                @else
                                                <span class="badge bg-secondary">-</span>
                                                @endif
                                            </div>
                                        </div>


                                        {{-- Tanggal Sidang --}}
                                        <li class="list-group-item">
                                            <strong>Tanggal Sidang:</strong>
                                            {{ \Carbon\Carbon::parse($sidangRegistration->sidangSchedule->tanggal_sidang)->translatedFormat('d F Y') }}
                                        </li>

                                        {{-- Ruangan --}}
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <strong>Ruangan:</strong>
                                                    {{ $sidangRegistration->sidangSchedule->ruangan->nama_ruangan ?? 'Belum ditentukan' }}
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>Ruangan:</strong>
                                                    {{ $sidangRegistration->sidangSchedule->ruangan->kode_ruangan ?? 'Belum ditentukan' }}
                                                </div>
                                            </div>
                                        </li>

                                        {{-- Pembimbing --}}
                                        <li class="list-group-item">
                                            <strong>Pembimbing:</strong>
                                            {{ $sidangRegistration->pembimbing->name ?? 'Belum ditentukan' }}
                                        </li>

                                        {{-- Penguji --}}
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <strong>Penguji 1:</strong>
                                                    {{ $sidangRegistration->sidangSchedule->penguji1->name ?? 'Belum ditentukan' }}
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>Penguji 2:</strong>
                                                    {{ $sidangRegistration->sidangSchedule->penguji2->name ?? 'Belum ditentukan' }}
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>Penguji 3:</strong>
                                                    {{ $sidangRegistration->sidangSchedule->penguji3->name ?? 'Belum ditentukan' }}
                                                </div>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                                @else
                                <p class="mt-3">Jadwal sidang belum ditentukan.</p>
                                @endif
                            </div>


                        </div>
                    </div>

                </div>

            </div><!-- /.container-fluid -->

        </div><!-- End of Main Content -->
    </div><!-- End of Content Wrapper -->
</div><!-- End of Page Wrapper -->

@endsection
