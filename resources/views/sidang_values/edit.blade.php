@extends('Template.Index')

@section('title', 'Edit Nilai Sidang | SIPASTA')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Nilai</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('sidang_values.update', $sidangValue->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nilai -->
                <div class="mb-3">
                    <label for="nilai" class="form-label">Nilai</label>
                    <input type="number" step="0.01" name="nilai" id="nilai" class="form-control"
                           value="{{ old('nilai', $sidangValue->nilai) }}" required>
                </div>

                <!-- Catatan (Opsional) -->
                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan</label>
                    <textarea name="catatan" id="catatan" class="form-control" rows="3">{{ old('catatan', $sidangValue->komentar) }}</textarea>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('sidang_values.index') }}" class="btn btn-secondary"><i
                            class="fas fa-arrow-left mr-1"></i>Kembali</a>
                    <button type="submit"
                        class="btn btn-primary px-6 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
