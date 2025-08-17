@extends('Template.Index')

@section('title', 'Verifikasi | SIPASTA')

@section('content')

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">Verifikasi Pendaftaran</div>
                <div class="card-body ">

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


                    <form action="{{ route('sidang.update', $sidangRegistration->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Pilih Status Verifikasi -->
                        <div class="form-group">
                            <label for="status_verifikasi">Status Verifikasi</label>
                            <select name="status_verifikasi" class="form-control" id="status_verifikasi" required>
                                <option value="pending"
                                    {{ $sidangRegistration->status_verifikasi == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="diterima"
                                    {{ $sidangRegistration->status_verifikasi == 'diterima' ? 'selected' : '' }}>
                                    Diterima
                                </option>
                                <option value="ditolak"
                                    {{ $sidangRegistration->status_verifikasi == 'ditolak' ? 'selected' : '' }}>Ditolak
                                </option>
                            </select>
                        </div>

                        <!-- Form Tambahan untuk Diterima -->
                        <div id="sidang-details" style="display: none;">
                            <div class="form-group">
                                <label for="pembimbing_id">Dosen Pembimbing</label>
                                <input type="text" class="form-control" readonly
                                    value="{{ $sidangRegistration->pembimbing->name ?? '-' }}">
                                <input type="hidden" name="pembimbing_id"
                                    value="{{ $sidangRegistration->pembimbing_id }}">
                            </div>
                            <div class="form-group">
                                <label for="penguji_id">Dosen Penguji</label>
                                <select name="penguji_id" class="form-control">
                                    @foreach ($dosen as $dosenItem)
                                    <option value="{{ $dosenItem->id }}"
                                        {{ $sidangSchedule && $sidangSchedule->penguji_id == $dosenItem->id ? 'selected' : '' }}>
                                        {{ $dosenItem->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_sidang">Tanggal Sidang</label>
                                <input type="date" name="tanggal_sidang" id="tanggal_sidang" class="form-control"
                                    @if(request()->old('status_verifikasi') === 'diterima') required @endif
                                min="{{ $startDate }}"
                                max="{{ $endDate }}"
                                value="{{ old('tanggal_sidang', optional($sidangSchedule)->tanggal_sidang) }}">
                            </div>

                            <div class="form-group">
                                <label for="ruangan">Ruangan</label>
                                <input type="text" name="ruangan" class="form-control"
                                    value="{{ $sidangSchedule ? $sidangSchedule->ruangan : '' }}">
                            </div>

                            <div class="form-group">
                                <label for="jam_mulai">Jam Mulai</label>
                                <input type="time" name="jam_mulai" id="jam_mulai" class="form-control"
                                    value="{{ old('jam_mulai', optional($sidangSchedule)->jam_mulai) }}">
                            </div>

                            <div class="form-group">
                                <label for="jam_selesai">Jam Selesai</label>
                                <input type="time" name="jam_selesai" id="jam_selesai" class="form-control"
                                    value="{{ old('jam_selesai', optional($sidangSchedule)->jam_selesai) }}">
                            </div>


                        </div>

                        <div class="form-group">
                            <label for="catatan_admin">Catatan Admin</label>
                            <textarea name="catatan_admin" class="form-control" rows="3"
                                required>{{ old('catatan_admin', $sidangRegistration->catatan_admin) }}</textarea>
                        </div>

                        <!-- Tombol Kembali & Update -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('sidang-registrations.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i>Kembali</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

</div>

<!-- Script untuk Menampilkan Form Tambahan ketika Status Diterima -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var statusSelect = document.getElementById('status_verifikasi');
        var sidangDetails = document.getElementById('sidang-details');
        // var pembimbingSelect = document.querySelector('select[name="pembimbing_id"]');
        var pengujiSelect = document.querySelector('select[name="penguji_id"]');

        // Cek status yang dipilih pada halaman load
        if (statusSelect.value === 'diterima') {
            sidangDetails.style.display = 'block';
            pengujiSelect.disabled = false;
        } else {
            sidangDetails.style.display = 'none';
            pengujiSelect.disabled = true;
        }

        // Event listener ketika status verifikasi berubah
        statusSelect.addEventListener('change', function () {
            if (statusSelect.value === 'diterima') {
                sidangDetails.style.display = 'block';
                pengujiSelect.disabled = false;
            } else {
                sidangDetails.style.display = 'none';
                pengujiSelect.disabled = true;
            }
        });
    });
</script>

@endsection
