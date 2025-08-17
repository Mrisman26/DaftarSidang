<?php $__env->startSection('title', 'Verifikasi | SIPASTA'); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">Verifikasi Pendaftaran</div>
                <div class="card-body ">

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


                    <form action="<?php echo e(route('sidang.update', $sidangRegistration->id)); ?>" method="POST"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <!-- Pilih Status Verifikasi -->
                        <div class="form-group">
                            <label for="status_verifikasi">Status Verifikasi</label>
                            <select name="status_verifikasi" class="form-control" id="status_verifikasi" required>
                                <option value="pending"
                                    <?php echo e($sidangRegistration->status_verifikasi == 'pending' ? 'selected' : ''); ?>>Pending
                                </option>
                                <option value="diterima"
                                    <?php echo e($sidangRegistration->status_verifikasi == 'diterima' ? 'selected' : ''); ?>>
                                    Diterima
                                </option>
                                <option value="ditolak"
                                    <?php echo e($sidangRegistration->status_verifikasi == 'ditolak' ? 'selected' : ''); ?>>Ditolak
                                </option>
                            </select>
                        </div>

                        <!-- Form Tambahan untuk Diterima -->
                        <div id="sidang-details" style="display: none;">
                            <div class="form-group">
                                <label for="pembimbing_id">Dosen Pembimbing</label>
                                <input type="text" class="form-control" readonly
                                    value="<?php echo e($sidangRegistration->pembimbing->name ?? '-'); ?>">
                                <input type="hidden" name="pembimbing_id"
                                    value="<?php echo e($sidangRegistration->pembimbing_id); ?>">
                            </div>
                            <div class="form-group">
                                <label for="penguji_id">Dosen Penguji</label>
                                <select name="penguji_id" class="form-control">
                                    <?php $__currentLoopData = $dosen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dosenItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($dosenItem->id); ?>"
                                        <?php echo e($sidangSchedule && $sidangSchedule->penguji_id == $dosenItem->id ? 'selected' : ''); ?>>
                                        <?php echo e($dosenItem->name); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_sidang">Tanggal Sidang</label>
                                <input type="date" name="tanggal_sidang" id="tanggal_sidang" class="form-control"
                                    <?php if(request()->old('status_verifikasi') === 'diterima'): ?> required <?php endif; ?>
                                min="<?php echo e($startDate); ?>"
                                max="<?php echo e($endDate); ?>"
                                value="<?php echo e(old('tanggal_sidang', optional($sidangSchedule)->tanggal_sidang)); ?>">
                            </div>

                            <div class="form-group">
                                <label for="ruangan">Ruangan</label>
                                <input type="text" name="ruangan" class="form-control"
                                    value="<?php echo e($sidangSchedule ? $sidangSchedule->ruangan : ''); ?>">
                            </div>

                            <div class="form-group">
                                <label for="jam_mulai">Jam Mulai</label>
                                <input type="time" name="jam_mulai" id="jam_mulai" class="form-control"
                                    value="<?php echo e(old('jam_mulai', optional($sidangSchedule)->jam_mulai)); ?>">
                            </div>

                            <div class="form-group">
                                <label for="jam_selesai">Jam Selesai</label>
                                <input type="time" name="jam_selesai" id="jam_selesai" class="form-control"
                                    value="<?php echo e(old('jam_selesai', optional($sidangSchedule)->jam_selesai)); ?>">
                            </div>


                        </div>

                        <div class="form-group">
                            <label for="catatan_admin">Catatan Admin</label>
                            <textarea name="catatan_admin" class="form-control" rows="3"
                                required><?php echo e(old('catatan_admin', $sidangRegistration->catatan_admin)); ?></textarea>
                        </div>

                        <!-- Tombol Kembali & Update -->
                        <div class="d-flex justify-content-between">
                            <a href="<?php echo e(route('sidang-registrations.index')); ?>" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i>Kembali</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

</div>

<!-- Script untuk Menampilkan Form Tambahan ketika Status Diterima -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var statusSelect = document.getElementById('status_verifikasi');
        var sidangDetails = document.getElementById('sidang-details');
        // var pembimbingSelect = document.querySelector('select[name="pembimbing_id"]');
        var pengujiSelect = document.querySelector('select[name="penguji_id"]');

        // Cek status yang dipilih pada halaman load
        if (statusSelect.value === 'diterima') {
            sidangDetails.style.display = 'block';
            pengujiSelect.disabled = false;
        } else {
            sidangDetails.style.display = 'none';
            pengujiSelect.disabled = true;
        }

        // Event listener ketika status verifikasi berubah
        statusSelect.addEventListener('change', function () {
            if (statusSelect.value === 'diterima') {
                sidangDetails.style.display = 'block';
                pengujiSelect.disabled = false;
            } else {
                sidangDetails.style.display = 'none';
                pengujiSelect.disabled = true;
            }
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Template.Index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views\sidang_registrations\verifikasi.blade.php ENDPATH**/ ?>