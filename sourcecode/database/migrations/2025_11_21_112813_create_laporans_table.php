<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('laporans', function (Blueprint $table) { // Ubah jadi laporans
        $table->id();
        // Pastikan ini mengarah ke tabel 'userrs' sesuai setup user kamu sebelumnya
        $table->foreignId('user_id')->constrained('userrs')->onDelete('cascade'); 
        
        $table->string('nama'); // Nama Pelapor (Snapshot saat lapor)
        $table->string('fakultas'); // Tambahan kolom Fakultas
        $table->text('isi'); // Saya ganti 'description' jadi 'isi' agar sesuai view
        
        // Status: pending, proses, selesai
        $table->enum('status', ['pending','proses','selesai'])->default('pending');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('laporans');
}
};
