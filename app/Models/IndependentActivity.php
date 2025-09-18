<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndependentActivity extends Model
{
    use HasFactory;
    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'lecturer_id',
        'jenis',
        'judul',
        'anggota',
        'resume',
        'tahun_pelaksanaan',
        'pelaksana_kegiatan',
        'mitra_kolaborasi',
        'sumber_dana',
        'besaran_dana'
    ];
    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }
}
