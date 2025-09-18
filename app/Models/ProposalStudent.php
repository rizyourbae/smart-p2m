<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalStudent extends Model
{
    use HasFactory;
    protected $fillable = [
        'proposal_id',
        'nama_mahasiswa',
        'nim',
        'program_studi'
    ];
}
