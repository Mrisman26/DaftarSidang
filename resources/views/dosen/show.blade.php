@extends('Template.Index')

@section('title', 'Detail Dosen | SIPASTA')

@section('content')
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container">
            <!-- Judul Halaman -->
            {{-- <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center mb-4">Detail Dosen</h2>
                </div>
            </div> --}}

            <!-- Card Detail Mahasiswa -->
            <div class="card mt-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="m-0"></h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Kolom Kiri: Foto Mahasiswa -->
                        <div class="col-md-4 text-center">

                        </div>

                        <!-- Kolom Kanan: Detail Mahasiswa -->
                        <div class="col-md-8 ">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Nama</th>
                                        <td>{{ $dosen->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $dosen->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>NIDN</th>
                                        <td>{{ $dosen->profile ? $dosen->dosenProfile->nidn : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Program Studi</th>
                                        <td>{{ $dosen->profile ? $dosen->dosenProfile->prodi->nama_prodi : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Dosen</th>
                                        <td>
                                        @if ($dosen->dosenProfile?->is_pembimbing)
                                            <span class="badge bg-info text-white">Pembimbing</span>
                                        @endif
                                        @if ($dosen->dosenProfile?->is_penguji)
                                            <span class="badge bg-success text-dark">Penguji</span>
                                        @endif
                                        @if (!$dosen->dosenProfile?->is_pembimbing && !$dosen->dosenProfile?->is_penguji)
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    </tr>
                                    <tr>
                                        <th>Nomor HP</th>
                                        <td>{{ $dosen->profile ? $dosen->profile->no_hp : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>{{ $dosen->profile ? $dosen->profile->alamat : 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Kembali -->
            <div class="mt-4 text-center">
                <a href="{{ route('dosen.index') }}" class="btn btn-primary">Kembali ke Daftar Dosen</a>
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
