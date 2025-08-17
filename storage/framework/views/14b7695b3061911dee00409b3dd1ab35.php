<?php $__env->startSection('title', 'Create Jadwal Sidang | SIPASTA'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tambah Jadwal Sidang</h5>
        </div>
        <div class="card-body">

            <?php if($errors->has('peran')): ?>
            <div class="alert alert-danger">
                <?php echo e($errors->first('peran')); ?>

            </div>
            <?php endif; ?>

            <?php
            $pendaftarData = $pendaftar->mapWithKeys(function($p) {
            return [$p->id => ['pembimbing_id' => $p->pembimbing_id, 'pembimbing_nama' => $p->pembimbing->name ?? '']];
            });
            ?>
            <script>
                const pendaftarMap = <?php echo json_encode($pendaftarData, 15, 512) ?>;

                function setPembimbing(val) {
                    const pembimbing = pendaftarMap[val];
                    document.getElementById('pembimbing_name').value = pembimbing ? pembimbing.pembimbing_nama : '';
                    document.getElementById('pembimbing_id').value = pembimbing ? pembimbing.pembimbing_id : '';
                }
            </script>


            <form action="<?php echo e(route('sidang-schedules.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="mb-3">
                    <label for="sidang_registration_id">Mahasiswa</label>
                    <select name="sidang_registration_id" class="form-control" onchange="setPembimbing(this.value)"
                        required>
                        <option value="">-- Pilih Mahasiswa --</option>
                        <?php $__currentLoopData = $pendaftar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($p->id); ?>"><?php echo e($p->user->name); ?> - <?php echo e($p->judul_tugas_akhir); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                </div>

                <div class="mb-3">
                    <label for="tanggal_sidang">Tanggal</label>
                    <input type="date" name="tanggal_sidang" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="jam_mulai">Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="jam_selesai">Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="ruangan_id" class="form-label">Ruangan Sidang</label>
                    <select name="ruangan_id" id="ruangan_id" class="form-control" required>
                        <option value="">-- Pilih Ruangan --</option>
                        <?php $__currentLoopData = $ruangans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ruangan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($ruangan->id); ?>"><?php echo e($ruangan->kode_ruangan); ?> - <?php echo e($ruangan->nama_ruangan); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="pembimbing_name">Dosen Pembimbing</label>
                    <input type="text" id="pembimbing_name" class="form-control" disabled>
                    <input type="hidden" name="pembimbing_id" id="pembimbing_id">
                </div>

                <div class="mb-3">
                    <label for="penguji_id_1">Penguji 1</label>
                    <select name="penguji_id_1" class="form-control" required>
                        <option value="">-- Pilih Penguji 1 --</option>
                        <?php $__currentLoopData = $pengujis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dosen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($dosen->id); ?>"><?php echo e($dosen->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="penguji_id_2">Penguji 2</label>
                    <select name="penguji_id_2" class="form-control">
                        <option value="">-- Pilih Penguji 2 --</option>
                        <?php $__currentLoopData = $pengujis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dosen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($dosen->id); ?>"><?php echo e($dosen->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="penguji_id_3">Penguji 3</label>
                    <select name="penguji_id_3" class="form-control">
                        <option value="">-- Pilih Penguji 3 --</option>
                        <?php $__currentLoopData = $pengujis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dosen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($dosen->id); ?>"><?php echo e($dosen->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>



                <button class="btn btn-primary">Simpan Jadwal</button>
                <a href="<?php echo e(route('sidang-schedules.index')); ?>" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Template.Index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views\sidang_schedules\create.blade.php ENDPATH**/ ?>