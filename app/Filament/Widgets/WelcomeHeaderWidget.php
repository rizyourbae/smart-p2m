<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WelcomeHeaderWidget extends Widget
{
    protected static string $view = 'filament.widgets.welcome-header-widget';

    protected bool $isDisliked = false;
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 0;
    public Carbon $currentTime;

    public function mount(): void
    {
        $this->currentTime = Carbon::now();
    }

    public function pollTime(): void
    {
        $this->currentTime = Carbon::now();
    }

    protected function getViewData(): array
    {
        $hour = Carbon::now()->hour;
        if ($hour < 12) {
            $greeting = 'Selamat pagi';
        } elseif ($hour < 15) {
            $greeting = 'Selamat siang';
        } elseif ($hour < 18) {
            $greeting = 'Selamat sore';
        } else {
            $greeting = 'Selamat malam';
        }

        return [
            'greeting' => $greeting,
            'userName' => Auth::user()->name,
            'currentDate' => Carbon::now()->translatedFormat('l, d F Y'),
        ];
    }
}
