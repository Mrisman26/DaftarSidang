<?php $__env->startSection('title', 'Edit Pendaftaran | SIPASTA'); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">


        <!-- Begin Page Content -->
        <div class="container">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Daftar Edit Pendaftar</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('sidang-registrations.update', $sidangRegistration->id)); ?>" method="POST"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        
                        <div class="form-group">
                            <label for="judul">Judul Sidang</label>
                            <input type="text" name="judul_tugas_akhir" id="judul_tugas_akhir" class="form-control"
                                value="<?php echo e(old('judul_tugas_akhir', $sidangRegistration->judul_tugas_akhir)); ?>" required>
                        </div>

                        <hr>

                        
                        <div class="form-group">
                            <label for="pembimbing_id">Pilih Dosen Pembimbing</label>
                            <select name="pembimbing_id" id="pembimbing_id" class="form-control" required>
                                <option value="">-- Pilih Dosen Pembimbing --</option>
                                <?php $__currentLoopData = $dosen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($d->id); ?>" <?php if($d->id == $sidangRegistration->pembimbing_id): ?> selected
                                    <?php endif; ?>>
                                    <?php echo e($d->name); ?>

                                    (<?php echo e($d->sidangRegistration->prodi->nama ?? '-'); ?>)
                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>


                        
                        <h4>Upload Berkas Syarat</h4>

                        <?php $__currentLoopData = $jenisBerkas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        $berkas = $sidangRegistration->berkasSyarat->where('jenis_berkas', $jenis)->first();
                        ?>

                        <div class="form-group mb-3">
                            <label for="<?php echo e($jenis); ?>"><?php echo e(ucfirst(str_replace('_', ' ', $jenis))); ?></label>

                            
                            <?php if($berkas): ?>
                            <p>
                                <a href="<?php echo e(asset('storage/' . $berkas->file_path)); ?>" target="_blank">
                                    Lihat <?php echo e(ucfirst(str_replace('_', ' ', $jenis))); ?> Lama
                                </a>
                            </p>
                            <?php endif; ?>

                            
                            <input type="file" name="<?php echo e($jenis); ?>" id="<?php echo e($jenis); ?>" class="form-control">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah berkas ini.</small>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        
                        <div class="d-flex justify-content-between">
                            <a href="<?php echo e(route('sidang-registrations.index')); ?>" class="btn btn-secondary"><i
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
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Template.Index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views\sidang_registrations\edit.blade.php ENDPATH**/ ?>