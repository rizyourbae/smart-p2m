<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'proposal_id',
        'report_type',
        'file_path',
        'file_path_2',
        'file_path_3',
        'file_path_4',
        'usulan_biaya',
    ];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
}
