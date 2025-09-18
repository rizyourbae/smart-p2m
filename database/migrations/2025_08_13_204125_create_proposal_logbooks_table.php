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
        Schema::create('proposal_logbooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposal_id')->constrained()->cascadeOnDelete();
            $table->date('tanggal');
            $table->string('tempat')->nullable();
            $table->string('nama_kegiatan');
            $table->string('teknik')->nullable();     // "Analisis Dokumen", "Diskusi", dst.
            $table->text('deskripsi')->nullable();
            $table->string('file_path')->nullable();   // path file di disk 'public'
            $table->index(['proposal_id', 'tanggal']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal_logbooks');
    }
};
