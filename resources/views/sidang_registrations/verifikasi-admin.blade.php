<!-- resources/views/sidang_registrations/verifikasi-admin.blade.php -->

@extends('Template.Index')

@section('title', 'Verifikasi Admin | SIPASTA')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">Verifikasi Admin</div>
        <div class="card-body">

            <div class="card mb-3">
                <div class="card-header">
                    Berkas yang Diajukan Mahasiswa
                </div>
                <div class="card-body">
                    @if (!$berkas || $berkas->isEmpty())
                    <p class="text-danger">Belum ada berkas yang diunggah.</p>
                    @else
                    <ul class="list-group">
                        @foreach ($berkas as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ ucfirst(str_replace('_', ' ', $item->jenis_berkas)) }}
                           <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank">Lihat Berkas</a>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>

            <form action="{{ route('sidang.update.admin', $sidangRegistration->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Status Verifikasi</label>
                    <select name="verifikasi_admin" class="form-control" required>
                        <option value="pending"
                            {{ $sidangRegistration->verifikasi_admin === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="diterima"
                            {{ $sidangRegistration->verifikasi_admin === 'diterima' ? 'selected' : '' }}>Diterima
                        </option>
                        <option value="ditolak"
                            {{ $sidangRegistration->verifikasi_admin === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Catatan Admin</label>
                    <textarea name="catatan_admin" class="form-control"
                        >{{ old('catatan_admin', $sidangRegistration->catatan_admin) }}</textarea>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('sidang-registrations.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
