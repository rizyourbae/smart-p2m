<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'lecturer_id',
        'jenjang',
        'program_studi',
        'institusi',
        'tahun_masuk',
        'tahun_lulus',
        'ipk',
        'dokumen_ijazah',
    ];
}
