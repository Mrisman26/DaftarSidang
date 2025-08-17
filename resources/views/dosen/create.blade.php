@extends('Template.Index')

@section('title', 'Create Dosen | SIPASTA')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tambah Dosen</h5>
        </div>
        <div class="card-body">

            @if ($errors->has('peran'))
            <div class="alert alert-danger">
                {{ $errors->first('peran') }}
            </div>
            @endif

            <form action="{{ route('dosen.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name">Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="nidn">NIDN</label>
                    <input type="text" name="nidn" class="form-control" value="{{ old('nidn') }}" required>
                </div>

                <div class="mb-3">
                    <label for="prodi_id">Program Studi</label>
                    <select name="prodi_id" class="form-control" required>
                        <option value="">-- Pilih Prodi --</option>
                        @foreach ($prodis as $prodi)
                        <option value="{{ $prodi->id }}" {{ old('prodi_id') == $prodi->id ? 'selected' : '' }}>
                            {{ $prodi->nama_prodi }} ({{ $prodi->jenjang }})
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Peran Dosen</label>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check border rounded">
                                <input class="form-check-input" type="checkbox" name="is_pembimbing" id="is_pembimbing"
                                    value="1" {{ old('is_pembimbing') ? 'checked' : '' }}>
                                <label class="form-check-label ms-2" for="is_pembimbing">
                                    Dosen Pembimbing
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mt-md-0">
                            <div class="form-check border rounded">
                                <input class="form-check-input" type="checkbox" name="is_penguji" id="is_penguji"
                                    value="1" {{ old('is_penguji') ? 'checked' : '' }}>
                                <label class="form-check-label ms-2" for="is_penguji">
                                    Dosen Penguji
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Role</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" id="role_dosen" value="Dosen"
                            {{ old('role', 'Dosen') == 'Dosen' ? 'checked' : '' }}>
                        <label class="form-check-label" for="role_dosen">Dosen</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" id="role_kaprodi" value="Kaprodi"
                            {{ old('role') == 'Kaprodi' ? 'checked' : '' }}>
                        <label class="form-check-label" for="role_kaprodi">Kaprodi</label>
                    </div>
                </div>


                <div class="mb-3">
                    <label for="no_hp">No HP</label>
                    <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}">
                </div>

                <div class="mb-3">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" class="form-control">{{ old('alamat') }}</textarea>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('dosen.index') }}" class="btn btn-secondary"><i
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
