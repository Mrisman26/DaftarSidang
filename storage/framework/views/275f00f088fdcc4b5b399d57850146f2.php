<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex flex-column align-items-center justify-content-center text-center py-4 mt-5"
        href="<?php echo e(route('dashboard')); ?>">
        <div class="sidebar-brand-icon">
            <?php
            $role = auth()->user()->roles->pluck('name')->first();
            ?>

            <?php switch($role):
            case ('Admin'): ?>
            <i class="fas fa-user-shield fa-3x"></i> <!-- Icon admin -->
            <?php break; ?>
            <?php case ('Dosen'): ?>
            <i class="fas fa-chalkboard-teacher fa-3x"></i> <!-- Icon dosen -->
            <?php break; ?>
            <?php case ('Mahasiswa'): ?>
            <i class="fas fa-user-graduate fa-3x"></i> <!-- Icon mahasiswa -->
            <?php break; ?>
            <?php default: ?>
            <i class="fas fa-user-tag fa-3x"></i> <!-- Default icon -->
            <?php endswitch; ?>
        </div>

        <div class="sidebar-brand-text font-weight-bold mt-2 text-uppercase">
            SIPASTA
        </div>
        <div class="sidebar-brand-text small">
            <span class="d-block">Sistem Pendaftaran Sidang Tugas Akhir</span>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0 mt-5">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?php echo e(route('dashboard')); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider">

    
    <?php if (\Illuminate\Support\Facades\Blade::check('hasanyrole', 'Admin')): ?>
    <!-- Heading -->
    <div class="sidebar-heading">
        Master Data
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaster" aria-expanded="true"
            aria-controls="collapseMaster">
            <i class="fas fa-database"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseMaster" class="collapse" aria-labelledby="headingMaster" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?php echo e(route('mahasiswa.index')); ?>">
                    <i class="fas fa-user-graduate"></i> Mahasiswa
                </a>
                <a class="collapse-item" href="<?php echo e(route('dosen.index')); ?>">
                    <i class="fas fa-chalkboard-teacher"></i> Dosen
                </a>
                <a class="collapse-item" href="<?php echo e(route('prodi.index')); ?>">
                    <i class="fas fa-university"></i> Prodi
                </a>
                <a class="collapse-item" href="<?php echo e(route('ruangan.index')); ?>">
                    <i class="fas fa-door-open"></i> Ruangan
                </a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSidang" aria-expanded="true"
            aria-controls="collapseSidang">
            <i class="fas fa-calendar-check"></i>
            <span>Manajemen Sidang</span>
        </a>
        <div id="collapseSidang" class="collapse" aria-labelledby="headingSidang" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?php echo e(route('sidang-registrations.index')); ?>">
                    <i class="fas fa-file-signature"></i> Pendaftar Sidang
                </a>
                <a class="collapse-item" href="<?php echo e(route('sidang-schedules.index')); ?>">
                    <i class="fas fa-calendar-alt"></i> Jadwal Sidang
                </a>
                <a class="collapse-item" href="<?php echo e(route('periode_sidang.index')); ?>">
                    <i class="fas fa-clock"></i> Periode Sidang
                </a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">
    <?php endif; ?>

    
    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Kaprodi')): ?>
    <div class="sidebar-heading">
        Kaprodi
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKaprodi"
            aria-expanded="true" aria-controls="collapseKaprodi">
            <i class="fas fa-calendar"></i>
            <span>Sidang</span>
        </a>
        <div id="collapseKaprodi" class="collapse" aria-labelledby="headingKaprodi" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?php echo e(route('sidang-registrations.index')); ?>">
                    <i class="fas fa-file-signature"></i> Pendaftar Sidang
                </a>
                <a class="collapse-item" href="<?php echo e(route('sidang-schedules.index')); ?>">
                    <i class="fas fa-calendar-alt"></i> Jadwal Sidang
                </a>
                <a class="collapse-item" href="<?php echo e(route('sidang_values.index')); ?>">
                    <i class="fas fa-clipboard-check"></i> Nilai Sidang
                </a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <?php endif; ?>

    
    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Mahasiswa')): ?>
    <div class="sidebar-heading">
        Mahasiswa
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMahasiswa"
            aria-expanded="true" aria-controls="collapseMahasiswa">
            <i class="fas fa-book"></i>
            <span>Sidang</span>
        </a>
        <div id="collapseMahasiswa" class="collapse" aria-labelledby="headingMahasiswa" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?php echo e(route('sidang-registrations.index')); ?>">
                    <i class="fas fa-file-signature"></i> Pendaftaran
                </a>
                <a class="collapse-item" href="<?php echo e(route('sidang-schedules.index')); ?>">
                    <i class="fas fa-calendar-alt"></i> Jadwal Sidang
                </a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <?php endif; ?>

    
    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Dosen')): ?>
    <div class="sidebar-heading">
        Dosen
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDosen" aria-expanded="true"
            aria-controls="collapseDosen">
            <i class="fas fa-clipboard-list"></i>
            <span>Sidang</span>
        </a>
        <div id="collapseDosen" class="collapse" aria-labelledby="headingDosen" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?php echo e(route('sidang-schedules.index')); ?>">
                    <i class="fas fa-calendar-alt"></i> Jadwal Sidang
                </a>
                <a class="collapse-item" href="<?php echo e(route('sidang_values.index')); ?>">
                    <i class="fas fa-clipboard-check"></i> Nilai Sidang
                </a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <?php endif; ?>

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views\Template\Sidebar.blade.php ENDPATH**/ ?>