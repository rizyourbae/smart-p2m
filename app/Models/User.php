<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasName;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements FilamentUser, HasAvatar, HasName
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use Notifiable, HasFactory, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'photo',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi ke Lecturer
    public function lecturer()
    {
        return $this->hasOne(Lecturer::class);
    }
    public function reviewer()
    {
        return $this->hasOne(Reviewer::class);
    }

    /**
     * Metode ini menentukan apakah user bisa mengakses panel Filament tertentu.
     * INI ADALAH LOGIKA UTAMA PEMBATASAN AKSES PANEL.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        // --- START DEBUGGING LOG ---
        Log::info('--- CAN ACCESS PANEL DEBUG ---');
        Log::info('User Email: ' . $this->email);
        Log::info('Panel ID: ' . $panel->getId());
        Log::info('User Roles: ' . implode(', ', $this->getRoleNames()->toArray()));
        // --- END DEBUGGING LOG ---

        if ($panel->getId() === 'admin') {
            $result = $this->hasRole('admin');
            Log::info("Access to 'admin' panel for {$this->email}: " . ($result ? 'ALLOWED' : 'DENIED') . " (Requires 'admin' role)");
            return $result;
        }

        if ($panel->getId() === 'user') {
            $result = $this->hasRole(['dosen', 'peneliti']);
            Log::info("Access to 'user' panel for {$this->email}: " . ($result ? 'ALLOWED' : 'DENIED') . " (Requires 'dosen' or 'peneliti' role)");
            return $result;
        }

        Log::info("Access to unknown panel for {$this->email}: DENIED");
        return false;
    }

    // Metode ini diperlukan oleh Filament (untuk Panel Default jika hanya ada satu panel)
    // Kita bisa biarkan ini true, karena canAccessPanel yang akan mengatur akses spesifik
    public function canAccessFilament(): bool
    {
        return true;
    }
    public function getFilamentAvatarUrl(): ?string
    {
        // [LANGKAH 1] Cek dulu apakah ada foto di kolom 'photo' milik user itu sendiri.
        // Ini akan bekerja untuk Admin.
        if ($this->photo) {
            return Storage::url($this->photo);
        }

        // [LANGKAH 2] Jika tidak ada, baru kita cek relasi 'lecturer' untuk Dosen.
        if ($this->lecturer && $this->lecturer->photo) {
            return Storage::url($this->lecturer->photo);
        }

        // [LANGKAH 3] Jika keduanya tidak ada, kembalikan avatar default.
        return null;
    }
    public function getFilamentName(): string
    {
        // Jika data lecturer ada dan nama di lecturer tidak kosong, gunakan nama dari lecturer.
        // Jika tidak, gunakan nama default dari tabel user.
        return $this->lecturer?->nama ?? $this->name;
    }
}
