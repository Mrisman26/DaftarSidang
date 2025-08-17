<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\JadwalSidangController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PeriodeSidangController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SidangAdminController;
use App\Http\Controllers\SidangDosenController;
use App\Http\Controllers\SidangRegistrationController;
use App\Http\Controllers\SidangScheduleController;
use App\Http\Controllers\SidangValueController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

// ===== Mahasiswa =====
// Route::middleware(['auth', 'role:Mahasiswa|Admin'])->group(function() {
//     Route::resource('sidang-registrations', SidangRegistrationController::class);


//     Route::get('sidang-registrations/verifikasi/{sidangRegistration}', [SidangRegistrationController::class, 'verifikasi'])->name('sidang.verifikasi');

//     Route::put('sidang-registrations/verifikasi/{sidangRegistration}', [SidangRegistrationController::class, 'updateverifikasi'])->name('sidang.update');


// });

// ===== Admin =====
// Route::middleware(['auth', 'role:Admin'])->group(function() {
//     Route::resource('mahasiswa', MahasiswaController::class);

//     Route::resource('dosen', DosenController::class);

//     Route::resource('periode_sidang', PeriodeSidangController::class);
// });


// ===== Dosen =====
// Route::middleware(['auth', 'role:Dosen'])->group(function() {

//     Route::resource('sidang_values', SidangValueController::class);
// });

// Route::middleware(['auth', 'role:Admin|Dosen|Mahasiswa'])->group(function() {

//     Route::resource('sidang-schedule', SidangScheduleController::class);

//     Route::resource('sidang_values', SidangValueController::class);


// });

// ===== MAHASISWA =====
Route::middleware(['auth', 'role:Mahasiswa|Kaprodi|Admin'])->group(function () {
    Route::resource('sidang-registrations', SidangRegistrationController::class);

    Route::get('sidang-registrations/verifikasi/{sidangRegistration}', [SidangRegistrationController::class, 'verifikasi'])
        ->name('sidang.verifikasi')
        ->middleware('role:Admin|Kaprodi');

    Route::put('sidang-registrations/verifikasi/{sidangRegistration}', [SidangRegistrationController::class, 'updateverifikasi'])
        ->name('sidang.update')
        ->middleware('role:Admin|Kaprodi');
});

// ===== ADMIN =====
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('dosen', DosenController::class);
    Route::resource('prodi', ProdiController::class);
    Route::resource('ruangan', RuanganController::class);

});

// ===== ADMIN & KAPRODI =====
Route::middleware(['auth', 'role:Admin|Kaprodi'])->group(function () {
    Route::resource('periode_sidang', PeriodeSidangController::class);

    // Verifikasi pendaftaran sidang dipindah ke sini agar hanya Admin/Kaprodi yang bisa
    Route::get('sidang-registrations/verifikasi/{sidangRegistration}', [SidangRegistrationController::class, 'verifikasi'])->name('sidang.verifikasi');
    Route::put('sidang-registrations/verifikasi/{sidangRegistration}', [SidangRegistrationController::class, 'updateverifikasi'])->name('sidang.update');
});

// ===== DOSEN PENGUJI =====
Route::middleware(['auth', 'role:Dosen||Kaprodi'])->group(function () {
    Route::resource('sidang_values', SidangValueController::class);
});

// ===== SEMUA YANG TERLIBAT =====
Route::middleware(['auth', 'role:Admin|Kaprodi|Dosen|Mahasiswa'])->group(function () {
    Route::resource('sidang-schedules', SidangScheduleController::class);
});

// Admin
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('sidang/verifikasi-admin/{sidangRegistration}', [SidangRegistrationController::class, 'verifikasiAdmin'])->name('sidang.verifikasi.admin');
    Route::put('sidang/verifikasi-admin/{sidangRegistration}', [SidangRegistrationController::class, 'updateVerifikasiAdmin'])->name('sidang.update.admin');
});

// Kaprodi
Route::middleware(['auth', 'role:Kaprodi'])->group(function () {
    Route::get('sidang/verifikasi-kaprodi/{sidangRegistration}', [SidangRegistrationController::class, 'verifikasiKaprodi'])->name('sidang.verifikasi.kaprodi');
    Route::put('sidang/verifikasi-kaprodi/{sidangRegistration}', [SidangRegistrationController::class, 'updateVerifikasiKaprodi'])->name('sidang.update.kaprodi');

    // Route::resource('sidang-schedules', SidangScheduleController::class);
});

Route::get('/sidang_schedules/{sidang_schedule}/daftar-hadir', [SidangScheduleController::class, 'printDaftarHadir'])->name('sidang_schedules.daftar_hadir');

Route::get('/sidang_schedules/{sidang_schedule}/berita-acara', [SidangScheduleController::class, 'cetakBeritaAcara'])->name('sidang_schedules.berita_acara');




require __DIR__.'/auth.php';
