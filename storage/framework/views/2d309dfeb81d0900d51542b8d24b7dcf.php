<?php $__env->startSection('title', 'Create Ruangan | SIPASTA'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tambah Ruangan</h5>
        </div>
        <div class="card-body">

            <?php if($errors->has('peran')): ?>
            <div class="alert alert-danger">
                <?php echo e($errors->first('peran')); ?>

            </div>
            <?php endif; ?>

            <form action="<?php echo e(route('ruangan.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="mb-3">
                    <label for="name">Kode Ruangan</label>
                    <input type="text" name="kode_ruangan" class="form-control" value="<?php echo e(old('kode_ruangan')); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="name">Nama Ruangan</label>
                    <input type="text" name="nama_ruangan" class="form-control" value="<?php echo e(old('nama_ruangan')); ?>" required>
                </div>

                <div class="mb-3">
                    <label>Prodi (Opsional)</label>
                    <select name="prodi_id" class="form-control">
                        <option value="">-- Umum --</option>
                        <?php $__currentLoopData = $prodis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prodi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($prodi->id); ?>"><?php echo e($prodi->nama_prodi); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                
                <div class="d-flex justify-content-between">
                    <a href="<?php echo e(route('ruangan.index')); ?>" class="btn btn-secondary"><i
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

<?php echo $__env->make('Template.Index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views/ruangan/create.blade.php ENDPATH**/ ?>