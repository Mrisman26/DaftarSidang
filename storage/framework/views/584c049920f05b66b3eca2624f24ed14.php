<?php $__env->startSection('title', 'Sidang Value | SIPASTA'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tambah Nilai</h5>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('sidang_values.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="form-group mb-3">
                    <label for="sidang_schedule_id">Pilih Jadwal Sidang</label>
                    <select name="sidang_schedule_id" id="sidang_schedule_id" class="form-control" required>
                        <option value="">-- Pilih Jadwal --</option>
                        <?php $__currentLoopData = $jadwalSidangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jadwal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        $tanggal = \Carbon\Carbon::parse($jadwal->tanggal_sidang)->translatedFormat('d F Y');
                        $ruangan = $jadwal->ruangan->nama_ruangan ?? '-';
                        $mahasiswa = $jadwal->sidangRegistration?->user?->name ?? '-';
                        $pengujiList = [
                        $jadwal->penguji1?->name ?? '-',
                        $jadwal->penguji2?->name ?? '-',
                        $jadwal->penguji3?->name ?? '-',
                        ];
                        $pengujiFormatted = implode(', ', $pengujiList);
                        $label = "{$tanggal} | Ruangan: {$ruangan} | Mahasiswa: {$mahasiswa} | Penguji:
                        {$pengujiFormatted}";
                        ?>
                        <option value="<?php echo e($jadwal->id); ?>"><?php echo e($label); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>


                <div class="form-group mb-3">
                    <label for="nilai">Nilai (0 - 100)</label>
                    <input type="number" name="nilai" id="nilai" class="form-control" min="0" max="100" required>
                </div>

                <div class="form-group mb-3">
                    <label for="komentar">Komentar (Opsional)</label>
                    <textarea name="komentar" id="komentar" class="form-control"></textarea>
                </div>

                
                <div class="d-flex justify-content-between">
                    <a href="<?php echo e(route('sidang_values.index')); ?>" class="btn btn-secondary"><i
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

<?php echo $__env->make('Template.Index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views\sidang_values\create.blade.php ENDPATH**/ ?>