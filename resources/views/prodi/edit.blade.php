@extends('Template.Index')

@section('title', 'Edit Prodi | SIPASTA')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Prodi</h5>
        </div>
        <div class="card-body">

            @if ($errors->has('peran'))
            <div class="alert alert-danger">
                {{ $errors->first('peran') }}
            </div>
            @endif

            <form action="{{ route('prodi.update', $prodi) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name">Nama Prodi</label>
                    <input type="text" name="nama_prodi" value="{{ $prodi->nama_prodi }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Jenjang</label>
                    <select name="jenjang" class="form-control" required>
                        <option value="D3" {{ $prodi->jenjang == 'D3' ? 'selected' : '' }}>D3</option>
                        <option value="D4" {{ $prodi->jenjang == 'D4' ? 'selected' : '' }}>D4</option>
                    </select>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('prodi.index') }}" class="btn btn-secondary"><i
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
@endsection
