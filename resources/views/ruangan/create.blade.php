@extends('Template.Index')

@section('title', 'Create Ruangan | SIPASTA')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tambah Ruangan</h5>
        </div>
        <div class="card-body">

            @if ($errors->has('peran'))
            <div class="alert alert-danger">
                {{ $errors->first('peran') }}
            </div>
            @endif

            <form action="{{ route('ruangan.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name">Kode Ruangan</label>
                    <input type="text" name="kode_ruangan" class="form-control" value="{{ old('kode_ruangan') }}" required>
                </div>

                <div class="mb-3">
                    <label for="name">Nama Ruangan</label>
                    <input type="text" name="nama_ruangan" class="form-control" value="{{ old('nama_ruangan') }}" required>
                </div>

                <div class="mb-3">
                    <label>Prodi (Opsional)</label>
                    <select name="prodi_id" class="form-control">
                        <option value="">-- Umum --</option>
                        @foreach($prodis as $prodi)
                            <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('ruangan.index') }}" class="btn btn-secondary"><i
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
