<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Reviewer;

class ReviewerRequiredDocument extends Model
{
    use HasFactory;
    protected $fillable = [
        'reviewer_id',
        'type',
        'documents',
    ];

    // Tambahkan relasi ke reviewer
    public function reviewer()
    {
        return $this->belongsTo(Reviewer::class);
    }
}
