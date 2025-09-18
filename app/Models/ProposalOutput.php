<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalOutput extends Model
{
    use HasFactory;
    protected $fillable = [
        'proposal_id',
        'type_outputs',
        'documents_outputs',
    ];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
}
