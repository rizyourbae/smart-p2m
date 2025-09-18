<?php

namespace App\Filament\Widgets;

use App\Models\Proposal;
use App\Models\Publication;
use App\Models\IndependentActivity;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStatsOverview extends BaseWidget
{
    // Atur urutan, angka 1 berarti akan tampil di paling atas
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Proposal Perlu Tindakan', Proposal::whereIn('status', ['diajukan', 'menunggu_keputusan'])->count())
                ->description('Proposal yang butuh penugasan atau keputusan final')
                ->descriptionIcon('heroicon-m-exclamation-circle', IconPosition::Before)
                ->color('warning'),
                
            Stat::make('Total Publikasi Dosen', Publication::query()->count())
                ->description('Jumlah semua publikasi yang tercatat di sistem')
                ->descriptionIcon('heroicon-m-document-text', IconPosition::Before)
                ->color('success'),

            Stat::make('Total Kegiatan Mandiri', IndependentActivity::query()->count())
                ->description('Jumlah semua kegiatan mandiri yang tercatat')
                ->descriptionIcon('heroicon-m-sparkles', IconPosition::Before)
                ->color('info'),
        ];
    }
}
