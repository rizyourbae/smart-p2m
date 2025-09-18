<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\WelcomeHeaderWidget;
use App\Filament\Widgets\AdminStatsOverview;
use App\Filament\Widgets\ProposalsNeedingAction;
use App\Filament\Widgets\ProposalStatusChart;
use App\Filament\Widgets\UserRoleChart;
use Filament\Widgets\Widget;
use Filament\Widgets\WidgetConfiguration;

class Dashboard extends BaseDashboard
{
    /**
     * @return array<class-string<Widget> | WidgetConfiguration>
     */
    public function getWidgets(): array
    {
        return [
            // Daftarkan widget yang ingin ditampilkan
            WelcomeHeaderWidget::class,
            AdminStatsOverview::class,
            ProposalsNeedingAction::class,
            ProposalStatusChart::class,
            UserRoleChart::class,
        ];
    }
}
