<?php

namespace App\Exports;

use App\Models\Publication;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings; // Untuk menambahkan baris header
use Maatwebsite\Excel\Concerns\WithMapping; // Untuk memetakan data

class PublicationsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Ambil semua data publikasi beserta relasi dosennya
        return Publication::with('lecturer')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Definisikan judul untuk setiap kolom di file Excel
        return [
            'ID',
            'Judul Publikasi',
            'Jenis',
            'Nama Dosen',
            'Fakultas',
            'Program Studi',
            'Penulis',
            'Nama Jurnal',
            'ISBN',
            'Penerbit',
            'Link',
        ];
    }

    /**
     * @param Publication $publication
     * @return array
     */
    public function map($publication): array
    {
        // Petakan setiap baris data ke kolom yang sesuai
        return [
            $publication->id,
            $publication->judul,
            $publication->jenis,
            $publication->lecturer->nama ?? 'N/A', // Ambil nama dari relasi
            $publication->lecturer->unit ?? 'N/A', // Ambil fakultas dari relasi
            $publication->lecturer->study_program ?? 'N/A', // Ambil program studi dari relasi
            $publication->penulis,
            $publication->nama_jurnal,
            $publication->nomor_ISBN,
            $publication->penerbit,
            $publication->jurnal_link,
        ];
    }
}
