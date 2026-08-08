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
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            // Kategori penting untuk membedakan 'Lelayu' dan 'Pengumuman Biasa'
            $table->enum('kategori', ['Berita', 'Pengumuman', 'Lelayu'])->default('Berita');
            $table->text('konten');
            $table->string('gambar')->nullable(); // Opsional jika berita ada gambarnya
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relasi ke admin pembuat
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
