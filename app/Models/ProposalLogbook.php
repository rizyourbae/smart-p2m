<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalLogbook extends Model
{
    use HasFactory;

    protected $fillable = [
        'proposal_id',
        'tanggal',
        'tempat',
        'nama_kegiatan',
        'teknik',
        'deskripsi',
        'file_path',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
}
