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
        Schema::create('berkas_syarats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sidang_registration_id')->constrained()->onDelete('cascade');
            $table->string('jenis_berkas'); // laporan TA, lembar pengesahan, bukti bebas pustaka, dll
            $table->string('file_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas__syarats');
    }
};
