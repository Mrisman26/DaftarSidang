<?php $__env->startSection('title', 'Edit Nilai Sidang | SIPASTA'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Nilai</h5>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('sidang_values.update', $sidangValue->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <!-- Nilai -->
                <div class="mb-3">
                    <label for="nilai" class="form-label">Nilai</label>
                    <input type="number" step="0.01" name="nilai" id="nilai" class="form-control"
                           value="<?php echo e(old('nilai', $sidangValue->nilai)); ?>" required>
                </div>

                <!-- Catatan (Opsional) -->
                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan</label>
                    <textarea name="catatan" id="catatan" class="form-control" rows="3"><?php echo e(old('catatan', $sidangValue->komentar)); ?></textarea>
                </div>

                
                <div class="d-flex justify-content-between">
                    <a href="<?php echo e(route('sidang_values.index')); ?>" class="btn btn-secondary"><i
                            class="fas fa-arrow-left mr-1"></i>Kembali</a>
                    <button type="submit"
                        class="btn btn-primary px-6 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Template.Index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views\sidang_values\edit.blade.php ENDPATH**/ ?>