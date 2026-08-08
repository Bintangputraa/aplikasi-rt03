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
        Schema::create('galeris', function (Blueprint $table) {
            $table->id();
            // Menghubungkan tabel ini dengan tabel albums
            $table->foreignId('album_id')->constrained('albums')->onDelete('cascade');
            $table->string('file_media'); // Berisi URL foto atau video
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeris');
    }
};
