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
        Schema::create('reviewer_educational_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reviewer_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('jenjang');
            $table->string('program_studi');
            $table->string('institusi');
            $table->string('tahun_masuk');
            $table->string('tahun_lulus');
            $table->string('ipk');
            $table->string('dokumen_ijazah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviewer_educational_histories');
    }
};
