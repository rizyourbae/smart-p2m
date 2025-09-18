<?php

namespace App\Filament\User\Widgets;

use App\Models\Proposal;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MyProposalStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Komposisi Status Proposal Saya';

    // Atur urutan agar tampil di bawah widget statistik
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        // Ambil data dosen yang sedang login
        $lecturer = Auth::user()->lecturer;
        if (!$lecturer) {
            return []; // Kembalikan data kosong jika tidak ada profil dosen
        }

        // 1. Query data proposal milik dosen ini, kelompokkan berdasarkan status
        $data = Proposal::query()
            ->where('lecturer_id', $lecturer->id)
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        // Siapkan array untuk menampung data & label
        $chartData = [];
        $chartLabels = [];
        $backgroundColors = [];

        // Definisikan palet warna untuk setiap status
        $colorMap = [
            'diterima' => '#22c55e', // Hijau
            'ditolak' => '#ef4444', // Merah
            'dalam_penilaian' => '#f59e0b', // Kuning
            'menunggu_keputusan' => '#3b82f6', // Biru
            'revisi' => '#eab308', // Kuning tua
            'diajukan' => '#6b7280', // Abu-abu
            'draft' => '#9ca3af', // Abu-abu muda
        ];

        // 2. Olah hasil query menjadi format yang bisa dibaca oleh chart
        foreach ($data as $item) {
            $chartData[] = $item->total;
            // Ubah format label agar lebih rapi (misal: 'dalam_penilaian' -> 'Dalam Penilaian')
            $chartLabels[] = ucwords(str_replace('_', ' ', $item->status));
            // Ambil warna yang sesuai dari palet
            $backgroundColors[] = $colorMap[$item->status] ?? '#A9A9A9'; // Warna default jika status tidak dikenal
        }

        // 3. Kembalikan data dalam format yang dibutuhkan Chart.js
        return [
            'datasets' => [
                [
                    'label' => 'Proposal',
                    'data' => $chartData,
                    'backgroundColor' => $backgroundColors,
                ],
            ],
            'labels' => $chartLabels,
        ];
    }

    protected function getType(): string
    {
        // 'doughnut' memberikan tampilan yang modern
        return 'doughnut';
    }
}
