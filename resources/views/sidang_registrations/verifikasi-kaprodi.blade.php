@extends('Template.Index')

@section('title', 'Verifikasi Kaprodi | SIPASTA')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">Verifikasi Kaprodi</div>
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
                                    <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank">Lihat
                                        Berkas</a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                    </div>

            {{-- Form Verifikasi Kaprodi --}}
            <form action="{{ route('sidang.update.kaprodi', $sidangRegistration->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="verifikasi_kaprodi">Status Verifikasi Kaprodi</label>
                    <select name="verifikasi_kaprodi" id="verifikasi_kaprodi" class="form-control" required>
                        <option value="pending" {{ $sidangRegistration->verifikasi_kaprodi === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="diterima" {{ $sidangRegistration->verifikasi_kaprodi === 'diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="ditolak" {{ $sidangRegistration->verifikasi_kaprodi === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="catatan_kaprodi">Catatan Kaprodi</label>
                    <textarea name="catatan_kaprodi" class="form-control" rows="3">{{ old('catatan_kaprodi', $sidangRegistration->catatan_kaprodi) }}</textarea>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('sidang-registrations.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
