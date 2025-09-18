<?php

namespace App\Filament\Reviewer\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Reviewer\Widgets\WelcomeHeaderWidget;
use App\Filament\Reviewer\Widgets\StatsOverview;
use App\Filament\Reviewer\Widgets\ReviewerTasks;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            WelcomeHeaderWidget::class,
            StatsOverview::class,
            ReviewerTasks::class,
        ];
    }
}
