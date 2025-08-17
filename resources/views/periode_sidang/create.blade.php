@extends('Template.Index')

@section('title', 'Periode Sidang Akademik | SIPASTA')

@section('content')
<div class="container py-2">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">{{ isset($periode_sidang) ? 'Edit Periode Sidang' : 'Tambah Periode Sidang' }}</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form
                        action="{{ isset($periode_sidang) ? route('periode_sidang.update', $periode_sidang) : route('periode_sidang.store') }}"
                        method="POST">
                        @csrf
                        @if(isset($periode_sidang))
                        @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="nama_periode" class="form-label fw-bold">Nama Periode <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="nama_periode" name="nama_periode"
                                class="form-control @error('nama_periode') is-invalid @enderror"
                                value="{{ old('nama_periode', $periode_sidang->nama_periode ?? '') }}"
                                placeholder="Masukkan nama periode sidang" required>
                            @error('nama_periode')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="prodi_id">Program Studi</label>
                            <select name="prodi_id" id="prodi_id" class="form-control" required>
                                <option value="">-- Pilih Prodi --</option>
                                @foreach($prodis as $prodi)
                                <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal_mulai" class="form-label fw-bold">Tanggal Mulai <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                        <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                                            class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                            value="{{ old('tanggal_mulai', $periode_sidang->tanggal_mulai ?? '') }}"
                                            required>
                                        @error('tanggal_mulai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal_selesai" class="form-label fw-bold">Tanggal Selesai <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                        <input type="date" id="tanggal_selesai" name="tanggal_selesai"
                                            class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                            value="{{ old('tanggal_selesai', $periode_sidang->tanggal_selesai ?? '') }}"
                                            required>
                                        @error('tanggal_selesai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="tanggal_selesai" class="form-label fw-bold">Status
                                        <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select name="is_aktif" class="form-control" required>
                                            <option value="Akan Datang"
                                                {{ old('is_aktif', $periode_sidang->is_aktif ?? '') == 'Akan Datang' ? 'selected' : '' }}>
                                                Akan Datang</option>
                                            <option value="Aktif"
                                                {{ old('is_aktif', $periode_sidang->is_aktif ?? '') == 'Aktif' ? 'selected' : '' }}>
                                                Aktif</option>
                                            <option value="Selesai"
                                                {{ old('is_aktif', $periode_sidang->is_aktif ?? '') == 'Selesai' ? 'selected' : '' }}>
                                                Selesai</option>
                                        </select>
                                        @error('tanggal_selesai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('periode_sidang.index') }}" class="btn btn-secondary"><i
                                    class="fas fa-arrow-left mr-1"></i>Kembali</a>
                            <button type="submit"
                                class="btn btn-primary px-6 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <i class="bi bi-save"></i> {{ isset($periode_sidang) ? 'Perbarui' : 'Simpan' }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
