<?php $__env->startSection('title', 'Periode Sidang Akademik | SIPASTA'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-2">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><?php echo e(isset($periode_sidang) ? 'Edit Periode Sidang' : 'Tambah Periode Sidang'); ?></h4>
                </div>
                <div class="card-body">
                    <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <form
                        action="<?php echo e(isset($periode_sidang) ? route('periode_sidang.update', $periode_sidang) : route('periode_sidang.store')); ?>"
                        method="POST">
                        <?php echo csrf_field(); ?>
                        <?php if(isset($periode_sidang)): ?>
                        <?php echo method_field('PUT'); ?>
                        <?php endif; ?>

                        <div class="mb-3">
                            <label for="nama_periode" class="form-label fw-bold">Nama Periode <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="nama_periode" name="nama_periode"
                                class="form-control <?php $__errorArgs = ['nama_periode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('nama_periode', $periode_sidang->nama_periode ?? '')); ?>"
                                placeholder="Masukkan nama periode sidang" required>
                            <?php $__errorArgs = ['nama_periode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group">
                            <label for="prodi_id">Program Studi</label>
                            <select name="prodi_id" id="prodi_id" class="form-control" required>
                                <option value="">-- Pilih Prodi --</option>
                                <?php $__currentLoopData = $prodis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prodi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($prodi->id); ?>"><?php echo e($prodi->nama_prodi); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal_mulai" class="form-label fw-bold">Tanggal Mulai <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                        <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                                            class="form-control <?php $__errorArgs = ['tanggal_mulai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            value="<?php echo e(old('tanggal_mulai', $periode_sidang->tanggal_mulai ?? '')); ?>"
                                            required>
                                        <?php $__errorArgs = ['tanggal_mulai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal_selesai" class="form-label fw-bold">Tanggal Selesai <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                        <input type="date" id="tanggal_selesai" name="tanggal_selesai"
                                            class="form-control <?php $__errorArgs = ['tanggal_selesai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            value="<?php echo e(old('tanggal_selesai', $periode_sidang->tanggal_selesai ?? '')); ?>"
                                            required>
                                        <?php $__errorArgs = ['tanggal_selesai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="tanggal_selesai" class="form-label fw-bold">Status
                                        <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select name="is_aktif" class="form-control" required>
                                            <option value="Akan Datang"
                                                <?php echo e(old('is_aktif', $periode_sidang->is_aktif ?? '') == 'Akan Datang' ? 'selected' : ''); ?>>
                                                Akan Datang</option>
                                            <option value="Aktif"
                                                <?php echo e(old('is_aktif', $periode_sidang->is_aktif ?? '') == 'Aktif' ? 'selected' : ''); ?>>
                                                Aktif</option>
                                            <option value="Selesai"
                                                <?php echo e(old('is_aktif', $periode_sidang->is_aktif ?? '') == 'Selesai' ? 'selected' : ''); ?>>
                                                Selesai</option>
                                        </select>
                                        <?php $__errorArgs = ['tanggal_selesai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>


                        </div>

                        
                        <div class="d-flex justify-content-between">
                            <a href="<?php echo e(route('periode_sidang.index')); ?>" class="btn btn-secondary"><i
                                    class="fas fa-arrow-left mr-1"></i>Kembali</a>
                            <button type="submit"
                                class="btn btn-primary px-6 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <i class="bi bi-save"></i> <?php echo e(isset($periode_sidang) ? 'Perbarui' : 'Simpan'); ?>

                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Template.Index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views\periode_sidang\create.blade.php ENDPATH**/ ?>