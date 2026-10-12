<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('pesertas', function (Blueprint $table) {
        $table->id();
        
        // Tambahkan kolom-kolom berikut:
        $table->unsignedBigInteger('skema_id'); 
        $table->string('nama_peserta');
        $table->text('alamat');
        $table->string('no_hp');
        $table->string('email')->unique();
        
        $table->timestamps();

        // (Opsional) Jika ingin menambahkan foreign key constraint ke tabel skema:
        // $table->foreign('skema_id')->references('id')->on('skema_sertifikasis')->onDelete('cascade');
    });
}

    public function down(): void
    {
        Schema::dropIfExists('pesertas');
    }
};
