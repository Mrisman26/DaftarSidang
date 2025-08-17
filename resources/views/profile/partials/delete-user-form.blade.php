@extends('Template.Index')

@section('content')
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Profil Mahasiswa</h1>

            <!-- Notifikasi -->
            @if (session('success'))
            <div id="alert-success" class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if (session('error'))
            <div id="alert-error" class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm border-left-primary">
                        <div class="card-header bg-primary text-white py-2">
                            <h6 class="m-0 font-weight-bold">Informasi Profil</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('profile.update') }}">
                                @csrf
                                @method('patch')

                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        value="{{ old('name', $user->name) }}" required autofocus>
                                    @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email Aktif</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        value="{{ old('email', $user->email) }}" required>
                                    @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>

                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !
                                $user->hasVerifiedEmail())
                                <div class="alert alert-warning small mt-2">
                                    <p class="mb-1">Alamat email Anda belum terverifikasi.</p>
                                    <button form="send-verification" class="btn btn-link p-0 small">Kirim ulang email
                                        verifikasi</button>
                                    @if (session('status') === 'verification-link-sent')
                                    <p class="text-success small mt-1">Link verifikasi baru telah dikirim ke email Anda.
                                    </p>
                                    @endif
                                </div>
                                @endif

                                @php
                                $isMahasiswa = $user->hasRole('Mahasiswa');
                                $isDosen = $user->hasRole('Dosen');

                                $label = $isMahasiswa ? 'NIM' : ($isDosen ? 'NIDN' : '');
                                $nameInput = $isMahasiswa ? 'nim' : ($isDosen ? 'nidn' : '');
                                $valueInput = '';

                                if ($isMahasiswa) {
                                $valueInput = $mahasiswaProfile->nim ?? '';

                                } elseif ($isDosen) {
                                $valueInput = $dosenProfile->nidn ?? '';
                                }
                                @endphp


                                @if($isMahasiswa || $isDosen)
                                <div class="form-group">
                                    <label for="{{ $nameInput }}">{{ $label }}</label>
                                    <input type="text" id="{{ $nameInput }}" name="{{ $nameInput }}"
                                        class="form-control" value="{{ old($nameInput, $valueInput) }}" required>
                                    @error($nameInput) <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>
                                @endif


                                @php
                                $selectedProdiId = null;

                                if ($isMahasiswa) {
                                $selectedProdiId = $mahasiswaProfile->prodi_id ?? null;
                                } elseif ($isDosen) {
                                $selectedProdiId = $dosenProfile->prodi_id ?? null;
                                }
                                @endphp

                                @if ($isMahasiswa || $isDosen)
                                <div class="form-group">
                                    <label for="prodi_id">Program Studi</label>
                                    <select id="prodi_id" name="prodi_id" class="form-control">
                                        <option value="" disabled
                                            {{ is_null(old('prodi_id', $selectedProdiId)) ? 'selected' : '' }}>
                                            Pilih Program Studi
                                        </option>
                                        @foreach ($prodis as $prodi)
                                        <option value="{{ $prodi->id }}"
                                            {{ $prodi->id == old('prodi_id', $selectedProdiId) ? 'selected' : '' }}>
                                            {{ $prodi->nama_prodi }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('prodi_id')
                                    <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                @endif

                                <div class="form-group">
                                    <label for="no_hp">Nomor HP</label>
                                    <input type="text" id="no_hp" name="no_hp" class="form-control"
                                        value="{{ old('no_hp', $user->profile->no_hp ?? '') }}">
                                    @error('no_hp') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat Lengkap</label>
                                    <textarea id="alamat" name="alamat" class="form-control"
                                        rows="2">{{ old('alamat', $user->profile->alamat ?? '') }}</textarea>
                                    @error('alamat') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Update Profil</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm border-left-warning mb-4">
                        <div class="card-header bg-warning text-white py-2">
                            <h6 class="m-0 font-weight-bold">Ubah Password</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('password.update') }}">
                                @csrf
                                @method('put')

                                <div class="form-group">
                                    <label for="current_password">Password Saat Ini</label>
                                    <input type="password" id="current_password" name="current_password"
                                        class="form-control" required>
                                    @error('current_password') <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">Password Baru</label>
                                    <input type="password" id="password" name="password" class="form-control" required>
                                    @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control" required>
                                    @error('password_confirmation') <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-warning btn-block text-white">Update
                                    Password</button>
                            </form>
                        </div>
                    </div>

                    <div class="card shadow-sm border-left-info mb-4">
                        <div class="card-header bg-info text-white py-2">
                            <h6 class="m-0 font-weight-bold">Informasi Akun</h6>
                        </div>
                        <div class="card-body">
                            <p><i class="fas fa-user mr-2"></i> <strong>Nama:</strong> {{ Auth::user()->name }}</p>
                            <p><i class="fas fa-envelope mr-2"></i> <strong>Email:</strong> {{ Auth::user()->email }}
                            </p>
                            <p><i class="fas fa-calendar-alt mr-2"></i> <strong>Bergabung Sejak:</strong>
                                {{ Auth::user()->created_at->format('d M Y') }}</p>
                        </div>
                    </div>

                    {{-- @role('Admin')
                    <div class="card shadow-sm border-left-danger">
                        <div class="card-header bg-danger text-white py-2">
                            <h6 class="m-0 font-weight-bold">Hapus Akun</h6>
                        </div>
                        <div class="card-body">
                            <p class="mb-3">Setelah akun dihapus, semua data akan dihapus secara permanen. Pastikan Anda
                                sudah mengunduh data penting.</p>
                            <button class="btn btn-danger btn-block" data-toggle="modal"
                                data-target="#deleteAccountModal">Hapus Akun</button>
                        </div>
                    </div>
                    @endrole --}}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus Akun -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" role="dialog" aria-labelledby="deleteAccountModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAccountModalLabel">Hapus Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-danger">Apakah Anda yakin ingin menghapus akun ini? Tindakan ini tidak dapat
                    dibatalkan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <form action="{{ route('profile.destroy') }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Hapus Akun</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
