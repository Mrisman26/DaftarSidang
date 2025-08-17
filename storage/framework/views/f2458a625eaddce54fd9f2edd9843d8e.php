<?php $__env->startSection('title', 'Detail Pendaftar Sidang | SIPASTA'); ?>

<?php $__env->startSection('content'); ?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container">

            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white">
                    <h4 class="m-0">Detail Pendaftar Sidang</h4>
                </div>
                <div class="card-body">

                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="font-weight-bold mb-2">Status Verifikasi Admin:</h6>
                            <?php $admin = $sidangRegistration->verifikasi_admin; ?>
                            <?php if($admin === 'pending'): ?>
                            <span class="badge bg-warning text-dark px-3 py-2">Pending</span>
                            <?php elseif($admin === 'diterima'): ?>
                            <span class="badge bg-success px-3 py-2 text-white">Diterima</span>
                            <?php elseif($admin === 'ditolak'): ?>
                            <span class="badge bg-danger px-3 py-2 text-white">Ditolak</span>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <h6 class="font-weight-bold mb-2">Status Verifikasi Kaprodi:</h6>
                            <?php $kaprodi = $sidangRegistration->verifikasi_kaprodi; ?>
                            <?php if($kaprodi === 'pending'): ?>
                            <span class="badge bg-warning text-dark px-3 py-2">Pending</span>
                            <?php elseif($kaprodi === 'diterima'): ?>
                            <span class="badge bg-success px-3 py-2 text-white">Diterima</span>
                            <?php elseif($kaprodi === 'ditolak'): ?>
                            <span class="badge bg-danger px-3 py-2 text-white">Ditolak</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="30%">Tanggal Daftar</th>
                                <td>
                                    <?php echo e(optional($sidangRegistration->created_at)->translatedFormat('d F Y') ?? '-'); ?>

                                </td>
                            </tr>
                            <tr>
                                <th>Judul Tugas Akhir</th>
                                <td><?php echo e($sidangRegistration->judul_tugas_akhir); ?></td>
                            </tr>
                            <tr>
                                <th>Dosen Pembimbing</th>
                                <td>
                                    <?php echo e($sidangRegistration->pembimbing->dosenProfile->nidn ?? '-'); ?> -
                                    <?php echo e($sidangRegistration->pembimbing->name ?? '-'); ?>

                                </td>
                            </tr>
                            <tr>
                                <th>Dosen Penguji</th>
                                <td>
                                    <?php if($sidangRegistration->sidangSchedule): ?>
                                    <div>
                                        <strong>1:</strong>

                                        <?php echo e($sidangRegistration->sidangSchedule->penguji1->name ?? '-'); ?>

                                    </div>
                                    <div>
                                        <strong>2:</strong>

                                        <?php echo e($sidangRegistration->sidangSchedule->penguji2->name ?? '-'); ?>

                                    </div>
                                    <div>
                                        <strong>3:</strong>

                                        <?php echo e($sidangRegistration->sidangSchedule->penguji3->name ?? '-'); ?>

                                    </div>
                                    <?php else: ?>
                                    <em>Belum ditentukan</em>
                                    <?php endif; ?>
                                </td>
                            </tr>

                            <tr>
                                <th>Nilai</th>
                                <td>
                                    <?php
                                    $schedule = $sidangRegistration->sidangSchedule;
                                    $values = $schedule?->values ?? collect();

                                    $nilai1 = $values->where('penguji_id', $schedule?->penguji_id_1)->first()?->nilai;
                                    $nilai2 = $values->where('penguji_id', $schedule?->penguji_id_2)->first()?->nilai;
                                    $nilai3 = $values->where('penguji_id', $schedule?->penguji_id_3)->first()?->nilai;

                                    $allNilai = collect([$nilai1, $nilai2, $nilai3])->filter(); // buang null
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
                                    ?>

                                    <ul class="mb-2">
                                        <li><strong>Penguji 1:</strong> <?php echo e($nilai1 ?? '-'); ?> <?php if($nilai1 !== null): ?>
                                            (<?php echo e(getGrade($nilai1)); ?>) <?php endif; ?></li>
                                        <li><strong>Penguji 2:</strong> <?php echo e($nilai2 ?? '-'); ?> <?php if($nilai2 !== null): ?>
                                            (<?php echo e(getGrade($nilai2)); ?>) <?php endif; ?></li>
                                        <li><strong>Penguji 3:</strong> <?php echo e($nilai3 ?? '-'); ?> <?php if($nilai3 !== null): ?>
                                            (<?php echo e(getGrade($nilai3)); ?>) <?php endif; ?></li>
                                    </ul>

                                    <strong>Rata-rata:</strong>
                                    <?php if($rataRata !== null): ?>
                                    <?php echo e($rataRata); ?> (<?php echo e(getGrade($rataRata)); ?>)
                                    <?php else: ?>
                                    <em>Belum lengkap</em>
                                    <?php endif; ?>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                    
                    <div class="mb-4">
                        <h6 class="font-weight-bold">Catatan Admin:</h6>
                        <div class="border rounded p-3 bg-light">
                            <?php echo e($sidangRegistration->catatan_admin ?? 'Tidak ada catatan'); ?>

                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="font-weight-bold">Catatan Kaprodi:</h6>
                        <div class="border rounded p-3 bg-light">
                            <?php echo e($sidangRegistration->catatan_kaprodi ?? 'Tidak ada catatan'); ?>

                        </div>
                    </div>


                    
                    <div class="d-flex justify-content-start">
                        <a href="<?php echo e(route('sidang-registrations.index')); ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Template.Index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views\sidang_registrations\show.blade.php ENDPATH**/ ?>