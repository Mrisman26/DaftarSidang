<?php $__env->startSection('content'); ?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Profil Mahasiswa</h1>

            <!-- Notifikasi -->
            <?php if(session('success')): ?>
            <div id="alert-success" class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-2"></i> <?php echo e(session('success')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
            <div id="alert-error" class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle mr-2"></i> <?php echo e(session('error')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif; ?>

            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm border-left-primary">
                        <div class="card-header bg-primary text-white py-2">
                            <h6 class="m-0 font-weight-bold">Informasi Profil</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?php echo e(route('profile.update')); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('patch'); ?>

                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        value="<?php echo e(old('name', $user->name)); ?>" required autofocus>
                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email Aktif</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        value="<?php echo e(old('email', $user->email)); ?>" required>
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <?php if($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !
                                $user->hasVerifiedEmail()): ?>
                                <div class="alert alert-warning small mt-2">
                                    <p class="mb-1">Alamat email Anda belum terverifikasi.</p>
                                    <button form="send-verification" class="btn btn-link p-0 small">Kirim ulang email
                                        verifikasi</button>
                                    <?php if(session('status') === 'verification-link-sent'): ?>
                                    <p class="text-success small mt-1">Link verifikasi baru telah dikirim ke email Anda.
                                    </p>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>

                                <?php
                                $isMahasiswa = $user->hasRole('Mahasiswa');
                                $isDosen = $user->hasRole('Dosen');

                                $label = $isMahasiswa ? 'NIM' : ($isDosen ? 'NIDN' : '');
                                $nameInput = $isMahasiswa ? 'nim' : ($isDosen ? 'nidn' : '');
                                $valueInput = '';

                                if ($isMahasiswa) {
                                $valueInput = $mahasiswaProfile->nim ?? '';

                                } elseif ($isDosen) {
                                $valueInput = $dosenProfile->nidn ?? '';
                                }
                                ?>


                                <?php if($isMahasiswa || $isDosen): ?>
                                <div class="form-group">
                                    <label for="<?php echo e($nameInput); ?>"><?php echo e($label); ?></label>
                                    <input type="text" id="<?php echo e($nameInput); ?>" name="<?php echo e($nameInput); ?>"
                                        class="form-control" value="<?php echo e(old($nameInput, $valueInput)); ?>" required>
                                    <?php $__errorArgs = [$nameInput];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <?php endif; ?>


                                <?php
                                $selectedProdiId = null;

                                if ($isMahasiswa) {
                                $selectedProdiId = $mahasiswaProfile->prodi_id ?? null;
                                } elseif ($isDosen) {
                                $selectedProdiId = $dosenProfile->prodi_id ?? null;
                                }
                                ?>

                                <?php if($isMahasiswa || $isDosen): ?>
                                <div class="form-group">
                                    <label for="prodi_id">Program Studi</label>
                                    <select id="prodi_id" name="prodi_id" class="form-control">
                                        <option value="" disabled
                                            <?php echo e(is_null(old('prodi_id', $selectedProdiId)) ? 'selected' : ''); ?>>
                                            Pilih Program Studi
                                        </option>
                                        <?php $__currentLoopData = $prodis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prodi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($prodi->id); ?>"
                                            <?php echo e($prodi->id == old('prodi_id', $selectedProdiId) ? 'selected' : ''); ?>>
                                            <?php echo e($prodi->nama_prodi); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['prodi_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <?php endif; ?>

                                <div class="form-group">
                                    <label for="no_hp">Nomor HP</label>
                                    <input type="text" id="no_hp" name="no_hp" class="form-control"
                                        value="<?php echo e(old('no_hp', $user->profile->no_hp ?? '')); ?>">
                                    <?php $__errorArgs = ['no_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat Lengkap</label>
                                    <textarea id="alamat" name="alamat" class="form-control"
                                        rows="2"><?php echo e(old('alamat', $user->profile->alamat ?? '')); ?></textarea>
                                    <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Update Profil</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm border-left-warning mb-4">
                        <div class="card-header bg-warning text-white py-2">
                            <h6 class="m-0 font-weight-bold">Ubah Password</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?php echo e(route('password.update')); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('put'); ?>

                                <div class="form-group">
                                    <label for="current_password">Password Saat Ini</label>
                                    <input type="password" id="current_password" name="current_password"
                                        class="form-control" required>
                                    <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password Baru</label>
                                    <input type="password" id="password" name="password" class="form-control" required>
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control" required>
                                    <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <button type="submit" class="btn btn-warning btn-block text-white">Update
                                    Password</button>
                            </form>
                        </div>
                    </div>

                    <div class="card shadow-sm border-left-info mb-4">
                        <div class="card-header bg-info text-white py-2">
                            <h6 class="m-0 font-weight-bold">Informasi Akun</h6>
                        </div>
                        <div class="card-body">
                            <p><i class="fas fa-user mr-2"></i> <strong>Nama:</strong> <?php echo e(Auth::user()->name); ?></p>
                            <p><i class="fas fa-envelope mr-2"></i> <strong>Email:</strong> <?php echo e(Auth::user()->email); ?>

                            </p>
                            <p><i class="fas fa-calendar-alt mr-2"></i> <strong>Bergabung Sejak:</strong>
                                <?php echo e(Auth::user()->created_at->format('d M Y')); ?></p>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus Akun -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" role="dialog" aria-labelledby="deleteAccountModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAccountModalLabel">Hapus Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-danger">Apakah Anda yakin ingin menghapus akun ini? Tindakan ini tidak dapat
                    dibatalkan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <form action="<?php echo e(route('profile.destroy')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('delete'); ?>
                    <button type="submit" class="btn btn-danger">Hapus Akun</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Template.Index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views/profile/partials/delete-user-form.blade.php ENDPATH**/ ?>