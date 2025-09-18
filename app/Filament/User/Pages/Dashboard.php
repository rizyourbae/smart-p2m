<?php

namespace App\Filament\User\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\User\Widgets\StatWidget;
use App\Filament\User\Widgets\MyProposalStatusChart;
use App\Filament\User\Widgets\MyPublicationTypesChart;
use App\Filament\User\Widgets\WelcomeHeaderWidget;

class Dashboard extends BaseDashboard
{
    /**
     * Mengatur widget yang akan tampil di bagian 'header' dasbor.
     * Widget di sini akan tampil di paling atas dan memakan lebar penuh.
     */
    public function getHeaderWidgets(): array
    {
        return [
            WelcomeHeaderWidget::class,
            StatWidget::class,
        ];
    }

    /**
     * Mengatur widget yang akan tampil di 'badan' utama dasbor.
     */
    public function getWidgets(): array
    {
        return [
            MyProposalStatusChart::class,
            MyPublicationTypesChart::class,
        ];
    }

    /**
     * Mengatur jumlah kolom untuk area widget utama.
     */
    public function getColumns(): int | string | array
    {
        // Mengatur agar widget di getWidgets() ditampilkan dalam 2 kolom
        return 2;
    }
}
