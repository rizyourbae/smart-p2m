<?php

namespace App\Filament\Widgets;

use App\Models\Lecturer;
use App\Models\Reviewer;
use Filament\Widgets\ChartWidget;

class UserRoleChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Pengguna Berdasarkan Peran';

    // Atur urutan, kita letakkan di bawah widget lain
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        // 1. Hitung jumlah total Dosen dan Reviewer
        $lecturerCount = Lecturer::query()->count();
        $reviewerCount = Reviewer::query()->count();

        // 2. Siapkan data untuk ditampilkan di grafik
        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pengguna',
                    'data' => [$lecturerCount, $reviewerCount],
                    // Atur warna untuk setiap batang
                    'backgroundColor' => [
                        'rgba(54, 162, 235, 0.5)', // Biru untuk Dosen
                        'rgba(255, 99, 132, 0.5)',  // Merah muda untuk Reviewer
                    ],
                    'borderColor' => [
                        'rgb(54, 162, 235)',
                        'rgb(255, 99, 132)',
                    ],
                    'borderWidth' => 1,
                ],
            ],
            // 3. Siapkan label untuk sumbu X
            'labels' => ['Dosen', 'Reviewer'],
        ];
    }

    protected function getType(): string
    {
        // Tentukan jenis grafik menjadi 'bar'
        return 'bar';
    }
}
