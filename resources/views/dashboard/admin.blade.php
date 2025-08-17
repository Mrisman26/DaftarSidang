@extends('Template.Index')

@section('title', 'Dashboard | SIPASTA')

@section('content')

<div id="wrapper">
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">

            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Dashboard {{ Auth::user()->getRoleNames()->first() }} - SIPASTA</h1>

                <div class="row">
                    <!-- Total Mahasiswa -->
                    <div class="col-lg-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Mahasiswa
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalMahasiswa">
                                    {{ $totalMahasiswa }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Pendaftar -->
                    <div class="col-lg-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pendaftar
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalPendaftar">
                                    {{ $totalMendaftar }}</div>
                            </div>
                        </div>
                    </div>
                    
                    @role('Admin||Kaprodi')
                    <!-- Sidang Pending -->
                    <div class="col-lg-4 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Sidang Pending
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="sidangDitolak">
                                    {{ $sidangPending  }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidang Disetujui -->
                    <div class="col-lg-4 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Sidang Diterima
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="sidangDisetujui">
                                    {{ $sidangDiterima }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidang Ditolak -->
                    <div class="col-lg-4 mb-4">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Sidang Ditolak
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="sidangDitolak">
                                    {{ $sidangDitolak }}</div>
                            </div>
                        </div>
                    </div>
                    @endrole
                </div>
                <!-- /.container-fluid -->

            </div><!-- End of Main Content -->
        </div><!-- End of Content Wrapper -->
    </div><!-- End of Page Wrapper -->

    @endsection
