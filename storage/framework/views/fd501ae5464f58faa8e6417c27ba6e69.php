<?php $__env->startSection('title', 'Detail Jadwal Sidang | SIPASTA'); ?>

<?php $__env->startSection('content'); ?>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-2 mb-sm-0 text-gray-800">Detail Jadwal Sidang</h1>
                <div class="d-flex flex-column flex-sm-row gap-2">
                    <a href="<?php echo e(route('sidang_schedules.daftar_hadir', $jadwalSidang->id)); ?>" target="_blank"
                        class="btn btn-sm btn-primary shadow-sm mb-2 mb-sm-0">
                        <i class="fas fa-print fa-sm text-white-50"></i>
                        <span class="d-none d-md-inline">Cetak</span> Daftar Hadir
                    </a>
                    <a href="<?php echo e(route('sidang_schedules.berita_acara', $jadwalSidang->id)); ?>" target="_blank"
                        class="btn btn-sm btn-danger shadow-sm ml-0 ml-sm-2">
                        <i class="fas fa-file-alt fa-sm text-white-50"></i>
                        <span class="d-none d-md-inline">Lihat</span> Berita Acara
                    </a>
                </div>
            </div>

            <!-- Content Row -->
            <div class="row">
                <div class="col-12">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fas fa-calendar-alt mr-2"></i>Informasi Jadwal Sidang
                            </h6>
                        </div>
                        <div class="card-body">

                            <!-- Informasi Mahasiswa -->
                            <div class="row mb-4">
                                <div class="col-12 col-lg-6 mb-3 mb-lg-0">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        Mahasiswa
                                                    </div>
                                                    <div class="h6 h5-sm mb-0 font-weight-bold text-gray-800">
                                                        <?php if($jadwalSidang->sidangRegistration): ?>
                                                            <?php echo e($jadwalSidang->sidangRegistration->user->name); ?>

                                                        <?php else: ?>
                                                            <span class="text-muted font-italic">Belum ditentukan</span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-user fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        Pembimbing
                                                    </div>
                                                    <div class="h6 h5-sm mb-0 font-weight-bold text-gray-800">
                                                        <?php if($jadwalSidang->pembimbing): ?>
                                                            <?php echo e($jadwalSidang->pembimbing->name ?? '-'); ?>

                                                        <?php else: ?>
                                                            <span class="text-muted font-italic">Belum ditentukan</span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Detail Informasi -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <th width="30%" class="bg-light d-none d-md-table-cell">
                                                        <i class="fas fa-users text-primary mr-2"></i>Penguji
                                                    </th>
                                                    <th class="bg-light d-md-none">
                                                        <i class="fas fa-users text-primary mr-1"></i>Penguji
                                                    </th>
                                                    <td>
                                                        <?php
                                                        $pengujis = [
                                                            $jadwalSidang->penguji1->name ?? null,
                                                            $jadwalSidang->penguji2->name ?? null,
                                                            $jadwalSidang->penguji3->name ?? null,
                                                        ];
                                                        $no = 1;
                                                        ?>

                                                        <div class="d-flex flex-column">
                                                            <?php $__currentLoopData = $pengujis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $penguji): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($penguji): ?>
                                                                    <span class="badge badge-outline-primary mr-2 mb-1 text-left">
                                                                        <?php echo e($no++); ?>. <?php echo e($penguji); ?>

                                                                    </span>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                            <?php if(empty(array_filter($pengujis))): ?>
                                                                <span class="text-muted font-italic">Belum ditentukan</span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th class="bg-light d-none d-md-table-cell">
                                                        <i class="fas fa-door-open text-primary mr-2"></i>Ruangan
                                                    </th>
                                                    <th class="bg-light d-md-none">
                                                        <i class="fas fa-door-open text-primary mr-1"></i>Ruangan
                                                    </th>
                                                    <td>
                                                        <?php if($jadwalSidang->ruangan->nama_ruangan): ?>
                                                            <span class="badge badge-info">
                                                                <?php echo e(($jadwalSidang->ruangan->nama_ruangan)); ?>

                                                            </span>
                                                        <?php else: ?>
                                                            <span class="text-muted font-italic">Belum ditentukan</span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th class="bg-light d-none d-md-table-cell">
                                                        <i class="fas fa-calendar text-primary mr-2"></i>Tanggal Sidang
                                                    </th>
                                                    <th class="bg-light d-md-none">
                                                        <i class="fas fa-calendar text-primary mr-1"></i>Tanggal
                                                    </th>
                                                    <td>
                                                        <?php if($jadwalSidang->tanggal_sidang): ?>
                                                            <span class="font-weight-bold text-dark">
                                                                <span class="d-none d-sm-inline"><?php echo e(\Carbon\Carbon::parse($jadwalSidang->tanggal_sidang)->translatedFormat('d F Y')); ?></span>
                                                                <span class="d-sm-none"><?php echo e(\Carbon\Carbon::parse($jadwalSidang->tanggal_sidang)->translatedFormat('d/m/Y')); ?></span>
                                                            </span>
                                                        <?php else: ?>
                                                            <span class="text-muted font-italic">Belum ditentukan</span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th class="bg-light d-none d-md-table-cell">
                                                        <i class="fas fa-clock text-primary mr-2"></i>Waktu Mulai
                                                    </th>
                                                    <th class="bg-light d-md-none">
                                                        <i class="fas fa-clock text-primary mr-1"></i>Mulai
                                                    </th>
                                                    <td>
                                                        <?php if($jadwalSidang->jam_mulai): ?>
                                                            <span class="badge badge-success">
                                                                <?php echo e(\Carbon\Carbon::parse($jadwalSidang->jam_mulai)->format('H:i')); ?> WIB
                                                            </span>
                                                        <?php else: ?>
                                                            <span class="text-muted font-italic">Belum ditentukan</span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th class="bg-light d-none d-md-table-cell">
                                                        <i class="fas fa-clock text-primary mr-2"></i>Waktu Selesai
                                                    </th>
                                                    <th class="bg-light d-md-none">
                                                        <i class="fas fa-clock text-primary mr-1"></i>Selesai
                                                    </th>
                                                    <td>
                                                        <?php if($jadwalSidang->jam_selesai): ?>
                                                            <span class="badge badge-warning">
                                                                <?php echo e(\Carbon\Carbon::parse($jadwalSidang->jam_selesai)->format('H:i')); ?> WIB
                                                            </span>
                                                        <?php else: ?>
                                                            <span class="text-muted font-italic">Belum ditentukan</span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            
                            

                            <!-- Action Buttons -->
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-stretch align-items-sm-center mt-4 gap-2">
                                <a href="<?php echo e(route('sidang-schedules.index')); ?>" class="btn btn-secondary mb-2 mb-sm-0">
                                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Template.Index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views/sidang_schedules/show.blade.php ENDPATH**/ ?>