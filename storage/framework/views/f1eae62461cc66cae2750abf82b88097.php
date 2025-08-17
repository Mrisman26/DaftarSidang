<?php $__env->startSection('title', 'Detail Dosen | SIPASTA'); ?>

<?php $__env->startSection('content'); ?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container">
            <!-- Judul Halaman -->
            

            <!-- Card Detail Mahasiswa -->
            <div class="card mt-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="m-0"></h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Kolom Kiri: Foto Mahasiswa -->
                        <div class="col-md-4 text-center">

                        </div>

                        <!-- Kolom Kanan: Detail Mahasiswa -->
                        <div class="col-md-8 ">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Nama</th>
                                        <td><?php echo e($dosen->name); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?php echo e($dosen->email); ?></td>
                                    </tr>
                                    <tr>
                                        <th>NIDN</th>
                                        <td><?php echo e($dosen->profile ? $dosen->dosenProfile->nidn : 'N/A'); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Program Studi</th>
                                        <td><?php echo e($dosen->profile ? $dosen->dosenProfile->prodi->nama_prodi : 'N/A'); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Dosen</th>
                                        <td>
                                        <?php if($dosen->dosenProfile?->is_pembimbing): ?>
                                            <span class="badge bg-info text-white">Pembimbing</span>
                                        <?php endif; ?>
                                        <?php if($dosen->dosenProfile?->is_penguji): ?>
                                            <span class="badge bg-success text-dark">Penguji</span>
                                        <?php endif; ?>
                                        <?php if(!$dosen->dosenProfile?->is_pembimbing && !$dosen->dosenProfile?->is_penguji): ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    </tr>
                                    <tr>
                                        <th>Nomor HP</th>
                                        <td><?php echo e($dosen->profile ? $dosen->profile->no_hp : 'N/A'); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td><?php echo e($dosen->profile ? $dosen->profile->alamat : 'N/A'); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Kembali -->
            <div class="mt-4 text-center">
                <a href="<?php echo e(route('dosen.index')); ?>" class="btn btn-primary">Kembali ke Daftar Dosen</a>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: "Yakin ingin menghapus?",
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Template.Index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views\dosen\show.blade.php ENDPATH**/ ?>