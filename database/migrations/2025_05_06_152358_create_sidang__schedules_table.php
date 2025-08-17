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
        Schema::create('sidang_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sidang_registration_id')->constrained()->onDelete('cascade');
            $table->date('tanggal_sidang');
            $table->time('jam_mulai')->nullable();
            $table->time('jam_selesai')->nullable();
            $table->foreignId('ruangan_id')->nullable()->constrained('ruangans')->onDelete('set null');
            $table->foreignId('pembimbing_id')->constrained('users'); // dosen pembimbing
            $table->foreignId('penguji_id_1')->constrained('users');
            $table->foreignId('penguji_id_2')->nullable()->constrained('users');
            $table->foreignId('penguji_id_3')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sidang__schedules');
    }
};
