@extends('Template.Index')

@section('title', 'Kelola Dosen | SIPASTA')

@section('content')
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid  py-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Kelola Dosen</h5>
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

                        <a href="{{ route('dosen.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Dosen
                        </a>

                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabel-data" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr class="align-middle text-center">
                                    <th>No</th>
                                    <th>Nama</th>
                                    {{-- <th>Email</th> --}}
                                    {{-- <th>NIDN</th> --}}
                                    <th>Program Studi</th>
                                    <th>Dosen</th>
                                    {{-- <th>Alamat</th> --}}
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dosen as $key => $teacher)
                                <tr class="align-middle text-center">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $teacher->name }}</td>
                                    {{-- <td>{{ $student->email }}</td> --}}
                                    {{-- <td>{{ $teacher->profile ? $teacher->dosenProfile->nidn : 'N/A' }}</td> --}}
                                    <td>{{ $teacher->dosenProfile?->prodi?->nama_prodi ?? 'N/A' }}</td>

                                    <!-- Misalkan prodi punya relasi ke nama -->
                                    {{-- <td>{{ $teacher->profile ? $teacher->profile->no_hp : 'N/A' }}</td> --}}
                                    {{-- <td>{{ $student->profile ? $student->profile->alamat : 'N/A' }}</td> --}}
                                    <td>
                                        @if ($teacher->dosenProfile?->is_pembimbing)
                                            <span class="badge bg-info text-white">Pembimbing</span>
                                        @endif
                                        @if ($teacher->dosenProfile?->is_penguji)
                                            <span class="badge bg-success text-dark">Penguji</span>
                                        @endif
                                        @if (!$teacher->dosenProfile?->is_pembimbing && !$teacher->dosenProfile?->is_penguji)
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Tombol Show (Dapat diakses oleh semua role) -->
                                        <a href="{{ route('dosen.show', $teacher->id) }}"
                                            class="btn btn-primary btn-sm mb-2">Show</a>

                                        <!-- Tombol Edit dan Delete (Hanya untuk Admin) -->
                                        <a href="{{ route('dosen.edit', $teacher->id) }}"
                                            class="btn btn-warning text-dark btn-sm mb-2">Edit</a>

                                        <form id="delete-form-{{ $teacher->id }}"
                                            action="{{ route('dosen.destroy', $teacher->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm mb-2"
                                                onclick="confirmDelete({{ $teacher->id }})">
                                                Delete
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="alert alert-danger mb-0 text-center">
                                            Data Dosen belum tersedia.
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
