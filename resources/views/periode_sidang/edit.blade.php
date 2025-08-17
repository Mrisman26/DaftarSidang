@extends('Template.Index')

@section('title', 'Periode Sidang Akademik | SIPASTA')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ isset($periode_sidang) ? 'Edit Periode Sidang' : 'Tambah Periode Sidang' }}</h4>
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form
                        action="{{ isset($periode_sidang) ? route('periode_sidang.update', $periode_sidang) : route('periode_sidang.store') }}"
                        method="POST" class="needs-validation" novalidate>
                        @csrf
                        @if(isset($periode_sidang))
                        @method('PUT')
                        @endif

                        <div class="mb-4">
                            <label for="nama_periode" class="form-label fw-semibold">
                                <i class="bi bi-tag-fill text-primary me-1"></i> Nama Periode
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="nama_periode" name="nama_periode"
                                class="form-control @error('nama_periode') is-invalid @enderror"
                                value="{{ old('nama_periode', $periode_sidang->nama_periode ?? '') }}"
                                placeholder="Contoh: Sidang Skripsi Periode Semester Ganjil 2024/2025" required>
                            <div class="form-text">Masukkan nama periode yang deskriptif dan mudah dikenali</div>
                            @error('nama_periode')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3 mb-md-0">
                                    <label for="tanggal_mulai" class="form-label fw-semibold">
                                        <i class="bi bi-calendar-event text-primary me-1"></i> Tanggal Mulai
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-calendar3"></i></span>
                                        <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                                            class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                            value="{{ old('tanggal_mulai', $periode_sidang->tanggal_mulai ?? '') }}"
                                            required>
                                        @error('tanggal_mulai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-text">Tanggal pembukaan pendaftaran</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label for="tanggal_selesai" class="form-label fw-semibold">
                                        <i class="bi bi-calendar-check text-primary me-1"></i> Tanggal Selesai
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-calendar3"></i></span>
                                        <input type="date" id="tanggal_selesai" name="tanggal_selesai"
                                            class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                            value="{{ old('tanggal_selesai', $periode_sidang->tanggal_selesai ?? '') }}"
                                            required>
                                        @error('tanggal_selesai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-text">Tanggal penutupan pendaftaran</div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="prodi_id">Program Studi</label>
                            <select name="prodi_id" class="form-control" required>
                                <option value="">-- Pilih Prodi --</option>
                                @foreach($prodis as $prodi)
                                <option value="{{ $prodi->id }}"
                                    {{ old('prodi_id', $periode_sidang->prodi_id) == $prodi->id ? 'selected' : '' }}>
                                    {{ $prodi->nama_prodi }}
                                </option>
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="is_aktif" class="form-label fw-semibold">
                                <i class="bi bi-toggle-on text-primary me-1"></i> Status Periode
                                <span class="text-danger">*</span>
                            </label>
                            <select name="is_aktif" id="is_aktif"
                                class="form-control @error('is_aktif') is-invalid @enderror" required>
                                <option value="" selected disabled>-- Pilih Status --</option>
                                <option value="Akan Datang"
                                    {{ (old('is_aktif', $periode_sidang->is_aktif ?? '') == 'Akan Datang') ? 'selected' : '' }}>
                                    Akan Datang
                                </option>
                                <option value="Aktif"
                                    {{ (old('is_aktif', $periode_sidang->is_aktif ?? '') == 'Aktif') ? 'selected' : '' }}>
                                    Aktif
                                </option>
                                <option value="Selesai"
                                    {{ (old('is_aktif', $periode_sidang->is_aktif ?? '') == 'Selesai') ? 'selected' : '' }}>
                                    Selesai
                                </option>
                            </select>
                            <div class="form-text">Status ini akan menentukan apakah periode dapat diakses oleh
                                mahasiswa</div>
                            @error('is_aktif')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                            <div>
                                <a href="{{ route('periode_sidang.index') }}" class="btn btn-secondary"><i
                                        class="fas fa-arrow-left mr-1"></i>Kembali</a>
                            </div>
                            <div>
                                @if(isset($periode_sidang))
                                <button type="reset" class="btn btn-success me-2">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                                </button>
                                @endif
                                <button type="submit"
                                    class="btn btn-primary px-6 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <i class="bi bi-save"></i> {{ isset($periode_sidang) ? 'Perbarui' : 'Simpan' }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('.needs-validation');
        const tanggalMulai = document.getElementById('tanggal_mulai');
        const tanggalSelesai = document.getElementById('tanggal_selesai');

        // Date range validation
        tanggalMulai.addEventListener('change', function () {
            tanggalSelesai.min = this.value;
            if (tanggalSelesai.value && new Date(tanggalSelesai.value) < new Date(this.value)) {
                tanggalSelesai.value = this.value;
            }
        });

        // Form validation
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            // Additional validation for date range
            if (new Date(tanggalSelesai.value) < new Date(tanggalMulai.value)) {
                event.preventDefault();
                alert('Tanggal selesai tidak boleh sebelum tanggal mulai');
            }

            form.classList.add('was-validated');
        }, false);
    });
</script>
@endsection
