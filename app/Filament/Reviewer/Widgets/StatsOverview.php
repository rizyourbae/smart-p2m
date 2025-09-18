<?php

namespace App\Filament\Reviewer\Widgets;

use App\Models\Review;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1; // Tampil paling atas

    protected function getStats(): array
    {
        // [PERBAIKAN] Langsung ambil ID dari user (reviewer) yang sedang login
        $reviewerId = Auth::id();

        return [
            Stat::make(
                'Tugas Perlu Dinilai',
                Review::query()
                    ->where('reviewer_id', $reviewerId) // <-- Gunakan ID yang benar
                    ->where('status', '!=', 'selesai')
                    ->count()
            )
                ->description('Proposal yang menunggu penilaian Anda')
                ->descriptionIcon('heroicon-m-exclamation-circle', IconPosition::Before)
                ->color('warning'),

            // ... stat lainnya juga menggunakan $reviewerId ...
            Stat::make(
                'Tugas Selesai Dinilai',
                Review::query()
                    ->where('reviewer_id', $reviewerId)
                    ->where('status', 'selesai')
                    ->count()
            )
                ->description('Proposal yang telah Anda nilai')
                ->descriptionIcon('heroicon-m-check-circle', IconPosition::Before)
                ->color('success'),

            Stat::make(
                'Total Tugas Ditugaskan',
                Review::query()
                    ->where('reviewer_id', $reviewerId)
                    ->count()
            )
                ->description('Semua proposal yang ditugaskan kepada Anda')
                ->descriptionIcon('heroicon-m-archive-box', IconPosition::Before)
                ->color('info'),
        ];
    }
}
