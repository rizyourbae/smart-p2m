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
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('jenis'); // 'Artikel' atau 'Buku'
            $table->string('judul'); // Akan kita gunakan untuk Judul Artikel & Nama Buku
            $table->string('penulis')->nullable();
            // Kolom khusus Artikel
            $table->string('nama_jurnal')->nullable();
            // Kolom khusus Buku
            $table->string('nomor_ISBN')->nullable();
            $table->string('penerbit')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
