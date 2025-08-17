@extends('Template.Index')

@section('title', 'Edit Mahasiswa | SIPASTA')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Dosen</h5>
        </div>
        <div class="card-body">

            @if ($errors->has('peran'))
            <div class="alert alert-danger">
                {{ $errors->first('peran') }}
            </div>
            @endif

            <form action="{{ route('dosen.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label for="password">Password (Biarkan kosong jika tidak diganti)</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="nidn">NIDN</label>
                    <input type="text" name="nidn" value="{{ old('nidn', $user->dosenProfile->nidn) }}"
                        class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="prodi_id">Program Studi</label>
                    <select name="prodi_id" class="form-control" required>
                        <option value="">-- Pilih Prodi --</option>
                        @foreach ($prodis as $prodi)
                        <option value="{{ $prodi->id }}"
                            {{ old('prodi_id', $user->dosenProfile->prodi_id) == $prodi->id ? 'selected' : '' }}>
                            {{ $prodi->nama_prodi }} ({{ $prodi->jenjang }})
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Role --}}
                <div class="mb-3">
                    <label class="form-label d-block">Role</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" value="Dosen"
                            {{ $user->hasRole('Dosen') ? 'checked' : '' }}>
                        <label class="form-check-label">Dosen</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" value="Kaprodi"
                            {{ $user->hasRole('Kaprodi') ? 'checked' : '' }}>
                        <label class="form-check-label">Kaprodi</label>
                    </div>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="is_pembimbing" id="is_pembimbing"
                        {{ old('is_pembimbing', $user->dosenProfile->is_pembimbing) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_pembimbing">
                        Sebagai Dosen Pembimbing
                    </label>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="is_penguji" id="is_penguji"
                        {{ old('is_penguji', $user->dosenProfile->is_penguji) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_penguji">
                        Sebagai Dosen Penguji
                    </label>
                </div>

                <div class="mb-3">
                    <label for="no_hp">No HP</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $user->profile->no_hp ?? '') }}"
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat"
                        class="form-control">{{ old('alamat', $user->profile->alamat ?? '') }}</textarea>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('dosen.index') }}" class="btn btn-secondary"><i
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
