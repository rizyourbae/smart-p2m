<?php

namespace App\Exports;

use App\Models\IndependentActivity;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class IndependentActivitiesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Ambil semua data kegiatan mandiri beserta relasi dosennya
        return IndependentActivity::with('lecturer')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Definisikan judul untuk setiap kolom di file Excel
        return [
            'ID Kegiatan',
            'Nama Dosen',
            'Fakultas',
            'Program Studi',
            'Jenis Kegiatan',
            'Judul Kegiatan',
            'Tahun Pelaksanaan',
            'Anggota Terlibat',
            'Unit Pelaksana',
            'Mitra Kolaborasi',
            'Sumber Dana',
            'Besaran Dana (Rp)',
        ];
    }

    /**
     * @param IndependentActivity $activity
     * @return array
     */
    public function map($activity): array
    {
        // Petakan setiap baris data ke kolom yang sesuai
        return [
            $activity->id,
            $activity->lecturer->nama ?? 'N/A', // Ambil nama dari relasi
            $activity->lecturer->unit ?? 'N/A', // Ambil fakultas dari relasi
            $activity->lecturer->study_program ?? 'N/A', // Ambil program studi dari relasi
            $activity->jenis,
            $activity->judul,
            $activity->tahun_pelaksanaan,
            $activity->anggota,
            $activity->pelaksana_kegiatan,
            $activity->mitra_kolaborasi,
            $activity->sumber_dana,
            $activity->besaran_dana,
        ];
    }
}
