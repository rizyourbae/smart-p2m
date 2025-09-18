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
        Schema::table('lecturers', function (Blueprint $table) {
            // Pastikan kolom ini unik dan bisa null jika memang ada lecturer tanpa akun user
            // Jika setiap lecturer PASTI punya akun user, maka gunakan ->nullable(false)
            $table->foreignId('user_id')->nullable()->unique()->after('id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lecturers', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Hapus foreign key dulu
            $table->dropColumn('user_id');    // Lalu drop kolom
        });
    }
};
