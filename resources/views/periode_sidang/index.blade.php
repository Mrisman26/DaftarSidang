@extends('Template.Index')

@section('title', 'Periode Sidang Akademik | SIPASTA')

@section('content')

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid py-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Data Periode Sidang</h5>
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

                        <a href="{{ route('periode_sidang.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Periode Sidang
                        </a>

                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabel-data" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr class="align-middle text-center"">
                                    <th width=" 5%">No</th>
                                    <th width="30%">Periode</th>
                                    <th width="30%">Prodi</th>
                                    <th width="20%">Tanggal Mulai</th>
                                    <th width="20%">Tanggal Selesai</th>
                                    <th width="15%">Status</th>
                                    <th width="10%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($periodes as $key => $periode)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $periode->nama_periode }}</td>
                                    <td>{{ $periode->prodi->nama_prodi ?? '-' }}</td>
                                    <td>
                                        <span class="d-flex align-items-center">
                                            <i class="bi bi-calendar-event me-2 text-primary"></i>
                                            {{ \Carbon\Carbon::parse($periode->tanggal_mulai)->translatedFormat('d F Y') }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="d-flex align-items-center">
                                            <i class="bi bi-calendar-check me-2 text-primary"></i>
                                            {{ \Carbon\Carbon::parse($periode->tanggal_selesai)->translatedFormat('d F Y') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if($periode->is_aktif == 'Akan Datang')
                                        <span class="badge bg-warning text-dark">Akan Datang</span>
                                        @elseif($periode->is_aktif == 'Aktif')
                                        <span class="badge bg-success text-white">Aktif</span>
                                        @elseif($periode->is_aktif == 'Selesai')
                                        <span class="badge bg-secondary text-white">Selesai</span>
                                        @else
                                        <span class="badge bg-dark text-white">Tidak Diketahui</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('periode_sidang.edit', $periode->id) }}"
                                                class="btn btn-warning text-dark btn-sm mr-1 mb-1">Edit</a>
                                            <form id="delete-form-{{ $periode->id }}"
                                                action="{{ route('periode_sidang.destroy', $periode) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm mb-1"
                                                    onclick="confirmDelete({{ $periode->id }})">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="alert alert-danger mb-0 text-center">
                                            Data Periode Sidang belum Tersedia.
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
