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
        Schema::create('periode_sidangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prodi_id')->constrained()->onDelete('cascade');
            $table->string('nama_periode'); // Contoh: "Periode Mei 2025"
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('is_aktif', ['Akan Datang', 'Aktif', 'Selesai'])->default('Akan Datang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periode_sidangs');
    }
};
