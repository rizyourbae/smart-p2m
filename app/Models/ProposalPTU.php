<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalPTU extends Model
{
    use HasFactory;
    protected $fillable = [
        'proposal_id',
        'nama_peneliti',
        'nidn_nik',
        'institusi'
    ];
}
