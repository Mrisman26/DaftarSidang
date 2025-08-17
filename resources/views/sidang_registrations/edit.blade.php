@extends('Template.Index')

@section('title', 'Edit Pendaftaran | SIPASTA')

@section('content')

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">


        <!-- Begin Page Content -->
        <div class="container">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Daftar Edit Pendaftar</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('sidang-registrations.update', $sidangRegistration->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Judul Sidang --}}
                        <div class="form-group">
                            <label for="judul">Judul Sidang</label>
                            <input type="text" name="judul_tugas_akhir" id="judul_tugas_akhir" class="form-control"
                                value="{{ old('judul_tugas_akhir', $sidangRegistration->judul_tugas_akhir) }}" required>
                        </div>

                        <hr>

                        {{-- Pilih Dosen Pembimbing --}}
                        <div class="form-group">
                            <label for="pembimbing_id">Pilih Dosen Pembimbing</label>
                            <select name="pembimbing_id" id="pembimbing_id" class="form-control" required>
                                <option value="">-- Pilih Dosen Pembimbing --</option>
                                @foreach($dosen as $d)
                                <option value="{{ $d->id }}" @if($d->id == $sidangRegistration->pembimbing_id) selected
                                    @endif>
                                    {{ $d->name }}
                                    ({{ $d->sidangRegistration->prodi->nama ?? '-' }})
                                </option>
                                @endforeach
                            </select>
                        </div>


                        {{-- Upload Berkas Syarat --}}
                        <h4>Upload Berkas Syarat</h4>

                        @foreach ($jenisBerkas as $jenis)
                        @php
                        $berkas = $sidangRegistration->berkasSyarat->where('jenis_berkas', $jenis)->first();
                        @endphp

                        <div class="form-group mb-3">
                            <label for="{{ $jenis }}">{{ ucfirst(str_replace('_', ' ', $jenis)) }}</label>

                            {{-- Link lihat file lama jika ada --}}
                            @if($berkas)
                            <p>
                                <a href="{{ asset('storage/' . $berkas->file_path) }}" target="_blank">
                                    Lihat {{ ucfirst(str_replace('_', ' ', $jenis)) }} Lama
                                </a>
                            </p>
                            @endif

                            {{-- Input file --}}
                            <input type="file" name="{{ $jenis }}" id="{{ $jenis }}" class="form-control">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah berkas ini.</small>
                        </div>
                        @endforeach

                        {{-- Tombol --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('sidang-registrations.index') }}" class="btn btn-secondary"><i
                                    class="fas fa-arrow-left mr-1"></i>Kembali</a>
                            <button type="submit"
                                class="btn btn-primary px-6 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

</div>
@endsection
