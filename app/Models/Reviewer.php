<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable; // <-- Kita gunakan alias agar tidak bingung
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

// [PERBAIKAN] Deklarasi kelas yang benar
class Reviewer extends Authenticatable implements FilamentUser, HasAvatar, HasName
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * Tentukan guard otentikasi yang digunakan oleh model ini.
     * @var string
     */
    protected $guard = 'reviewer';

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'status_pengguna',
        'unit',
        'study_program',
        'nik',
        'jk',
        'tempat_lahir',
        'tanggal_lahir',
        'hp',
        'alamat',
        'sinta_id',
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

    /**
     * The attributes that should be hidden for serialization.
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     * @var array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'tanggal_lahir'     => 'date',
        ];
    }

    // --- RELASI ELOQUENT ---

    public function proposals(): BelongsToMany
    {
        return $this->belongsToMany(Proposal::class, 'proposal_reviewer');
    }
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
    public function educationalHistories(): HasMany
    {
        return $this->hasMany(ReviewerEducationalHistory::class);
    }

    // --- METHOD UNTUK FILAMENT ---

    public function canAccessPanel(Panel $panel): bool
    {
        // Hanya izinkan akses ke panel 'reviewer' jika memiliki peran 'reviewer'
        return $panel->getId() === 'reviewer' && $this->hasRole('reviewer');
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->photo ? Storage::url($this->photo) : null;
    }

    public function getFilamentName(): string
    {
        // [PERBAIKAN] Langsung kembalikan nama dari record reviewer ini
        return $this->name;
    }

    // --- ACCESSOR ---

    /**
     * Accessor untuk menghitung jumlah review yang sedang aktif.
     */
    protected function activeReviewsCount(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->reviews()->where('status', '!=', 'selesai')->count(),
        );
    }
}
