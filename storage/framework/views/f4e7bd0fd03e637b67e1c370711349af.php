<?php $__env->startSection('title', 'Edit Mahasiswa | SIPASTA'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Dosen</h5>
        </div>
        <div class="card-body">

            <?php if($errors->has('peran')): ?>
            <div class="alert alert-danger">
                <?php echo e($errors->first('peran')); ?>

            </div>
            <?php endif; ?>

            <form action="<?php echo e(route('dosen.update', $user->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="mb-3">
                    <label for="name">Nama</label>
                    <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label for="password">Password (Biarkan kosong jika tidak diganti)</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="nidn">NIDN</label>
                    <input type="text" name="nidn" value="<?php echo e(old('nidn', $user->dosenProfile->nidn)); ?>"
                        class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="prodi_id">Program Studi</label>
                    <select name="prodi_id" class="form-control" required>
                        <option value="">-- Pilih Prodi --</option>
                        <?php $__currentLoopData = $prodis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prodi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($prodi->id); ?>"
                            <?php echo e(old('prodi_id', $user->dosenProfile->prodi_id) == $prodi->id ? 'selected' : ''); ?>>
                            <?php echo e($prodi->nama_prodi); ?> (<?php echo e($prodi->jenjang); ?>)
                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                
                <div class="mb-3">
                    <label class="form-label d-block">Role</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" value="Dosen"
                            <?php echo e($user->hasRole('Dosen') ? 'checked' : ''); ?>>
                        <label class="form-check-label">Dosen</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" value="Kaprodi"
                            <?php echo e($user->hasRole('Kaprodi') ? 'checked' : ''); ?>>
                        <label class="form-check-label">Kaprodi</label>
                    </div>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="is_pembimbing" id="is_pembimbing"
                        <?php echo e(old('is_pembimbing', $user->dosenProfile->is_pembimbing) ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="is_pembimbing">
                        Sebagai Dosen Pembimbing
                    </label>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="is_penguji" id="is_penguji"
                        <?php echo e(old('is_penguji', $user->dosenProfile->is_penguji) ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="is_penguji">
                        Sebagai Dosen Penguji
                    </label>
                </div>

                <div class="mb-3">
                    <label for="no_hp">No HP</label>
                    <input type="text" name="no_hp" value="<?php echo e(old('no_hp', $user->profile->no_hp ?? '')); ?>"
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat"
                        class="form-control"><?php echo e(old('alamat', $user->profile->alamat ?? '')); ?></textarea>
                </div>

                
                <div class="d-flex justify-content-between">
                    <a href="<?php echo e(route('dosen.index')); ?>" class="btn btn-secondary"><i
                            class="fas fa-arrow-left mr-1"></i>Kembali</a>
                    <button type="submit"
                        class="btn btn-primary px-6 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Template.Index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views\dosen\edit.blade.php ENDPATH**/ ?>