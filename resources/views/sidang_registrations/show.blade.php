@extends('Template.Index')

@section('title', 'Detail Pendaftar Sidang | SIPASTA')

@section('content')
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-2 mb-sm-0 text-gray-800">Detail Pendaftar Sidang</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 d-none d-sm-flex">
                        <li class="breadcrumb-item"><a href="{{ route('sidang-registrations.index') }}">Pendaftar Sidang</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>

            <!-- Content Row -->
            <div class="row">
                <div class="col-12">
                    <!-- Main Card -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fas fa-user-graduate mr-2"></i>Informasi Pendaftar Sidang
                            </h6>
                        </div>
                        <div class="card-body">

                            <!-- Status Verifikasi Cards -->
                            <div class="row mb-4">
                                <div class="col-12 col-lg-6 mb-3 mb-lg-0">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Status Verifikasi Admin
                                                    </div>
                                                    <div class="h6 mb-0 font-weight-bold">
                                                        @php $admin = $sidangRegistration->verifikasi_admin; @endphp
                                                        @if($admin === 'pending')
                                                            <span class="badge badge-warning px-3 py-2">
                                                                <i class="fas fa-clock mr-1"></i>Pending
                                                            </span>
                                                        @elseif($admin === 'diterima')
                                                            <span class="badge badge-success px-3 py-2">
                                                                <i class="fas fa-check mr-1"></i>Diterima
                                                            </span>
                                                        @elseif($admin === 'ditolak')
                                                            <span class="badge badge-danger px-3 py-2">
                                                                <i class="fas fa-times mr-1"></i>Ditolak
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-user-shield fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        Status Verifikasi Kaprodi
                                                    </div>
                                                    <div class="h6 mb-0 font-weight-bold">
                                                        @php $kaprodi = $sidangRegistration->verifikasi_kaprodi; @endphp
                                                        @if($kaprodi === 'pending')
                                                            <span class="badge badge-warning px-3 py-2">
                                                                <i class="fas fa-clock mr-1"></i>Pending
                                                            </span>
                                                        @elseif($kaprodi === 'diterima')
                                                            <span class="badge badge-success px-3 py-2">
                                                                <i class="fas fa-check mr-1"></i>Diterima
                                                            </span>
                                                        @elseif($kaprodi === 'ditolak')
                                                            <span class="badge badge-danger px-3 py-2">
                                                                <i class="fas fa-times mr-1"></i>Ditolak
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Detail Informasi -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <th width="30%" class="bg-light d-none d-md-table-cell">
                                                        <i class="fas fa-calendar-plus text-primary mr-2"></i>Tanggal Daftar
                                                    </th>
                                                    <th class="bg-light d-md-none">
                                                        <i class="fas fa-calendar-plus text-primary mr-1"></i>Tgl Daftar
                                                    </th>
                                                    <td>
                                                        <span class="font-weight-bold text-dark">
                                                            <span class="d-none d-sm-inline">
                                                                {{ optional($sidangRegistration->created_at)->translatedFormat('d F Y') ?? '-' }}
                                                            </span>
                                                            <span class="d-sm-none">
                                                                {{ optional($sidangRegistration->created_at)->format('d/m/Y') ?? '-' }}
                                                            </span>
                                                        </span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th class="bg-light d-none d-md-table-cell">
                                                        <i class="fas fa-book text-primary mr-2"></i>Judul Tugas Akhir
                                                    </th>
                                                    <th class="bg-light d-md-none">
                                                        <i class="fas fa-book text-primary mr-1"></i>Judul TA
                                                    </th>
                                                    <td>
                                                        <div class="text-justify">
                                                            {{ $sidangRegistration->judul_tugas_akhir }}
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th class="bg-light d-none d-md-table-cell">
                                                        <i class="fas fa-chalkboard-teacher text-primary mr-2"></i>Dosen Pembimbing
                                                    </th>
                                                    <th class="bg-light d-md-none">
                                                        <i class="fas fa-chalkboard-teacher text-primary mr-1"></i>Pembimbing
                                                    </th>
                                                    <td>
                                                        <div class="d-flex flex-column flex-sm-row align-items-start">
                                                            {{-- <span class="badge badge-info mr-2 mb-1 mb-sm-0">
                                                                {{ $sidangRegistration->pembimbing->dosenProfile->nidn ?? '-' }}
                                                            </span> --}}
                                                            <span class="font-weight-bold">
                                                                {{ $sidangRegistration->pembimbing->name ?? '-' }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th class="bg-light d-none d-md-table-cell">
                                                        <h class="fas fa-users text-primary mr-2"></h>Dosen Penguji
                                                    </th>
                                                    <th class="bg-light d-md-none">
                                                        <i class="fas fa-users text-primary mr-1"></i>Penguji
                                                    </th>
                                                    <td>
                                                        @if ($sidangRegistration->sidangSchedule)
                                                            <div class="row">
                                                                <div class="col-12 col-sm-4 mb-2">
                                                                    <span class="badge badge-outline-primary w-100 text-left py-2">
                                                                        <strong>1:</strong> {{ $sidangRegistration->sidangSchedule->penguji1->name ?? '-' }}
                                                                    </span>
                                                                </div>
                                                                <div class="col-12 col-sm-4 mb-2">
                                                                    <span class="badge badge-outline-primary w-100 text-left py-2">
                                                                        <strong>2:</strong> {{ $sidangRegistration->sidangSchedule->penguji2->name ?? '-' }}
                                                                    </span>
                                                                </div>
                                                                <div class="col-12 col-sm-4 mb-2">
                                                                    <span class="badge badge-outline-primary w-100 text-left py-2">
                                                                        <strong>3:</strong> {{ $sidangRegistration->sidangSchedule->penguji3->name ?? '-' }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <span class="text-muted font-italic">Belum ditentukan</span>
                                                        @endif
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th class="bg-light d-none d-md-table-cell">
                                                        <i class="fas fa-star text-primary mr-2"></i>Nilai
                                                    </th>
                                                    <th class="bg-light d-md-none">
                                                        <i class="fas fa-star text-primary mr-1"></i>Nilai
                                                    </th>
                                                    <td>
                                                        @php
                                                        $schedule = $sidangRegistration->sidangSchedule;
                                                        $values = $schedule?->values ?? collect();

                                                        $nilai1 = $values->where('penguji_id', $schedule?->penguji_id_1)->first()?->nilai;
                                                        $nilai2 = $values->where('penguji_id', $schedule?->penguji_id_2)->first()?->nilai;
                                                        $nilai3 = $values->where('penguji_id', $schedule?->penguji_id_3)->first()?->nilai;

                                                        $allNilai = collect([$nilai1, $nilai2, $nilai3])->filter();
                                                        $rataRata = $allNilai->count() > 0 ? round($allNilai->avg()) : null;

                                                        function getGrade($nilai) {
                                                            return match (true) {
                                                                $nilai === null => null,
                                                                $nilai >= 85 => 'A+',
                                                                $nilai >= 80 => 'A',
                                                                $nilai >= 75 => 'B+',
                                                                $nilai >= 70 => 'B',
                                                                $nilai >= 65 => 'C+',
                                                                $nilai >= 60 => 'C',
                                                                $nilai >= 50 => 'D',
                                                                default => 'E',
                                                            };
                                                        }

                                                        function getGradeBadgeClass($grade) {
                                                            return match ($grade) {
                                                                'A+', 'A' => 'badge-success',
                                                                'B+', 'B' => 'badge-primary',
                                                                'C+', 'C' => 'badge-warning',
                                                                'D' => 'badge-danger',
                                                                'E' => 'badge-dark',
                                                                default => 'badge-secondary',
                                                            };
                                                        }
                                                        @endphp

                                                        <div class="row mb-3">
                                                            <div class="col-12 col-md-4 mb-2">
                                                                <div class="card border-0 bg-light">
                                                                    <div class="card-body py-2 px-3">
                                                                        <small class="text-muted d-block">Penguji 1</small>
                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                            <span class="font-weight-bold">{{ $nilai1 ?? '-' }}</span>
                                                                            @if($nilai1 !== null)
                                                                                <span class="badge {{ getGradeBadgeClass(getGrade($nilai1)) }}">
                                                                                    {{ getGrade($nilai1) }}
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-4 mb-2">
                                                                <div class="card border-0 bg-light">
                                                                    <div class="card-body py-2 px-3">
                                                                        <small class="text-muted d-block">Penguji 2</small>
                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                            <span class="font-weight-bold">{{ $nilai2 ?? '-' }}</span>
                                                                            @if($nilai2 !== null)
                                                                                <span class="badge {{ getGradeBadgeClass(getGrade($nilai2)) }}">
                                                                                    {{ getGrade($nilai2) }}
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-4 mb-2">
                                                                <div class="card border-0 bg-light">
                                                                    <div class="card-body py-2 px-3">
                                                                        <small class="text-muted d-block">Penguji 3</small>
                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                            <span class="font-weight-bold">{{ $nilai3 ?? '-' }}</span>
                                                                            @if($nilai3 !== null)
                                                                                <span class="badge {{ getGradeBadgeClass(getGrade($nilai3)) }}">
                                                                                    {{ getGrade($nilai3) }}
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="card border-primary">
                                                            <div class="card-body py-2 px-3">
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <span class="font-weight-bold text-primary">Rata-rata:</span>
                                                                    <div>
                                                                        @if($rataRata !== null)
                                                                            <span class="font-weight-bold text-primary mr-2">{{ $rataRata }}</span>
                                                                            <span class="badge badge-lg {{ getGradeBadgeClass(getGrade($rataRata)) }}">
                                                                                {{ getGrade($rataRata) }}
                                                                            </span>
                                                                        @else
                                                                            <span class="text-muted font-italic">Belum lengkap</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Catatan Section -->
                            <div class="row mt-4">
                                <div class="col-12 col-lg-6 mb-3 mb-lg-0">
                                    <div class="card border-left-warning shadow h-100">
                                        <div class="card-header py-2 bg-transparent">
                                            <h6 class="m-0 font-weight-bold text-warning">
                                                <i class="fas fa-sticky-note mr-2"></i>Catatan Admin
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <p class="mb-0 text-gray-800">
                                                {{ $sidangRegistration->catatan_admin ?? 'Tidak ada catatan' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="card border-left-info shadow h-100">
                                        <div class="card-header py-2 bg-transparent">
                                            <h6 class="m-0 font-weight-bold text-info">
                                                <i class="fas fa-clipboard-list mr-2"></i>Catatan Kaprodi
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <p class="mb-0 text-gray-800">
                                                {{ $sidangRegistration->catatan_kaprodi ?? 'Tidak ada catatan' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-start mt-4">
                                <a href="{{ route('sidang-registrations.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
</div>
@endsection
