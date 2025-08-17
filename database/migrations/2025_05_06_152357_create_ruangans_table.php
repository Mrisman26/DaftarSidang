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
        Schema::create('ruangans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_ruangan')->unique(); // Contoh: R101
            $table->string('nama_ruangan');           // Contoh: Ruang Sidang A
            $table->unsignedBigInteger('prodi_id')->nullable(); // Nullable: bisa umum
            $table->timestamps();

            // Foreign Key ke tabel prodis (jika ada relasi prodi)
            $table->foreign('prodi_id')->references('id')->on('prodis')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruangans');
    }
};
