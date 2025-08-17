<?php $__env->startSection('title', 'Detail Pendaftar Sidang | SIPASTA'); ?>

<?php $__env->startSection('content'); ?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-2 mb-sm-0 text-gray-800">Detail Pendaftar Sidang</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 d-none d-sm-flex">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('sidang-registrations.index')); ?>">Pendaftar Sidang</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>

            <!-- Content Row -->
            <div class="row">
                <div class="col-12">
                    <!-- Main Card -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fas fa-user-graduate mr-2"></i>Informasi Pendaftar Sidang
                            </h6>
                        </div>
                        <div class="card-body">

                            <!-- Status Verifikasi Cards -->
                            <div class="row mb-4">
                                <div class="col-12 col-lg-6 mb-3 mb-lg-0">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                        Status Verifikasi Admin
                                                    </div>
                                                    <div class="h6 mb-0 font-weight-bold">
                                                        <?php $admin = $sidangRegistration->verifikasi_admin; ?>
                                                        <?php if($admin === 'pending'): ?>
                                                            <span class="badge badge-warning px-3 py-2">
                                                                <i class="fas fa-clock mr-1"></i>Pending
                                                            </span>
                                                        <?php elseif($admin === 'diterima'): ?>
                                                            <span class="badge badge-success px-3 py-2">
                                                                <i class="fas fa-check mr-1"></i>Diterima
                                                            </span>
                                                        <?php elseif($admin === 'ditolak'): ?>
                                                            <span class="badge badge-danger px-3 py-2">
                                                                <i class="fas fa-times mr-1"></i>Ditolak
                                                            </span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-user-shield fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        Status Verifikasi Kaprodi
                                                    </div>
                                                    <div class="h6 mb-0 font-weight-bold">
                                                        <?php $kaprodi = $sidangRegistration->verifikasi_kaprodi; ?>
                                                        <?php if($kaprodi === 'pending'): ?>
                                                            <span class="badge badge-warning px-3 py-2">
                                                                <i class="fas fa-clock mr-1"></i>Pending
                                                            </span>
                                                        <?php elseif($kaprodi === 'diterima'): ?>
                                                            <span class="badge badge-success px-3 py-2">
                                                                <i class="fas fa-check mr-1"></i>Diterima
                                                            </span>
                                                        <?php elseif($kaprodi === 'ditolak'): ?>
                                                            <span class="badge badge-danger px-3 py-2">
                                                                <i class="fas fa-times mr-1"></i>Ditolak
                                                            </span>
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
                                                        <i class="fas fa-calendar-plus text-primary mr-2"></i>Tanggal Daftar
                                                    </th>
                                                    <th class="bg-light d-md-none">
                                                        <i class="fas fa-calendar-plus text-primary mr-1"></i>Tgl Daftar
                                                    </th>
                                                    <td>
                                                        <span class="font-weight-bold text-dark">
                                                            <span class="d-none d-sm-inline">
                                                                <?php echo e(optional($sidangRegistration->created_at)->translatedFormat('d F Y') ?? '-'); ?>

                                                            </span>
                                                            <span class="d-sm-none">
                                                                <?php echo e(optional($sidangRegistration->created_at)->format('d/m/Y') ?? '-'); ?>

                                                            </span>
                                                        </span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th class="bg-light d-none d-md-table-cell">
                                                        <i class="fas fa-book text-primary mr-2"></i>Judul Tugas Akhir
                                                    </th>
                                                    <th class="bg-light d-md-none">
                                                        <i class="fas fa-book text-primary mr-1"></i>Judul TA
                                                    </th>
                                                    <td>
                                                        <div class="text-justify">
                                                            <?php echo e($sidangRegistration->judul_tugas_akhir); ?>

                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th class="bg-light d-none d-md-table-cell">
                                                        <i class="fas fa-chalkboard-teacher text-primary mr-2"></i>Dosen Pembimbing
                                                    </th>
                                                    <th class="bg-light d-md-none">
                                                        <i class="fas fa-chalkboard-teacher text-primary mr-1"></i>Pembimbing
                                                    </th>
                                                    <td>
                                                        <div class="d-flex flex-column flex-sm-row align-items-start">
                                                            
                                                            <span class="font-weight-bold">
                                                                <?php echo e($sidangRegistration->pembimbing->name ?? '-'); ?>

                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th class="bg-light d-none d-md-table-cell">
                                                        <h class="fas fa-users text-primary mr-2"></h>Dosen Penguji
                                                    </th>
                                                    <th class="bg-light d-md-none">
                                                        <i class="fas fa-users text-primary mr-1"></i>Penguji
                                                    </th>
                                                    <td>
                                                        <?php if($sidangRegistration->sidangSchedule): ?>
                                                            <div class="row">
                                                                <div class="col-12 col-sm-4 mb-2">
                                                                    <span class="badge badge-outline-primary w-100 text-left py-2">
                                                                        <strong>1:</strong> <?php echo e($sidangRegistration->sidangSchedule->penguji1->name ?? '-'); ?>

                                                                    </span>
                                                                </div>
                                                                <div class="col-12 col-sm-4 mb-2">
                                                                    <span class="badge badge-outline-primary w-100 text-left py-2">
                                                                        <strong>2:</strong> <?php echo e($sidangRegistration->sidangSchedule->penguji2->name ?? '-'); ?>

                                                                    </span>
                                                                </div>
                                                                <div class="col-12 col-sm-4 mb-2">
                                                                    <span class="badge badge-outline-primary w-100 text-left py-2">
                                                                        <strong>3:</strong> <?php echo e($sidangRegistration->sidangSchedule->penguji3->name ?? '-'); ?>

                                                                    </span>
                                                                </div>
                                                            </div>
                                                        <?php else: ?>
                                                            <span class="text-muted font-italic">Belum ditentukan</span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th class="bg-light d-none d-md-table-cell">
                                                        <i class="fas fa-star text-primary mr-2"></i>Nilai
                                                    </th>
                                                    <th class="bg-light d-md-none">
                                                        <i class="fas fa-star text-primary mr-1"></i>Nilai
                                                    </th>
                                                    <td>
                                                        <?php
                                                        $schedule = $sidangRegistration->sidangSchedule;
                                                        $values = $schedule?->values ?? collect();

                                                        $nilai1 = $values->where('penguji_id', $schedule?->penguji_id_1)->first()?->nilai;
                                                        $nilai2 = $values->where('penguji_id', $schedule?->penguji_id_2)->first()?->nilai;
                                                        $nilai3 = $values->where('penguji_id', $schedule?->penguji_id_3)->first()?->nilai;

                                                        $allNilai = collect([$nilai1, $nilai2, $nilai3])->filter();
                                                        $rataRata = $allNilai->count() > 0 ? round($allNilai->avg()) : null;

                                                        function getGrade($nilai) {
                                                            return match (true) {
                                                                $nilai === null => null,
                                                                $nilai >= 85 => 'A+',
                                                                $nilai >= 80 => 'A',
                                                                $nilai >= 75 => 'B+',
                                                                $nilai >= 70 => 'B',
                                                                $nilai >= 65 => 'C+',
                                                                $nilai >= 60 => 'C',
                                                                $nilai >= 50 => 'D',
                                                                default => 'E',
                                                            };
                                                        }

                                                        function getGradeBadgeClass($grade) {
                                                            return match ($grade) {
                                                                'A+', 'A' => 'badge-success',
                                                                'B+', 'B' => 'badge-primary',
                                                                'C+', 'C' => 'badge-warning',
                                                                'D' => 'badge-danger',
                                                                'E' => 'badge-dark',
                                                                default => 'badge-secondary',
                                                            };
                                                        }
                                                        ?>

                                                        <div class="row mb-3">
                                                            <div class="col-12 col-md-4 mb-2">
                                                                <div class="card border-0 bg-light">
                                                                    <div class="card-body py-2 px-3">
                                                                        <small class="text-muted d-block">Penguji 1</small>
                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                            <span class="font-weight-bold"><?php echo e($nilai1 ?? '-'); ?></span>
                                                                            <?php if($nilai1 !== null): ?>
                                                                                <span class="badge <?php echo e(getGradeBadgeClass(getGrade($nilai1))); ?>">
                                                                                    <?php echo e(getGrade($nilai1)); ?>

                                                                                </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-4 mb-2">
                                                                <div class="card border-0 bg-light">
                                                                    <div class="card-body py-2 px-3">
                                                                        <small class="text-muted d-block">Penguji 2</small>
                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                            <span class="font-weight-bold"><?php echo e($nilai2 ?? '-'); ?></span>
                                                                            <?php if($nilai2 !== null): ?>
                                                                                <span class="badge <?php echo e(getGradeBadgeClass(getGrade($nilai2))); ?>">
                                                                                    <?php echo e(getGrade($nilai2)); ?>

                                                                                </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-4 mb-2">
                                                                <div class="card border-0 bg-light">
                                                                    <div class="card-body py-2 px-3">
                                                                        <small class="text-muted d-block">Penguji 3</small>
                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                            <span class="font-weight-bold"><?php echo e($nilai3 ?? '-'); ?></span>
                                                                            <?php if($nilai3 !== null): ?>
                                                                                <span class="badge <?php echo e(getGradeBadgeClass(getGrade($nilai3))); ?>">
                                                                                    <?php echo e(getGrade($nilai3)); ?>

                                                                                </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="card border-primary">
                                                            <div class="card-body py-2 px-3">
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <span class="font-weight-bold text-primary">Rata-rata:</span>
                                                                    <div>
                                                                        <?php if($rataRata !== null): ?>
                                                                            <span class="font-weight-bold text-primary mr-2"><?php echo e($rataRata); ?></span>
                                                                            <span class="badge badge-lg <?php echo e(getGradeBadgeClass(getGrade($rataRata))); ?>">
                                                                                <?php echo e(getGrade($rataRata)); ?>

                                                                            </span>
                                                                        <?php else: ?>
                                                                            <span class="text-muted font-italic">Belum lengkap</span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Catatan Section -->
                            <div class="row mt-4">
                                <div class="col-12 col-lg-6 mb-3 mb-lg-0">
                                    <div class="card border-left-warning shadow h-100">
                                        <div class="card-header py-2 bg-transparent">
                                            <h6 class="m-0 font-weight-bold text-warning">
                                                <i class="fas fa-sticky-note mr-2"></i>Catatan Admin
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <p class="mb-0 text-gray-800">
                                                <?php echo e($sidangRegistration->catatan_admin ?? 'Tidak ada catatan'); ?>

                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="card border-left-info shadow h-100">
                                        <div class="card-header py-2 bg-transparent">
                                            <h6 class="m-0 font-weight-bold text-info">
                                                <i class="fas fa-clipboard-list mr-2"></i>Catatan Kaprodi
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <p class="mb-0 text-gray-800">
                                                <?php echo e($sidangRegistration->catatan_kaprodi ?? 'Tidak ada catatan'); ?>

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-start mt-4">
                                <a href="<?php echo e(route('sidang-registrations.index')); ?>" class="btn btn-secondary">
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

<?php echo $__env->make('Template.Index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views/sidang_registrations/show.blade.php ENDPATH**/ ?>