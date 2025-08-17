@extends('Template.Index')

@section('title', 'Jadwal Sidang | SIPASTA')

@section('content')
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid py-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Data Jadwal Sidang</h5>
                </div>
                <div class="card-body">

                    @if(session('success'))
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: "{{ session('success') }}",
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        });
                    </script>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0"></h6>

                        @role('Kaprodi')
                        <a href="{{ route('sidang-schedules.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Jadwal
                        </a>
                        @endrole

                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabel-data" width="100%" cellspacing="0">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Mahasiswa</th>
                                    {{-- <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Ruangan</th> --}}
                                    <th>Pembimbing</th>
                                    <th>Penguji</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jadwals as $index => $jadwal)
                                <tr class="align-middle text-center">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $jadwal->sidangRegistration->user->name }}</td>
                                    {{-- <td>{{ $jadwal->tanggal_sidang }}</td>
                                    <td>{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                                    <td>
                                        {{ $jadwal->ruangan->kode_ruangan ?? '-' }} -
                                        {{ $jadwal->ruangan->nama_ruangan ?? '-' }}
                                    </td> --}}
                                    <td>{{ $jadwal->pembimbing->name }}</td>
                                    <td>
                                        @php
                                        $pengujis = [
                                        $jadwal->penguji1->name ?? null,
                                        $jadwal->penguji2->name ?? null,
                                        $jadwal->penguji3->name ?? null,
                                        ];
                                        $no = 1;
                                        @endphp

                                        @foreach($pengujis as $penguji)
                                        @if($penguji)
                                        {{ $no++ }}. {{ $penguji }}<br>
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>

                                        <a href="{{ route('sidang-schedules.show', $jadwal->id) }}"
                                            class="btn btn-primary btn-sm mb-2">Show</a>

                                        
                                        @role('Kaprodi')
                                        {{-- <form id="delete-form-{{ $jadwal->id }}"
                                        action="{{ route('sidang-schedules.destroy', $jadwal->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus jadwal ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                        </form> --}}

                                        <form id="delete-form-{{ $jadwal->id }}"
                                            action="{{ route('sidang-schedules.destroy', $jadwal->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm mb-2"
                                                onclick="confirmDelete({{ $jadwal->id }})">
                                                Delete
                                            </button>
                                        </form>
                                        @endrole

                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="alert alert-danger mb-0 text-center">
                                            Data Jadwal Belum Tersedia.
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: "Yakin ingin menghapus?",
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection
