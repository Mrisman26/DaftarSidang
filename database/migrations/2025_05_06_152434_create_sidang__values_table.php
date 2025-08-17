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
        Schema::create('sidang_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sidang_schedule_id')->constrained()->onDelete('cascade');
            $table->foreignId('penguji_id')->constrained('users'); // dosen penguji
            $table->integer('nilai');
            $table->text('komentar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sidang__values');
    }
};
