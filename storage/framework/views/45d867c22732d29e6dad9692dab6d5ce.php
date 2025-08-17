<?php $__env->startSection('title', 'Kelola Dosen | SIPASTA'); ?>

<?php $__env->startSection('content'); ?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid  py-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Kelola Dosen</h5>
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

                        <a href="<?php echo e(route('dosen.create')); ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Dosen
                        </a>

                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabel-data" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr class="align-middle text-center">
                                    <th>No</th>
                                    <th>Nama</th>
                                    
                                    
                                    <th>Program Studi</th>
                                    <th>Dosen</th>
                                    
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $dosen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="align-middle text-center">
                                    <td><?php echo e($key + 1); ?></td>
                                    <td><?php echo e($teacher->name); ?></td>
                                    
                                    
                                    <td><?php echo e($teacher->dosenProfile?->prodi?->nama_prodi ?? 'N/A'); ?></td>

                                    <!-- Misalkan prodi punya relasi ke nama -->
                                    
                                    
                                    <td>
                                        <?php if($teacher->dosenProfile?->is_pembimbing): ?>
                                            <span class="badge bg-info text-white">Pembimbing</span>
                                        <?php endif; ?>
                                        <?php if($teacher->dosenProfile?->is_penguji): ?>
                                            <span class="badge bg-success text-dark">Penguji</span>
                                        <?php endif; ?>
                                        <?php if(!$teacher->dosenProfile?->is_pembimbing && !$teacher->dosenProfile?->is_penguji): ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <!-- Tombol Show (Dapat diakses oleh semua role) -->
                                        <a href="<?php echo e(route('dosen.show', $teacher->id)); ?>"
                                            class="btn btn-primary btn-sm mb-2">Show</a>

                                        <!-- Tombol Edit dan Delete (Hanya untuk Admin) -->
                                        <a href="<?php echo e(route('dosen.edit', $teacher->id)); ?>"
                                            class="btn btn-warning text-dark btn-sm mb-2">Edit</a>

                                        <form id="delete-form-<?php echo e($teacher->id); ?>"
                                            action="<?php echo e(route('dosen.destroy', $teacher->id)); ?>" method="POST"
                                            class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="button" class="btn btn-danger btn-sm mb-2"
                                                onclick="confirmDelete(<?php echo e($teacher->id); ?>)">
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

<?php echo $__env->make('Template.Index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views\dosen\index.blade.php ENDPATH**/ ?>