<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    /**
     * Menggunakan $guarded untuk kemudahan, karena semua field lain
     * diisi oleh sistem dan aman.
     */
    protected $guarded = ['id'];

    /**
     * [PENTING] Memberitahu Laravel untuk secara otomatis mengubah
     * kolom-kolom JSON ini menjadi array saat dibaca, dan sebaliknya.
     */
    protected $casts = [
        'komentar_substansi' => 'array',
        'skor_proposal' => 'array',
        'skor_presentasi' => 'array',
        'skor_luaran' => 'array',
    ];

    /**
     * Mendefinisikan relasi bahwa setiap Review dimiliki oleh satu Proposal.
     */
    public function proposal(): BelongsTo
    {
        return $this->belongsTo(Proposal::class);
    }
    /**
     * Mendefinisikan relasi bahwa setiap Review dimiliki oleh satu Reviewer.
     */
    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(Reviewer::class);
    }
}
