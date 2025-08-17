<?php $__env->startSection('title', 'Create Dosen | SIPASTA'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tambah Dosen</h5>
        </div>
        <div class="card-body">

            <?php if($errors->has('peran')): ?>
            <div class="alert alert-danger">
                <?php echo e($errors->first('peran')); ?>

            </div>
            <?php endif; ?>

            <form action="<?php echo e(route('dosen.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="mb-3">
                    <label for="name">Nama</label>
                    <input type="text" name="name" class="form-control" value="<?php echo e(old('name')); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo e(old('email')); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="nidn">NIDN</label>
                    <input type="text" name="nidn" class="form-control" value="<?php echo e(old('nidn')); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="prodi_id">Program Studi</label>
                    <select name="prodi_id" class="form-control" required>
                        <option value="">-- Pilih Prodi --</option>
                        <?php $__currentLoopData = $prodis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prodi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($prodi->id); ?>" <?php echo e(old('prodi_id') == $prodi->id ? 'selected' : ''); ?>>
                            <?php echo e($prodi->nama_prodi); ?> (<?php echo e($prodi->jenjang); ?>)
                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Peran Dosen</label>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check border rounded">
                                <input class="form-check-input" type="checkbox" name="is_pembimbing" id="is_pembimbing"
                                    value="1" <?php echo e(old('is_pembimbing') ? 'checked' : ''); ?>>
                                <label class="form-check-label ms-2" for="is_pembimbing">
                                    Dosen Pembimbing
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mt-md-0">
                            <div class="form-check border rounded">
                                <input class="form-check-input" type="checkbox" name="is_penguji" id="is_penguji"
                                    value="1" <?php echo e(old('is_penguji') ? 'checked' : ''); ?>>
                                <label class="form-check-label ms-2" for="is_penguji">
                                    Dosen Penguji
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Role</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" id="role_dosen" value="Dosen"
                            <?php echo e(old('role', 'Dosen') == 'Dosen' ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="role_dosen">Dosen</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" id="role_kaprodi" value="Kaprodi"
                            <?php echo e(old('role') == 'Kaprodi' ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="role_kaprodi">Kaprodi</label>
                    </div>
                </div>


                <div class="mb-3">
                    <label for="no_hp">No HP</label>
                    <input type="text" name="no_hp" class="form-control" value="<?php echo e(old('no_hp')); ?>">
                </div>

                <div class="mb-3">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" class="form-control"><?php echo e(old('alamat')); ?></textarea>
                </div>

                
                <div class="d-flex justify-content-between">
                    <a href="<?php echo e(route('dosen.index')); ?>" class="btn btn-secondary"><i
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

<?php echo $__env->make('Template.Index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views\dosen\create.blade.php ENDPATH**/ ?>