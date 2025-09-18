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
        Schema::create('independent_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lecturer_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('jenis');
            $table->string('judul');
            $table->string('anggota');
            $table->string('resume');
            $table->string('tahun_pelaksanaan');
            $table->string('pelaksana_kegiatan');
            $table->string('mitra_kolaborasi');
            $table->string('sumber_dana');
            $table->string('besaran_dana');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('independent_activities');
    }
};
