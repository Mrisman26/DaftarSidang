<?php
    $warna = match($status) {
        'pending' => 'warning text-dark',
        'diterima' => 'success text-white',
        'ditolak' => 'danger text-white',
        default => 'secondary text-white',
    };
?>

<span class="badge bg-<?php echo e($warna); ?>">
    <?php echo e(ucfirst($status)); ?>

</span>
<?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views\partials\status.blade.php ENDPATH**/ ?>