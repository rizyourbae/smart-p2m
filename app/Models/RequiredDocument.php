<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lecturer;

class RequiredDocument extends Model
{
    use HasFactory;
    protected $fillable = [
        'lecturer_id',
        'type',
        'documents',
    ];

    // Tambahkan relasi ke dosen (Lecturer)
    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }
}
