<!-- resources/views/dashboard/mahasiswa.blade.php -->


<?php $__env->startSection('title', 'Dashboard | SIPASTA'); ?>

<?php $__env->startSection('content'); ?>

<div id="wrapper">
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">

            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Dashboard <?php echo e(Auth::user()->getRoleNames()->first()); ?> - SIPASTA</h1>

                <div class="row">

                    <!-- Card Informasi Profil -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow rounded-lg">
                            <div class="card-header bg-primary text-white">
                                <i class="fas fa-user"></i> Informasi Mahasiswa
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>Nama:</strong> <?php echo e(Auth::user()->name); ?></li>
                                    <li class="list-group-item"><strong>Email:</strong> <?php echo e(Auth::user()->email); ?></li>

                                    
                                    <?php if(Auth::user()->hasRole('Mahasiswa')): ?>
                                    <li class="list-group-item"><strong>NIM:</strong>
                                        <?php echo e(Auth::user()->mahasiswaProfile->nim ?? 'NIM tidak tersedia'); ?></li>
                                    <?php elseif(Auth::user()->hasRole('Dosen')): ?>
                                    <li class="list-group-item"><strong>NIDN:</strong>
                                        <?php echo e(Auth::user()->dosenProfile->nidn ?? 'NIDN tidak tersedia'); ?></li>
                                    <?php endif; ?>

                                    
                                    <li class="list-group-item"><strong>Program Studi:</strong>
                                        <?php echo e(Auth::user()->hasRole('Mahasiswa') ? Auth::user()->mahasiswaProfile->prodi->nama_prodi ?? 'Prodi tidak tersedia' : 'Tidak berlaku'); ?>

                                    </li>
                                    <li class="list-group-item"><strong>No. HP:</strong>
                                        <?php echo e(Auth::user()->hasRole('Mahasiswa') ? Auth::user()->profile->no_hp ?? 'No. HP tidak tersedia' : (Auth::user()->hasRole('Dosen') ? Auth::user()->dosenProfile->no_hp ?? 'No. HP tidak tersedia' : 'Tidak berlaku')); ?>

                                    </li>
                                    <li class="list-group-item"><strong>Alamat:</strong>
                                        <?php echo e(Auth::user()->hasRole('Mahasiswa') ? Auth::user()->profile->alamat ?? 'Alamat tidak tersedia' : (Auth::user()->hasRole('Dosen') ? Auth::user()->dosenProfile->alamat ?? 'Alamat tidak tersedia' : 'Tidak berlaku')); ?>

                                    </li>
                                </ul>

                                
                                <?php
                                $user = Auth::user();
                                $isMahasiswa = $user->hasRole('Mahasiswa');
                                $isDosen = $user->hasRole('Dosen');

                                $mahasiswaProfile = $user->mahasiswaProfile;
                                $dosenProfile = $user->dosenProfile;
                                $profile = $user->profile;

                                $nimOrNidn = $isMahasiswa ? ($mahasiswaProfile?->nim) : ($isDosen ?
                                ($dosenProfile?->nidn) : null);
                                $prodiId = $isMahasiswa ? ($mahasiswaProfile?->prodi_id) : ($isDosen ?
                                ($dosenProfile?->prodi_id) : null);
                                ?>

                                <?php if(empty($nimOrNidn) || empty($prodiId) || empty($profile?->no_hp) ||
                                empty($profile?->alamat)): ?>
                                <div class="alert alert-warning mt-3" role="alert">
                                    <strong>Perhatian!</strong> Profil Anda belum lengkap. Silakan lengkapi data
                                    <?php echo e($isMahasiswa ? 'NIM' : 'NIDN'); ?>,
                                    Program Studi, No. HP, dan Alamat pada halaman <a
                                        href="<?php echo e(route('profile.edit')); ?>">Profil Saya</a>.
                                </div>
                                <?php endif; ?>

                            </div>

                        </div>
                    </div>

                    <!-- Card Status Sidang -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow rounded-lg">
                            <div class="card-header bg-warning text-white">
                                <i class="fas fa-file-alt"></i> Status Pendaftaran Sidang
                            </div>
                            <div class="card-body">
                                <?php if($sidangRegistration && $sidangRegistration->sidangSchedule): ?>
                                <div class="mt-2">
                                    <h5 class="card-title text-primary">Jadwal Sidang</h5>
                                    <ul class="list-group">

                                        <div class="row">
                                            
                                            <div class="col-md-6">
                                                <strong>Admin:</strong>
                                                <?php if($sidangRegistration->verifikasi_admin == 'pending'): ?>
                                                <span class="badge bg-warning text-dark">Pending</span>
                                                <?php elseif($sidangRegistration->verifikasi_admin == 'diterima'): ?>
                                                <span class="badge bg-success text-white">Diterima</span>
                                                <?php elseif($sidangRegistration->verifikasi_admin == 'ditolak'): ?>
                                                <span class="badge bg-danger text-white">Ditolak</span>
                                                <?php else: ?>
                                                <span class="badge bg-secondary">-</span>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <strong>Kaprodi:</strong>
                                                <?php if($sidangRegistration->verifikasi_kaprodi == 'pending'): ?>
                                                <span class="badge bg-warning text-dark">Pending</span>
                                                <?php elseif($sidangRegistration->verifikasi_kaprodi == 'diterima'): ?>
                                                <span class="badge bg-success text-white">Diterima</span>
                                                <?php elseif($sidangRegistration->verifikasi_kaprodi == 'ditolak'): ?>
                                                <span class="badge bg-danger text-white">Ditolak</span>
                                                <?php else: ?>
                                                <span class="badge bg-secondary">-</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>


                                        
                                        <li class="list-group-item">
                                            <strong>Tanggal Sidang:</strong>
                                            <?php echo e(\Carbon\Carbon::parse($sidangRegistration->sidangSchedule->tanggal_sidang)->translatedFormat('d F Y')); ?>

                                        </li>

                                        
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <strong>Ruangan:</strong>
                                                    <?php echo e($sidangRegistration->sidangSchedule->ruangan->nama_ruangan ?? 'Belum ditentukan'); ?>

                                                </div>
                                                <div class="col-md-6">
                                                    <strong>Ruangan:</strong>
                                                    <?php echo e($sidangRegistration->sidangSchedule->ruangan->kode_ruangan ?? 'Belum ditentukan'); ?>

                                                </div>
                                            </div>
                                        </li>

                                        
                                        <li class="list-group-item">
                                            <strong>Pembimbing:</strong>
                                            <?php echo e($sidangRegistration->pembimbing->name ?? 'Belum ditentukan'); ?>

                                        </li>

                                        
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <strong>Penguji 1:</strong>
                                                    <?php echo e($sidangRegistration->sidangSchedule->penguji1->name ?? 'Belum ditentukan'); ?>

                                                </div>
                                                <div class="col-md-4">
                                                    <strong>Penguji 2:</strong>
                                                    <?php echo e($sidangRegistration->sidangSchedule->penguji2->name ?? 'Belum ditentukan'); ?>

                                                </div>
                                                <div class="col-md-4">
                                                    <strong>Penguji 3:</strong>
                                                    <?php echo e($sidangRegistration->sidangSchedule->penguji3->name ?? 'Belum ditentukan'); ?>

                                                </div>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                                <?php else: ?>
                                <p class="mt-3">Jadwal sidang belum ditentukan.</p>
                                <?php endif; ?>
                            </div>


                        </div>
                    </div>

                </div>

            </div><!-- /.container-fluid -->

        </div><!-- End of Main Content -->
    </div><!-- End of Content Wrapper -->
</div><!-- End of Page Wrapper -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Template.Index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views\dashboard\mahasiswa.blade.php ENDPATH**/ ?>