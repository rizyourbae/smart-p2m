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
        Schema::create('proposal_outcomes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposal_id')->constrained()->cascadeOnDelete();
            $table->string('jenis_outcomes'); // 'Artikel' atau 'Buku'
            $table->string('judul_outcomes'); // Akan kita gunakan untuk Judul Artikel & Nama Buku
            // Kolom khusus Artikel
            $table->string('nama_jurnal_fix')->nullable();
            $table->string('volume_jurnal_fix')->nullable();
            $table->string('link_jurnal_fix')->nullable();
            // Kolom khusus Buku
            $table->string('nomor_isbn_fix')->nullable();
            $table->string('penerbit_buku')->nullable();
            $table->string('tahun_terbit_buku')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal_outcomes');
    }
};
