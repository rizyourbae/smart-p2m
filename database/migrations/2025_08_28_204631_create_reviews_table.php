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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposal_id')->constrained()->onDelete('cascade');
            $table->foreignId('reviewer_id')->constrained()->onDelete('cascade');

            // Kolom untuk Tahap 1: Penilaian Proposal
            $table->json('komentar_substansi')->nullable();
            $table->json('skor_proposal')->nullable();
            $table->text('komentar_proposal')->nullable(); // Komentar umum untuk tahap proposal

            // Kolom untuk Tahap 2: Penilaian Presentasi
            $table->json('skor_presentasi')->nullable();
            $table->text('komentar_presentasi')->nullable(); // Komentar umum untuk tahap presentasi

            // Kolom untuk Tahap 3: Penilaian Luaran
            $table->text('komentar_luaran')->nullable(); // Komentar umum untuk tahap luaran

            $table->enum('status', ['ditugaskan', 'selesai'])->default('ditugaskan');
            $table->timestamps();
            $table->unique(['proposal_id', 'reviewer_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
