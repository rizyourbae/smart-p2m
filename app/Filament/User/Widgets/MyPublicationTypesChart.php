<?php

namespace App\Filament\User\Widgets;

use App\Models\Publication;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MyPublicationTypesChart extends ChartWidget
{
    protected static ?string $heading = 'Publikasi Berdasarkan Jenis';

    // Atur urutan agar tampil di bawah widget proposal
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $lecturer = Auth::user()->lecturer;
        if (!$lecturer) {
            return [];
        }

        // 1. Query data publikasi milik dosen ini, kelompokkan berdasarkan jenis
        $data = Publication::query()
            ->where('lecturer_id', $lecturer->id)
            ->select('jenis', DB::raw('count(*) as total'))
            ->groupBy('jenis')
            ->get();

        // 2. Olah hasil query menjadi format yang bisa dibaca oleh chart
        return [
            'datasets' => [
                [
                    'label' => 'Publikasi',
                    'data' => $data->pluck('total')->toArray(),
                    'backgroundColor' => [
                        '#36A2EB', // Biru untuk jenis pertama (misal: Artikel)
                        '#FF6384', // Merah muda untuk jenis kedua (misal: Buku)
                        '#FFCE56', // Kuning untuk jenis ketiga (jika ada)
                    ],
                ],
            ],
            'labels' => $data->pluck('jenis')->toArray(),
        ];
    }

    protected function getType(): string
    {
        // 'pie' cocok untuk menunjukkan komposisi seperti ini
        return 'pie';
    }
}
