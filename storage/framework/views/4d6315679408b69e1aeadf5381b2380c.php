<?php $__env->startSection('title', 'Nilai Sidang | SIPASTA'); ?>

<?php $__env->startSection('content'); ?>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid py-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Data Nilai Sidang</h5>
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

                        <a href="<?php echo e(route('sidang_values.create')); ?>" class="btn btn-primary btn-sm">
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
                                    <?php $__empty_1 = true; $__currentLoopData = $sidangValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $sidangValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="align-middle text-center">
                                    <td><?php echo e($index + 1); ?></td>
                                    <td><?php echo e($sidangValue->sidangSchedule->sidangRegistration->user->name ?? '-'); ?></td>
                                    
                                    <td>
                                        <?php
                                        $sidangSchedule = $sidangValue->sidangSchedule;

                                        $pengujis = [
                                        $sidangSchedule->penguji1->name ?? null,
                                        $sidangSchedule->penguji2->name ?? null,
                                        $sidangSchedule->penguji3->name ?? null,
                                        ];

                                        $no = 1;
                                        ?>

                                        <?php $__currentLoopData = $pengujis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $penguji): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($penguji): ?>
                                        <?php echo e($no++); ?>. <?php echo e($penguji); ?><br>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>

                                    <td>
                                        <?php
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
                                        ?>

                                        <?php if($nilai !== null): ?>
                                        <?php echo e($grade); ?> <?php echo e($nilai); ?>

                                        <?php else: ?>
                                        <em>Belum dinilai</em>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($sidangValue->komentar); ?></td>
                                    <td>
                                        <!-- Tombol Show (Dapat diakses oleh semua role) -->
                                        

                                        <!-- Tombol Edit dan Delete (Hanya untuk Admin) -->
                                        <a href="<?php echo e(route('sidang_values.edit', $sidangValue->id)); ?>"
                                            class="btn btn-warning btn-sm text-dark mb-2">Edit</a>

                                        <form id="delete-form-<?php echo e($sidangValue->id); ?>"
                                            action="<?php echo e(route('sidang_values.destroy', $sidangValue->id)); ?>"
                                            method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="button" class="btn btn-danger btn-sm mb-2"
                                                onclick="confirmDelete(<?php echo e($sidangValue->id); ?>)">
                                                Delete
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="7">
                                        <div class="alert alert-danger mb-0 text-center">
                                            Data Nilai Sidang belum Tersedia.
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

<?php echo $__env->make('Template.Index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views\sidang_values\index.blade.php ENDPATH**/ ?>