<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewerEducationalHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'reviewer_id',
        'jenjang',
        'program_studi',
        'institusi',
        'tahun_masuk',
        'tahun_lulus',
        'ipk',
        'dokumen_ijazah',
    ];
}
