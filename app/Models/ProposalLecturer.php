<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalLecturer extends Model
{
    use HasFactory;
    protected $fillable = [
        'proposal_id',
        'nama_dosen',
        'nip',
        'nidn',
        'jabatan',
        'institusi'
    ];
}
