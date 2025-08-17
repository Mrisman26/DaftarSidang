 

<?php $__env->startSection('title', 'Profile | SIPASTA'); ?>

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
                            <h6 class="m-0 font-weight-bold">Update Profile Information</h6>
                        </div>
                        <div class="card-body">
                            <?php echo $__env->make('profile.partials.update-profile-information-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                    </div>

                    <!-- Update Password -->
                    <div class="card shadow-sm mb-4 border-left-warning">
                        <div class="card-header bg-warning text-white">
                            <h6 class="m-0 font-weight-bold">Update Password</h6>
                        </div>
                        <div class="card-body">
                            <?php echo $__env->make('profile.partials.update-password-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-lg-6">
                    <!-- Delete Account -->
                    <div class="card shadow-sm mb-4 border-left-danger">
                        <div class="card-header bg-danger text-white">
                            <h6 class="m-0 font-weight-bold">Delete Account</h6>
                        </div>
                        <div class="card-body">
                            <?php echo $__env->make('profile.partials.delete-user-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                    </div>

                    <!-- Informasi Tambahan -->
                    
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

<?php echo $__env->make('Template.Index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views/profile/edit.blade.php ENDPATH**/ ?>