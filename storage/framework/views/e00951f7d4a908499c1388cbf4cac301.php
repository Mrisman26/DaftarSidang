<?php $__env->startSection('title', 'Verifikasi Kaprodi | SIPASTA'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">Verifikasi Kaprodi</div>
        <div class="card-body">

            <div class="card mb-3">
                        <div class="card-header">
                            Berkas yang Diajukan Mahasiswa
                        </div>
                        <div class="card-body">
                            <?php if(!$berkas || $berkas->isEmpty()): ?>
                            <p class="text-danger">Belum ada berkas yang diunggah.</p>
                            <?php else: ?>
                            <ul class="list-group">
                                <?php $__currentLoopData = $berkas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?php echo e(ucfirst(str_replace('_', ' ', $item->jenis_berkas))); ?>

                                    <a href="<?php echo e(asset('storage/' . $item->file_path)); ?>" target="_blank">Lihat
                                        Berkas</a>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <?php endif; ?>
                        </div>
                    </div>

            
            <form action="<?php echo e(route('sidang.update.kaprodi', $sidangRegistration->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="form-group">
                    <label for="verifikasi_kaprodi">Status Verifikasi Kaprodi</label>
                    <select name="verifikasi_kaprodi" id="verifikasi_kaprodi" class="form-control" required>
                        <option value="pending" <?php echo e($sidangRegistration->verifikasi_kaprodi === 'pending' ? 'selected' : ''); ?>>Pending</option>
                        <option value="diterima" <?php echo e($sidangRegistration->verifikasi_kaprodi === 'diterima' ? 'selected' : ''); ?>>Diterima</option>
                        <option value="ditolak" <?php echo e($sidangRegistration->verifikasi_kaprodi === 'ditolak' ? 'selected' : ''); ?>>Ditolak</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="catatan_kaprodi">Catatan Kaprodi</label>
                    <textarea name="catatan_kaprodi" class="form-control" rows="3"><?php echo e(old('catatan_kaprodi', $sidangRegistration->catatan_kaprodi)); ?></textarea>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <a href="<?php echo e(route('sidang-registrations.index')); ?>" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Template.Index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views/sidang_registrations/verifikasi-kaprodi.blade.php ENDPATH**/ ?>