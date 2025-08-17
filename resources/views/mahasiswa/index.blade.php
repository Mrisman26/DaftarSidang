@extends('Template.Index')

@section('title', 'Kelola Mahasiswa | SIPASTA')

@section('content')
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid  py-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Kelola Mahasiswa</h5>
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

                        <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Mahasiswa
                        </a>

                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabel-data" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr class="align-middle text-center">
                                    <th>No</th>
                                    <th>Nama</th>
                                    {{-- <th>Email</th> --}}
                                    {{-- <th>NIM</th> --}}
                                    <th>Program Studi</th>
                                    {{-- <th>Nomor HP</th> --}}
                                    {{-- <th>Alamat</th> --}}
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($mahasiswa as $key => $student)
                                <tr class="align-middle text-center">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $student->name }}</td>
                                    {{-- <td>{{ $student->email }}</td> --}}
                                    {{-- <td>{{ $student->profile ? $student->mahasiswaProfile->nim : 'N/A' }}</td> --}}
                                    <td>{{ $student->profile ? $student->mahasiswaProfile->prodi->nama_prodi : 'N/A' }}
                                    </td> <!-- Misalkan prodi punya relasi ke nama -->
                                    {{-- <td>{{ $student->profile ? $student->profile->no_hp : 'N/A' }}</td> --}}
                                    {{-- <td>{{ $student->profile ? $student->profile->alamat : 'N/A' }}</td> --}}
                                    <td>
                                        <!-- Tombol Show (Dapat diakses oleh semua role) -->
                                        <a href="{{ route('mahasiswa.show', $student->id) }}"
                                            class="btn btn-primary btn-sm mb-2">Show</a>

                                        <!-- Tombol Edit dan Delete (Hanya untuk Admin) -->
                                        <a href="{{ route('mahasiswa.edit', $student->id) }}"
                                            class="btn btn-warning btn-sm text-dark mb-2">Edit</a>

                                        <form id="delete-form-{{ $student->id }}"
                                            action="{{ route('mahasiswa.destroy', $student->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm mb-2"
                                                onclick="confirmDelete({{ $student->id }})">
                                                Delete
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="alert alert-danger mb-0 text-center">
                                            Data Mahasiswa belum tersedia.
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
