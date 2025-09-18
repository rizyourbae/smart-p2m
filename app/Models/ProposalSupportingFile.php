<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalSupportingFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'proposal_id',
        'nama_file',
        'file_path'
    ];
}
