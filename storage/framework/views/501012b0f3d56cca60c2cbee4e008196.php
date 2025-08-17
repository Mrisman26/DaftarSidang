<?php $__env->startSection('title', 'Form Pendaftaran TA | SIPASTA'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-6">
    <h3 class="text-2xl font-semibold mb-6">Form Pendaftaran Sidang Tugas Akhir</h3>

    <?php if(session('success')): ?>
    <div class="alert alert-success mb-4"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if($periode): ?>
    <div class="alert alert-info">
        Pendaftaran dibuka untuk: <strong><?php echo e($periode->nama_periode); ?></strong>
        (<?php echo e(\Carbon\Carbon::parse($periode->tanggal_mulai)->translatedFormat('d F Y')); ?> s.d.
        <?php echo e(\Carbon\Carbon::parse($periode->tanggal_selesai)->translatedFormat('d F Y')); ?>)
    </div>
    <?php endif; ?>

    <?php if($periode): ?>
    <p>Periode Aktif: <strong><?php echo e($periode->nama_periode); ?></strong></p>
    <?php endif; ?>


    <form action="<?php echo e(route('sidang-registrations.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        
        <div class="card shadow-lg mb-3">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Data Mahasiswa</h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <label class="form-label text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" class="form-control" value="<?php echo e(auth()->user()->name); ?>" disabled>
                </div>

                <div class="mb-4">
                    <label class="form-label text-sm font-medium text-gray-700">NIM</label>
                    <input type="text" class="form-control" value="<?php echo e(auth()->user()->mahasiswaProfile->nim); ?>"
                        disabled>
                </div>

                <?php
                $user = auth()->user();
                $isMahasiswa = $user->hasRole('Mahasiswa');
                $isDosen = $user->hasRole('Dosen');

                // Ambil nama prodi + jenjang dari relasi yang sesuai
                $prodiNama = '';
                $prodiJenjang = '';

                if ($isMahasiswa && $user->mahasiswaProfile && $user->mahasiswaProfile->prodi) {
                $prodiNama = $user->mahasiswaProfile->prodi->nama_prodi;
                $prodiJenjang = $user->mahasiswaProfile->prodi->jenjang;
                } elseif ($isDosen && $user->dosenProfile && $user->dosenProfile->prodi) {
                $prodiNama = $user->dosenProfile->prodi->nama_prodi;
                $prodiJenjang = $user->dosenProfile->prodi->jenjang;
                }
                ?>

                <?php if($prodiNama): ?>
                <div class="mb-4">
                    <label class="form-label text-sm font-medium text-gray-700">Program Studi</label>
                    <input type="text" class="form-control" value="<?php echo e($prodiNama); ?> (<?php echo e($prodiJenjang); ?>)" disabled>
                </div>
                <?php endif; ?>

            </div>
        </div>

        
        <div class="card shadow-lg mb-3">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Judul Tugas Akhir</h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <label class="form-label text-sm font-medium text-gray-700">Judul Tugas Akhir</label>
                    <input type="text" name="judul_tugas_akhir" class="form-control"
                        value="<?php echo e(old('judul_tugas_akhir')); ?>" required>
                    <?php $__errorArgs = ['judul_tugas_akhir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger mt-1 text-sm"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        
        <div class="card shadow-lg mb-3">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Pilih Dosen Pembimbing</h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <label for="pembimbing_id">Pilih Dosen Pembimbing</label>
                    <select name="pembimbing_id" id="pembimbing_id" class="form-control" required>
                        <option value="">-- Pilih Dosen Pembimbing --</option>
                        <?php $__currentLoopData = $dosen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($d->id); ?>">
                            <?php echo e($d->name); ?>

                            (<?php echo e($d->dosenProfile->prodi->nama_prodi ?? '-'); ?>)
                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </div>

        
        <div class="card shadow-lg mb-3">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Upload Berkas Persyaratan</h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <label class="form-label text-sm font-medium text-gray-700">Proposal Tugas Akhir (PDF)</label>
                    <input type="file" name="proposal" class="form-control" accept=".pdf" required>
                </div>

                <div class="mb-4">
                    <label class="form-label text-sm font-medium text-gray-700">Transkrip Nilai (PDF)</label>
                    <input type="file" name="transkrip" class="form-control" accept=".pdf" required>
                </div>

                <div class="mb-4">
                    <label class="form-label text-sm font-medium text-gray-700">Kartu Bimbingan (PDF)</label>
                    <input type="file" name="kartu_bimbingan" class="form-control" accept=".pdf" required>
                </div>
            </div>
        </div>

        
        <div class="d-flex justify-content-between">
            <a href="<?php echo e(route('sidang-registrations.index')); ?>" class="btn btn-secondary"><i
                    class="fas fa-arrow-left mr-1"></i>Kembali</a>
            <button type="submit"
                class="btn btn-primary px-6 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Daftar Sidang
            </button>
        </div>

    </form>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Template.Index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views/sidang_registrations/create.blade.php ENDPATH**/ ?>