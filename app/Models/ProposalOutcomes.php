<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalOutcomes extends Model
{
    use HasFactory;
    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'proposal_id',
        'jenis_outcomes',
        'judul_outcomes',
        // jurnal
        'nama_jurnal_fix',
        'volume_jurnal_fix',
        'link_jurnal_fix',
        // buku
        'nomor_isbn_fix',
        'penerbit_buku',
        'tahun_terbit_buku'
    ];
    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
}
