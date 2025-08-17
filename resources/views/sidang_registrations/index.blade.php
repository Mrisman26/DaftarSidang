@extends('Template.Index')

@section('title', 'Daftar Sidang | SIPASTA')

@section('content')
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid py-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Daftar Pendaftar Sidang</h5>
                </div>
                <div class="card-body">

                    @if(session('success'))
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: "{{ session('success') }}",
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        });
                    </script>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0"></h6>
                        @role('Mahasiswa')
                        @php
                        $latest = $sidangRegistrations->first(); // data terbaru setelah di-sort di controller
                        @endphp

                        @if (is_null($latest) || $latest->verifikasi_admin === 'ditolak' || $latest->verifikasi_kaprodi
                        === 'ditolak')
                        <a href="{{ route('sidang-registrations.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Ajukan Pendaftaran
                        </a>
                        @endif
                        @endrole
                    </div>


                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabel-data" width="100%" cellspacing="0">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Tanggal Daftar</th>
                                    {{-- <th>Judul Tugas Akhir</th> --}}
                                    {{-- <th>Dosen Pembimbing dan Penguji</th> --}}
                                    {{-- <th>Nilai</th> --}}
                                    <th>Status Verifikasi Admin</th>
                                    <th>Status Verifikasi Kaprodi</th>
                                    {{-- <th>Nilai</th> --}}
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sidangRegistrations as $key => $sidang)
                                <tr class="align-middle text-center">
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        {{ $sidang->user->name ?? '-' }}</td>
                                    </td>
                                    <td>
                                        @if($sidang->created_at)
                                        {{ \Carbon\Carbon::parse($sidang->created_at)->translatedFormat('d F Y') }}
                                        @else
                                        <em>Belum ditentukan</em>
                                        @endif
                                    </td>

                                    <td>
                                        {{-- Status Verifikasi Admin --}}
                                        @if($sidang->verifikasi_admin == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($sidang->verifikasi_admin == 'diterima')
                                        <span class="badge bg-success text-white">Diterima</span>
                                        @elseif($sidang->verifikasi_admin == 'ditolak')
                                        <span class="badge bg-danger text-white">Ditolak</span>
                                        @else
                                        <span class="badge bg-secondary">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- Status Verifikasi Kaprodi --}}
                                        @if($sidang->verifikasi_kaprodi == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($sidang->verifikasi_kaprodi == 'diterima')
                                        <span class="badge bg-success text-white">Diterima</span>
                                        @elseif($sidang->verifikasi_kaprodi == 'ditolak')
                                        <span class="badge bg-danger text-white">Ditolak</span>
                                        @else
                                        <span class="badge bg-secondary">-</span>
                                        @endif
                                    </td>

                                    @foreach ($sidangRegistrations as $sidangRegistration)
                                    {{-- <td>
                                        @php
                                        $nilai = optional(optional($sidang->sidangSchedule)->values)->first()->nilai ??
                                        null;

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
                                        @endphp

                                        @if($nilai !== null)
                                        <strong>{{ getGrade($nilai) }}</strong> ({{ $nilai }})
                                        @else
                                        <em>Belum dinilai</em>
                                        @endif
                                    </td> --}}

                                    @endforeach


                                    <td>
                                        <div class="d-flex flex-wrap justify-content-center gap-1">

                                            <a href="{{ route('sidang-registrations.show', $sidang) }}"
                                                class="btn btn-primary btn-sm mr-1 mb-1">Detail</a>

                                            @role('Admin|Kaprodi')

                                            {{-- Tombol Verifikasi --}}
                                            @if (
                                            (auth()->user()->hasRole('Admin') && $sidang->verifikasi_admin !==
                                            'diterima') ||
                                            (auth()->user()->hasRole('Kaprodi') && $sidang->verifikasi_kaprodi !==
                                            'diterima')
                                            )
                                            @if (auth()->user()->hasRole('Admin'))
                                            <a href="{{ route('sidang.verifikasi.admin', $sidang->id) }}"
                                                class="btn btn-info btn-sm mr-1 mb-1">Verifikasi Admin</a>
                                            @endif

                                            @if (auth()->user()->hasRole('Kaprodi'))
                                            <a href="{{ route('sidang.verifikasi.kaprodi', $sidang->id) }}"
                                                class="btn btn-warning btn-sm mr-1 mb-1">Verifikasi Kaprodi</a>
                                            @endif
                                            @endif

                                            {{-- Tombol Hapus --}}
                                            @role('Admin')
                                            <form id="delete-form-{{ $sidang->id }}"
                                                action="{{ route('sidang-registrations.destroy', $sidang) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm mb-1"
                                                    onclick="confirmDelete({{ $sidang->id }})">Hapus</button>
                                            </form>
                                            @endif

                                            @endrole

                                            @role('Mahasiswa')
                                            @if (!$sidang->values && ($sidang->verifikasi_admin === 'ditolak' ||
                                            $sidang->verifikasi_kaprodi === 'ditolak'))
                                            <a href="{{ route('sidang-registrations.edit', $sidang) }}"
                                                class="btn btn-warning text-dark btn-sm mr-1 mb-1">Edit Pengajuan</a>
                                            @endif
                                            @endrole


                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="alert alert-danger mb-0 text-center">
                                            Data Pendaftar Sidang belum tersedia.
                                        </div>
                                    </td>
                                </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: "Yakin ingin menghapus?",
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection
