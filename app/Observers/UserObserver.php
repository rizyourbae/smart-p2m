<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Lecturer; // Import model Lecturer

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // Buat entri baru di tabel lecturers untuk user yang baru dibuat
        Lecturer::create([
            'user_id' => $user->id,
            'email' => $user->email, // Ambil email dari user
            'nama' => $user->name,   // Ambil nama dari user
            'status_pengguna' => 'Dosen', // Otomatis set sebagai 'Dosen'
            // Kolom lain bisa dikosongkan atau diisi default jika ada
            // Misalnya: 'nip' => null, 'nidn' => null, 'jk' => null, dst.
        ]);
        // Berikan peran 'dosen' ke user baru (jika belum punya)
        if (!$user->hasRole('dosen') && !$user->hasRole('peneliti')) {
            $user->assignRole('dosen');
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        // Jika ada perubahan pada nama atau email user, update juga di Lecturer
        if ($user->isDirty('name') || $user->isDirty('email')) {
            $user->lecturer()->update([
                'nama' => $user->name,
                'email' => $user->email,
            ]);
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        // Otomatis hapus lecturer jika user dihapus (jika onDelete('cascade') tidak dipakai di migrasi)
        // Kalau di migrasi sudah pakai onDelete('cascade'), ini tidak perlu
        // $user->lecturer()->delete();
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
