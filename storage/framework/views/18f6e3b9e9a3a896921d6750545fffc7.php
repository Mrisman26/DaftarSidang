 

<?php $__env->startSection('content'); ?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Profile</h1>

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
                <div class="col-lg-6">
                    <!-- Update Profile Information -->
                    <div class="card shadow-sm mb-4 border-left-primary">
                        <div class="card-header bg-primary text-white">
                            <h6 class="m-0 font-weight-bold">Profile Information</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?php echo e(route('profile.update')); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('patch'); ?>

                                <!-- Form untuk nama dan email (sudah ada) -->
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" class="form-control" value="<?php echo e(old('name', $user->name)); ?>" required autofocus>
                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" value="<?php echo e(old('email', $user->email)); ?>" required>
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <?php if($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail()): ?>
                                    <div class="alert alert-warning mt-2">
                                        <p>Your email address is unverified.</p>
                                        <button form="send-verification" class="btn btn-link">Click here to re-send the verification email.</button>
                                        <?php if(session('status') === 'verification-link-sent'): ?>
                                            <p class="text-success mt-2">A new verification link has been sent to your email address.</p>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Form untuk melengkapi profil mahasiswa -->
                                <div class="form-group">
                                    <label for="nim">NIM</label>
                                    <input type="text" id="nim" name="nim" class="form-control"  required>
                                    <?php $__errorArgs = ['nim'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="form-group">
                                    <label for="prodi_id">Program Studi</label>
                                    <select id="prodi_id" name="prodi_id" class="form-control" required>
                                        <option value="" disabled selected>Select Program Studi</option>
                                        
                                    </select>
                                    
                                </div>

                                <div class="form-group">
                                    <label for="no_hp">No. HP</label>
                                    <input type="text" id="no_hp" name="no_hp" class="form-control">
                                    
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea id="alamat" name="alamat" class="form-control"></textarea>
                                    
                                </div>

                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-lg-6">
                    <!-- Update Password -->
                    <div class="card shadow-sm mb-4 border-left-warning">
                        <div class="card-header bg-warning text-white">
                            <h6 class="m-0 font-weight-bold">Update Password</h6>
                        </div>
                        <div class="card-body">
                            <?php echo $__env->make('profile.partials.update-password-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                    </div>

                    <!-- Informasi Tambahan -->
                    <div class="card shadow-sm mb-4 border-left-info">
                        <div class="card-header bg-info text-white">
                            <h6 class="m-0 font-weight-bold">Account Information</h6>
                        </div>
                        <div class="card-body">
                            <p><strong>Name:</strong> <?php echo e(Auth::user()->name); ?></p>
                            <p><strong>Email:</strong> <?php echo e(Auth::user()->email); ?></p>
                            <p><strong>Joined:</strong> <?php echo e(Auth::user()->created_at->format('d M Y')); ?></p>
                        </div>
                    </div>

                    <!-- Delete Account -->
                    <div class="card shadow-sm mb-4 border-left-danger">
                        <div class="card-header bg-danger text-white">
                            <h6 class="m-0 font-weight-bold">Delete Account</h6>
                        </div>
                        <div class="card-body">
                            <?php echo $__env->make('profile.partials.delete-user-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Notifikasi otomatis menghilang setelah 5 detik
    setTimeout(() => {
        document.getElementById('alert-success')?.classList.add('fade-out');
        document.getElementById('alert-error')?.classList.add('fade-out');
    }, 5000);
</script>

<style>
    .fade-out {
        opacity: 0;
        transition: opacity 1s ease-out;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Template.Index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views\profile\partials\update-profile-information-form.blade.php ENDPATH**/ ?>