<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sidang_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Mahasiswa
            $table->string('judul_tugas_akhir')->nullable();
            $table->enum('verifikasi_admin', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->enum('verifikasi_kaprodi', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->text('catatan_admin')->nullable(); // Jika ditolak/ada revisi
            $table->text('catatan_kaprodi')->nullable();
            $table->foreignId('pembimbing_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('periode_sidang_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sidang__registrations');
    }
};
