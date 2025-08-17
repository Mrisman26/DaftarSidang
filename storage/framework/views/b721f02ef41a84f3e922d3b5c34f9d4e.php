<?php $__env->startSection('title', 'Kelola Prodi | SIPASTA'); ?>

<?php $__env->startSection('content'); ?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid  py-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Kelola Prodi</h5>
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

                        <a href="<?php echo e(route('prodi.create')); ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Prodi
                        </a>

                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabel-data" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr class="align-middle text-center">
                                    <th>No</th>
                                    <th>Nama Prodi</th>
                                    <th>Jenjang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $prodis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $prodi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="align-middle text-center">
                                    <td><?php echo e($key + 1); ?></td>
                                    <td><?php echo e($prodi->nama_prodi); ?></td>
                                    <td><?php echo e($prodi->jenjang); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('prodi.edit', $prodi)); ?>"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        

                                        <form id="delete-form-<?php echo e($prodi->id); ?>"
                                            action="<?php echo e(route('prodi.destroy', $prodi->id)); ?>" method="POST"
                                            class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete(<?php echo e($prodi->id); ?>)">
                                                Delete
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6">
                                        <div class="alert alert-danger mb-0 text-center">
                                            Data Dosen belum tersedia.
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

<?php echo $__env->make('Template.Index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views\prodi\index.blade.php ENDPATH**/ ?>