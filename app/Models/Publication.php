<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;
    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'lecturer_id',
        'jenis',
        'judul',
        'penulis',
        'nama_jurnal',
        'nomor_ISBN',
        'penerbit',
        'jurnal_link'
    ];
    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }
}
