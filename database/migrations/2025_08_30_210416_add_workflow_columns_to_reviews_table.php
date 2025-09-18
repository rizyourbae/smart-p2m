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
        Schema::table('reviews', function (Blueprint $table) {
            // Kolom untuk menyimpan total skor dari tahap penilaian proposal
            $table->decimal('total_nilai_proposal', 5, 2)->nullable()->after('komentar_luaran');
            // Kolom untuk melacak progres tahapan review
            $table->string('tahapan_review')->default('proposal')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn(['total_nilai_proposal', 'tahapan_review']);
        });
    }
};
