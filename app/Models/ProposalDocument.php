<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'proposal_id',
        'jenis',
        'file_path'
    ];
}
