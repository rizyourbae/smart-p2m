<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lecturer;

class Proposal extends Model
{

    use HasFactory;

    protected $fillable = [
        'lecturer_id',
        'judul_usulan',
        'status',
        'kata_kunci',
        'pengelola_bantuan',
        'klaster_bantuan',
        'bidang_ilmu',
        'tema',
        'jenis_penelitian',
        'kontribusi_keilmuan',
        'research_schemes',
        'issn_jurnal',
        'rencana_kegiatan',
        'profil_jurnal',
        'url_website_jurnal',
        'url_scopus',
        'url_surat_rekomendasi',
        'total_pengajuan_dana',
        'abstrak',
        'substansi',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'research_schemes' => 'array', // <-- Beritahu Laravel untuk memperlakukan kolom ini sebagai array
        'total_pengajuan_dana' => 'integer',
        'substansi' => 'array',
    ];



    public function summaryRow()
    {
        // Trik: relasi ke dirinya sendiri, id -> id (selalu 1 baris)
        return $this->hasMany(self::class, 'id', 'id');
    }

    // user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // lecturer
    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }
    // relasi untuk repeater
    public function lecturers()
    {
        return $this->hasMany(ProposalLecturer::class);
    }
    public function students()
    {
        return $this->hasMany(ProposalStudent::class);
    }
    public function ptus()
    {
        return $this->hasMany(ProposalPTU::class);
    }
    public function documents()
    {
        return $this->hasMany(ProposalDocument::class);
    }
    public function supportingFiles()
    {
        return $this->hasMany(ProposalSupportingFile::class);
    }
    public function logbooks()
    {
        return $this->hasMany(ProposalLogbook::class);
    }
    public function outcomes()
    {
        return $this->hasMany(ProposalOutcomes::class);
    }
    public function outputs()
    {
        return $this->hasMany(ProposalOutput::class);
    }
    public function reports()
    {
        return $this->hasMany(ProposalReport::class);
    }
    public function reviewers(): BelongsToMany
    {
        return $this->belongsToMany(Reviewer::class, 'proposal_reviewer');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
