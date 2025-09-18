<?php

namespace App\Models;

use Filament\Actions\Concerns\CanNotify;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Lecturer extends Model implements HasAvatar
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id', // <<< TAMBAHKAN INI UNTUK RELASI KE USER
        'photo',
        'status_pengguna',
        'email',
        'unit',
        'study_program',
        'nama', // Sesuaikan nama kolom
        'nik',
        'jk', // Sesuaikan nama kolom
        'tempat_lahir', // Sesuaikan nama kolom
        'tanggal_lahir', // Sesuaikan nama kolom
        'hp', // Sesuaikan nama kolom
        'alamat',
        'sinta_id', // Kolom baru
        'nip',
        'nidn',
        'employee_type',
        'profession',
        'functional_position',
        'scientific_field',
        'sinta_score_all_years',
        'sinta_affiliation_all_years',
        'sinta_score_3_years',
        'sinta_affiliation_3_years',
        'sinta_profile_link',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date', // Cast ke tanggal agar mudah diformat
    ];

    // Relasi ke model User (setiap Lecturer dimiliki oleh satu User)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    // untuk jalur publication
    public function publications(): HasMany
    {
        return $this->hasMany(Publication::class);
    }
    public function independent_activities(): HasMany
    {
        return $this->hasMany(IndependentActivity::class);
    }
    public function educationalHistories(): HasMany
    {
        return $this->hasMany(EducationalHistory::class);
    }
    public function getFilamentAvatarUrl(): ?string
    {
        // Cek apakah kolom 'photo' ada isinya
        if ($this->photo) {
            // Jika ada, buat URL publik dari path foto yang tersimpan
            return Storage::url($this->photo);
        }

        // Jika tidak ada foto, kembalikan null agar Filament menampilkan avatar default
        return null;
    }
}
