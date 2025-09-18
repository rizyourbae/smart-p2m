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
        Schema::create('lecturers', function (Blueprint $table) {
            $table->id();
            $table->string('photo')->nullable();
            $table->string('status_pengguna')->nullable();
            $table->string('email');
            $table->string('unit')->nullable();
            $table->string('nama');
            $table->string('nik')->nullable();
            $table->string('jk')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('hp')->nullable();
            $table->text('alamat')->nullable();
            $table->string('sinta_id')->nullable();
            $table->string('nip')->nullable();
            $table->string('nidn')->nullable();
            $table->string('employee_type')->nullable();
            $table->string('profession')->nullable();
            $table->string('functional_position')->nullable();
            $table->string('scientific_field')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecturers');
    }
};
