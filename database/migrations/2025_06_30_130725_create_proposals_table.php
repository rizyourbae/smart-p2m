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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lecturer_id')->constrained()->onDelete('cascade');
            // Menu: Pernyataan Peneliti
            $table->string('judul_usulan');
            $table->string('kata_kunci');
            $table->string('pengelola_bantuan');
            $table->string('klaster_bantuan');
            $table->string('bidang_ilmu');
            $table->string('tema');
            $table->string('jenis_penelitian');
            $table->text('kontribusi_keilmuan');
            // Menu: Isian Proposal
            $table->string('issn_jurnal')->nullable();
            $table->text('rencana_kegiatan')->nullable();
            $table->text('profil_jurnal')->nullable();
            $table->string('url_website_jurnal')->nullable();
            $table->string('url_scopus')->nullable();
            $table->string('url_surat_rekomendasi')->nullable();
            $table->integer('total_pengajuan_dana')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
