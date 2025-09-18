<?php

namespace App\Filament\Widgets;

use App\Models\Proposal;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB; 

class ProposalStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Komposisi Status Proposal';

    // Atur urutan, angka lebih besar akan tampil di bawah
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        // 1. Ambil data dari database dan kelompokkan berdasarkan status
        $data = Proposal::query()
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        // 2. Siapkan data untuk ditampilkan di grafik
        return [
            'datasets' => [
                [
                    'label' => 'Proposal',
                    'data' => $data->pluck('total')->toArray(),
                    // Atur warna untuk setiap irisan kue
                    'backgroundColor' => [
                        '#FF6384', // Ditolak
                        '#36A2EB', // Diterima
                        '#FFCE56', // Dalam Penilaian
                        '#4BC0C0', // Diajukan
                        '#9966FF', // Menunggu Keputusan
                        '#F7B32B', // Revisi
                    ],
                ],
            ],
            // 3. Siapkan label untuk setiap irisan kue (dengan format yang rapi)
            'labels' => $data->pluck('status')
                ->map(fn($status) => ucwords(str_replace('_', ' ', $status)))
                ->toArray(),
        ];
    }

    protected function getType(): string
    {
        // Tentukan jenis grafik, 'pie' atau 'doughnut' adalah yang terbaik untuk ini
        return 'doughnut';
    }
}
