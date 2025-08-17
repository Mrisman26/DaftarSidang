@extends('Template.Index')

@section('title', 'Nilai Sidang | SIPASTA')

@section('content')

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid py-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Data Nilai Sidang</h5>
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

                        <a href="{{ route('sidang_values.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Nilai
                        </a>

                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabel-data" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr class="align-middle text-center"">
                                    <th>No</th>
                                    <th>Mahasiswa</th>
                                    <th>Penguji</th>
                                    <th>Nilai</th>
                                    <th>Komentar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class=" text-center">
                                    @forelse($sidangValues as $index => $sidangValue)
                                <tr class="align-middle text-center">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $sidangValue->sidangSchedule->sidangRegistration->user->name ?? '-' }}</td>
                                    {{-- <td>{{ $sidangValue->penguji->name }}</td> --}}
                                    <td>
                                        @php
                                        $sidangSchedule = $sidangValue->sidangSchedule;

                                        $pengujis = [
                                        $sidangSchedule->penguji1->name ?? null,
                                        $sidangSchedule->penguji2->name ?? null,
                                        $sidangSchedule->penguji3->name ?? null,
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
                                        @php
                                        $nilai = $sidangValue->nilai ?? null;

                                        function getGrade($nilai) {
                                        if (is_null($nilai)) return null;

                                        if ($nilai >= 85) return 'A+';
                                        if ($nilai >= 80) return 'A';
                                        if ($nilai >= 75) return 'B+';
                                        if ($nilai >= 70) return 'B';
                                        if ($nilai >= 65) return 'C+';
                                        if ($nilai >= 60) return 'C';
                                        if ($nilai >= 50) return 'D';
                                        return 'E';
                                        }

                                        $grade = getGrade($nilai);
                                        @endphp

                                        @if($nilai !== null)
                                        {{ $grade }} {{ $nilai }}
                                        @else
                                        <em>Belum dinilai</em>
                                        @endif
                                    </td>
                                    <td>{{ $sidangValue->komentar }}</td>
                                    <td>
                                        <!-- Tombol Show (Dapat diakses oleh semua role) -->
                                        {{-- <a href="{{ route('sidang_values.show', $sidangValue->id) }}"
                                        class="btn btn-primary btn-sm mb-2">Show</a> --}}

                                        <!-- Tombol Edit dan Delete (Hanya untuk Admin) -->
                                        <a href="{{ route('sidang_values.edit', $sidangValue->id) }}"
                                            class="btn btn-warning btn-sm text-dark mb-2">Edit</a>

                                        <form id="delete-form-{{ $sidangValue->id }}"
                                            action="{{ route('sidang_values.destroy', $sidangValue->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm mb-2"
                                                onclick="confirmDelete({{ $sidangValue->id }})">
                                                Delete
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="alert alert-danger mb-0 text-center">
                                            Data Nilai Sidang belum Tersedia.
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
