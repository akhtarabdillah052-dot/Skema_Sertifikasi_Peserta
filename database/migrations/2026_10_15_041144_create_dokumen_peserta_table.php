<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokumen_peserta', function (Blueprint $table) {
            $table->id();

            $table->foreignId('peserta_id')
                ->unique()
                ->constrained('pesertas')
                ->cascadeOnDelete();

            $table->string('ktp_path')->nullable();
            $table->string('ijazah_path')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumen_peserta');
    }
};
