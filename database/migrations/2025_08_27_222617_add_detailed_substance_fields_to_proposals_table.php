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
        Schema::table('proposals', function (Blueprint $table) {
            $table->text('abstrak')->nullable()->after('total_pengajuan_dana');
            $table->text('latar_belakang')->nullable()->after('abstrak');
            $table->text('fokus_pengabdian')->nullable()->after('latar_belakang');
            $table->text('tujuan_pengabdian')->nullable()->after('fokus_pengabdian');
            $table->text('analisis_strategi_pengabdian')->nullable()->after('tujuan_pengabdian');
            $table->text('kajian_terdahulu')->nullable()->after('analisis_strategi_pengabdian');
            $table->text('konsep_teori')->nullable()->after('kajian_terdahulu');
            $table->text('metodologi_pengabdian')->nullable()->after('konsep_teori');
            $table->text('matrik_perencanaan')->nullable()->after('metodologi_pengabdian');
            $table->text('stakeholders')->nullable()->after('matrik_perencanaan');
            $table->text('daftar_pustaka')->nullable()->after('stakeholders');
            $table->text('organisasi_pelaksana')->nullable()->after('daftar_pustaka');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            //
        });
    }
};
