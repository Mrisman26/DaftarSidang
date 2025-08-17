<?php $__env->startSection('title', 'Periode Sidang Akademik | SIPASTA'); ?>

<?php $__env->startSection('content'); ?>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid py-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Data Periode Sidang</h5>
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

                        <a href="<?php echo e(route('periode_sidang.create')); ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Periode Sidang
                        </a>

                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabel-data" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr class="align-middle text-center"">
                                    <th width=" 5%">No</th>
                                    <th width="30%">Periode</th>
                                    <th width="30%">Prodi</th>
                                    <th width="20%">Tanggal Mulai</th>
                                    <th width="20%">Tanggal Selesai</th>
                                    <th width="15%">Status</th>
                                    <th width="10%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $periodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $periode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($key + 1); ?></td>
                                    <td><?php echo e($periode->nama_periode); ?></td>
                                    <td><?php echo e($periode->prodi->nama_prodi ?? '-'); ?></td>
                                    <td>
                                        <span class="d-flex align-items-center">
                                            <i class="bi bi-calendar-event me-2 text-primary"></i>
                                            <?php echo e(\Carbon\Carbon::parse($periode->tanggal_mulai)->translatedFormat('d F Y')); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <span class="d-flex align-items-center">
                                            <i class="bi bi-calendar-check me-2 text-primary"></i>
                                            <?php echo e(\Carbon\Carbon::parse($periode->tanggal_selesai)->translatedFormat('d F Y')); ?>

                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <?php if($periode->is_aktif == 'Akan Datang'): ?>
                                        <span class="badge bg-warning text-dark">Akan Datang</span>
                                        <?php elseif($periode->is_aktif == 'Aktif'): ?>
                                        <span class="badge bg-success text-white">Aktif</span>
                                        <?php elseif($periode->is_aktif == 'Selesai'): ?>
                                        <span class="badge bg-secondary text-white">Selesai</span>
                                        <?php else: ?>
                                        <span class="badge bg-dark text-white">Tidak Diketahui</span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="<?php echo e(route('periode_sidang.edit', $periode->id)); ?>"
                                                class="btn btn-warning text-dark btn-sm mr-1 mb-1">Edit</a>
                                            <form id="delete-form-<?php echo e($periode->id); ?>"
                                                action="<?php echo e(route('periode_sidang.destroy', $periode)); ?>" method="POST"
                                                class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="button" class="btn btn-danger btn-sm mb-1"
                                                    onclick="confirmDelete(<?php echo e($periode->id); ?>)">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="7">
                                        <div class="alert alert-danger mb-0 text-center">
                                            Data Periode Sidang belum Tersedia.
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

<?php echo $__env->make('Template.Index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views/periode_sidang/index.blade.php ENDPATH**/ ?>