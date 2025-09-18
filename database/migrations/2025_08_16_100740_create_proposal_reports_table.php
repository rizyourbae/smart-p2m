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
        Schema::create('proposal_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposal_id')->constrained()->onDelete('cascade');
            $table->string('report_type'); // Laporan (Laporan Antara, Keuangan, Akhir)
            $table->string('file_path')->nullable(); // File path
            $table->decimal('usulan_biaya', 15, 2)->nullable(); // Usulan Biaya (untuk Laporan Keuangan)
            $table->decimal('biaya_disetujui', 15, 2)->nullable(); // Biaya Disetujui (untuk Laporan Keuangan)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal_reports');
    }
};
