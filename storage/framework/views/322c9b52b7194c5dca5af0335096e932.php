<?php $__env->startSection('title', 'Periode Sidang Akademik | SIPASTA'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><?php echo e(isset($periode_sidang) ? 'Edit Periode Sidang' : 'Tambah Periode Sidang'); ?></h4>
                </div>
                <div class="card-body p-4">
                    <?php if($errors->any()): ?>
                    <div class="alert alert-danger mb-4">
                        <ul class="mb-0">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <form
                        action="<?php echo e(isset($periode_sidang) ? route('periode_sidang.update', $periode_sidang) : route('periode_sidang.store')); ?>"
                        method="POST" class="needs-validation" novalidate>
                        <?php echo csrf_field(); ?>
                        <?php if(isset($periode_sidang)): ?>
                        <?php echo method_field('PUT'); ?>
                        <?php endif; ?>

                        <div class="mb-4">
                            <label for="nama_periode" class="form-label fw-semibold">
                                <i class="bi bi-tag-fill text-primary me-1"></i> Nama Periode
                                <span class="text-danger">*</span>
                            </label>
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
                                placeholder="Contoh: Sidang Skripsi Periode Semester Ganjil 2024/2025" required>
                            <div class="form-text">Masukkan nama periode yang deskriptif dan mudah dikenali</div>
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

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3 mb-md-0">
                                    <label for="tanggal_mulai" class="form-label fw-semibold">
                                        <i class="bi bi-calendar-event text-primary me-1"></i> Tanggal Mulai
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-calendar3"></i></span>
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
                                    <div class="form-text">Tanggal pembukaan pendaftaran</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label for="tanggal_selesai" class="form-label fw-semibold">
                                        <i class="bi bi-calendar-check text-primary me-1"></i> Tanggal Selesai
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-calendar3"></i></span>
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
                                    <div class="form-text">Tanggal penutupan pendaftaran</div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="prodi_id">Program Studi</label>
                            <select name="prodi_id" class="form-control" required>
                                <option value="">-- Pilih Prodi --</option>
                                <?php $__currentLoopData = $prodis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prodi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($prodi->id); ?>"
                                    <?php echo e(old('prodi_id', $periode_sidang->prodi_id) == $prodi->id ? 'selected' : ''); ?>>
                                    <?php echo e($prodi->nama_prodi); ?>

                                </option>
                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="is_aktif" class="form-label fw-semibold">
                                <i class="bi bi-toggle-on text-primary me-1"></i> Status Periode
                                <span class="text-danger">*</span>
                            </label>
                            <select name="is_aktif" id="is_aktif"
                                class="form-control <?php $__errorArgs = ['is_aktif'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="" selected disabled>-- Pilih Status --</option>
                                <option value="Akan Datang"
                                    <?php echo e((old('is_aktif', $periode_sidang->is_aktif ?? '') == 'Akan Datang') ? 'selected' : ''); ?>>
                                    Akan Datang
                                </option>
                                <option value="Aktif"
                                    <?php echo e((old('is_aktif', $periode_sidang->is_aktif ?? '') == 'Aktif') ? 'selected' : ''); ?>>
                                    Aktif
                                </option>
                                <option value="Selesai"
                                    <?php echo e((old('is_aktif', $periode_sidang->is_aktif ?? '') == 'Selesai') ? 'selected' : ''); ?>>
                                    Selesai
                                </option>
                            </select>
                            <div class="form-text">Status ini akan menentukan apakah periode dapat diakses oleh
                                mahasiswa</div>
                            <?php $__errorArgs = ['is_aktif'];
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

                        <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                            <div>
                                <a href="<?php echo e(route('periode_sidang.index')); ?>" class="btn btn-secondary"><i
                                        class="fas fa-arrow-left mr-1"></i>Kembali</a>
                            </div>
                            <div>
                                <?php if(isset($periode_sidang)): ?>
                                <button type="reset" class="btn btn-success me-2">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                                </button>
                                <?php endif; ?>
                                <button type="submit"
                                    class="btn btn-primary px-6 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <i class="bi bi-save"></i> <?php echo e(isset($periode_sidang) ? 'Perbarui' : 'Simpan'); ?>

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('.needs-validation');
        const tanggalMulai = document.getElementById('tanggal_mulai');
        const tanggalSelesai = document.getElementById('tanggal_selesai');

        // Date range validation
        tanggalMulai.addEventListener('change', function () {
            tanggalSelesai.min = this.value;
            if (tanggalSelesai.value && new Date(tanggalSelesai.value) < new Date(this.value)) {
                tanggalSelesai.value = this.value;
            }
        });

        // Form validation
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            // Additional validation for date range
            if (new Date(tanggalSelesai.value) < new Date(tanggalMulai.value)) {
                event.preventDefault();
                alert('Tanggal selesai tidak boleh sebelum tanggal mulai');
            }

            form.classList.add('was-validated');
        }, false);
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Template.Index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views\periode_sidang\edit.blade.php ENDPATH**/ ?>