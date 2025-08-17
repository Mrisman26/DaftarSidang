<?php $__env->startSection('title', 'Daftar Sidang | SIPASTA'); ?>

<?php $__env->startSection('content'); ?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid py-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Daftar Pendaftar Sidang</h5>
                </div>
                <div class="card-body">

                    <?php if(session('success')): ?>
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: "<?php echo e(session('success')); ?>",
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        });
                    </script>
                    <?php endif; ?>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0"></h6>
                        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Mahasiswa')): ?>
                        <?php
                        $latest = $sidangRegistrations->first(); // data terbaru setelah di-sort di controller
                        ?>

                        <?php if(is_null($latest) || $latest->verifikasi_admin === 'ditolak' || $latest->verifikasi_kaprodi
                        === 'ditolak'): ?>
                        <a href="<?php echo e(route('sidang-registrations.create')); ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Ajukan Pendaftaran
                        </a>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>


                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabel-data" width="100%" cellspacing="0">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Tanggal Daftar</th>
                                    
                                    
                                    
                                    <th>Status Verifikasi Admin</th>
                                    <th>Status Verifikasi Kaprodi</th>
                                    
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $sidangRegistrations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sidang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="align-middle text-center">
                                    <td><?php echo e($key + 1); ?></td>
                                    <td>
                                        <?php echo e($sidang->user->name ?? '-'); ?></td>
                                    </td>
                                    <td>
                                        <?php if($sidang->created_at): ?>
                                        <?php echo e(\Carbon\Carbon::parse($sidang->created_at)->translatedFormat('d F Y')); ?>

                                        <?php else: ?>
                                        <em>Belum ditentukan</em>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        
                                        <?php if($sidang->verifikasi_admin == 'pending'): ?>
                                        <span class="badge bg-warning text-dark">Pending</span>
                                        <?php elseif($sidang->verifikasi_admin == 'diterima'): ?>
                                        <span class="badge bg-success text-white">Diterima</span>
                                        <?php elseif($sidang->verifikasi_admin == 'ditolak'): ?>
                                        <span class="badge bg-danger text-white">Ditolak</span>
                                        <?php else: ?>
                                        <span class="badge bg-secondary">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        
                                        <?php if($sidang->verifikasi_kaprodi == 'pending'): ?>
                                        <span class="badge bg-warning text-dark">Pending</span>
                                        <?php elseif($sidang->verifikasi_kaprodi == 'diterima'): ?>
                                        <span class="badge bg-success text-white">Diterima</span>
                                        <?php elseif($sidang->verifikasi_kaprodi == 'ditolak'): ?>
                                        <span class="badge bg-danger text-white">Ditolak</span>
                                        <?php else: ?>
                                        <span class="badge bg-secondary">-</span>
                                        <?php endif; ?>
                                    </td>

                                    <?php $__currentLoopData = $sidangRegistrations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sidangRegistration): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                    <td>
                                        <div class="d-flex flex-wrap justify-content-center gap-1">

                                            <a href="<?php echo e(route('sidang-registrations.show', $sidang)); ?>"
                                                class="btn btn-primary btn-sm mr-1 mb-1">Detail</a>

                                            <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Admin|Kaprodi')): ?>

                                            
                                            <?php if(
                                            (auth()->user()->hasRole('Admin') && $sidang->verifikasi_admin !==
                                            'diterima') ||
                                            (auth()->user()->hasRole('Kaprodi') && $sidang->verifikasi_kaprodi !==
                                            'diterima')
                                            ): ?>
                                            <?php if(auth()->user()->hasRole('Admin')): ?>
                                            <a href="<?php echo e(route('sidang.verifikasi.admin', $sidang->id)); ?>"
                                                class="btn btn-info btn-sm mr-1 mb-1">Verifikasi Admin</a>
                                            <?php endif; ?>

                                            <?php if(auth()->user()->hasRole('Kaprodi')): ?>
                                            <a href="<?php echo e(route('sidang.verifikasi.kaprodi', $sidang->id)); ?>"
                                                class="btn btn-warning btn-sm mr-1 mb-1">Verifikasi Kaprodi</a>
                                            <?php endif; ?>
                                            <?php endif; ?>

                                            
                                            <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Admin')): ?>
                                            <form id="delete-form-<?php echo e($sidang->id); ?>"
                                                action="<?php echo e(route('sidang-registrations.destroy', $sidang)); ?>"
                                                method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="button" class="btn btn-danger btn-sm mb-1"
                                                    onclick="confirmDelete(<?php echo e($sidang->id); ?>)">Hapus</button>
                                            </form>
                                            <?php endif; ?>

                                            <?php endif; ?>

                                            <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Mahasiswa')): ?>
                                            <?php if(!$sidang->values && ($sidang->verifikasi_admin === 'ditolak' ||
                                            $sidang->verifikasi_kaprodi === 'ditolak')): ?>
                                            <a href="<?php echo e(route('sidang-registrations.edit', $sidang)); ?>"
                                                class="btn btn-warning text-dark btn-sm mr-1 mb-1">Edit Pengajuan</a>
                                            <?php endif; ?>
                                            <?php endif; ?>


                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6">
                                        <div class="alert alert-danger mb-0 text-center">
                                            Data Pendaftar Sidang belum tersedia.
                                        </div>
                                    </td>
                                </tr>
                                <?php endif; ?>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Template.Index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views/sidang_registrations/index.blade.php ENDPATH**/ ?>