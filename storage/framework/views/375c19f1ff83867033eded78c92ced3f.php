<?php $__env->startSection('title', 'Detail Jadwal Sidang | SIPASTA'); ?>

<?php $__env->startSection('content'); ?>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container">

            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white">
                    <h4 class="m-0 ">Detail Jadwal Sidang</h4>
                </div>
                <div class="card-body">

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Informasi Jadwal Sidang</h6>
                        <a href="<?php echo e(route('sidang_schedules.daftar_hadir', $jadwalSidang->id)); ?>" target="_blank"
                            class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-print mr-1"></i> Cetak Daftar Hadir
                        </a>
                        <a href="<?php echo e(route('sidang_schedules.berita_acara', $jadwalSidang->id)); ?>" target="_blank"
                            class="btn btn-outline-danger btn-sm">
                            <i class="fas fa-file-alt"></i> Berita Acara
                        </a>
                    </div>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="30%">Mahasiswa</th>
                                <td>
                                    <?php if($jadwalSidang->sidangRegistration): ?>
                                    <?php echo e($jadwalSidang->sidangRegistration->user->name); ?>

                                    <?php else: ?>
                                    <em>Belum ditentukan</em>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Pembimbing</th>
                                <td>
                                    <?php if($jadwalSidang->pembimbing): ?>
                                    <?php echo e($jadwalSidang->pembimbing->name ?? '-'); ?>

                                    <?php else: ?>
                                    <em>Belum ditentukan</em>
                                    <?php endif; ?>
                                </td>
                            </tr>

                            <tr>
                                <th>Penguji</th>
                                <td>
                                    <?php
                                    $pengujis = [
                                    $jadwalSidang->penguji1->name ?? null,
                                    $jadwalSidang->penguji2->name ?? null,
                                    $jadwalSidang->penguji3->name ?? null,
                                    ];
                                    $no = 1;
                                    ?>

                                    <?php $__currentLoopData = $pengujis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $penguji): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($penguji): ?>
                                    <?php echo e($no++); ?>. <?php echo e($penguji); ?><br>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                            </tr>

                            <tr>
                                <th>Ruangan</th>
                                <td>
                                    <?php if($jadwalSidang->ruangan->nama_ruangan): ?>
                                    <?php echo e(($jadwalSidang->ruangan->nama_ruangan)); ?>

                                    <?php else: ?>
                                    <em>Belum ditentukan</em>
                                    <?php endif; ?>
                                </td>
                            </tr>

                            <tr>
                                <th width="30%">Tanggal Sidang</th>
                                <td>
                                    <?php if($jadwalSidang->tanggal_sidang): ?>
                                    <?php echo e(\Carbon\Carbon::parse($jadwalSidang->tanggal_sidang)->translatedFormat('d F Y')); ?>

                                    <?php else: ?>
                                    <em>Belum ditentukan</em>
                                    <?php endif; ?>
                                </td>
                            </tr>

                            <tr>
                                <th>Mulai</th>
                                <td>
                                    <?php if($jadwalSidang->jam_mulai &&
                                    $jadwalSidang->jam_mulai): ?>
                                    <?php echo e(\Carbon\Carbon::parse($jadwalSidang->jam_mulai)->format('H:i')); ?>

                                    <?php else: ?>
                                    <em>Belum ditentukan</em>
                                    <?php endif; ?>
                                </td>

                            </tr>

                            <tr>
                                <th>Selesai</th>
                                <td>
                                    <?php if($jadwalSidang->jam_selesai &&
                                    $jadwalSidang->jam_selesai): ?>
                                    <?php echo e(\Carbon\Carbon::parse($jadwalSidang->jam_selesai)->format('H:i')); ?>

                                    <?php else: ?>
                                    <em>Belum ditentukan</em>
                                    <?php endif; ?>
                                </td>

                            </tr>
                            <tr>
                            </tr>
                        </tbody>
                    </table>

                    
                    

            
            <a href="<?php echo e(route('sidang-schedules.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>

        </div>
    </div>

</div>
</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Template.Index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views\sidang_schedules\show.blade.php ENDPATH**/ ?>