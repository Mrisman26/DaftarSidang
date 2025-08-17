@extends('Template.Index')

@section('title', 'Detail Mahasiswa | SIPASTA')

@section('content')
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container">
            <!-- Judul Halaman -->
            {{-- <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center mb-4">Detail Mahasiswa</h2>
                </div>
            </div> --}}

            <!-- Card Detail Mahasiswa -->
            <div class="card mt-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="m-0">{{ $mahasiswa->name }} - Mahasiswa</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Kolom Kiri: Foto Mahasiswa -->
                        <div class="col-md-4 text-center">

                        </div>

                        <!-- Kolom Kanan: Detail Mahasiswa -->
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Nama</th>
                                        <td>{{ $mahasiswa->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $mahasiswa->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>NIM</th>
                                        <td>{{ $mahasiswa->profile ? $mahasiswa->mahasiswaProfile->nim : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Program Studi</th>
                                        <td>{{ $mahasiswa->profile ? $mahasiswa->mahasiswaProfile->prodi->nama_prodi : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor HP</th>
                                        <td>{{ $mahasiswa->profile ? $mahasiswa->profile->no_hp : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>{{ $mahasiswa->profile ? $mahasiswa->profile->alamat : 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Kembali -->
            <div class="mt-4 text-center">
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-primary">Kembali ke Daftar Mahasiswa</a>
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
