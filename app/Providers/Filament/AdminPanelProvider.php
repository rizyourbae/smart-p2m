<?php

namespace App\Providers\Filament;

use App\Filament\Pages\EditAdminProfile;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Navigation\NavigationGroup;
use Filament\Support\Enums\MaxWidth;
use Solutionforest\FilamentLoginScreen\Filament\Pages\Auth\Themes\Theme3\LoginScreenPage as LoginScreenPage;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->sidebarCollapsibleOnDesktop(true)
            ->brandLogo(asset('assets/img/icon-uinsi.png'))
            ->brandLogoHeight('3rem')
            ->brandName('SMART P2M')
            ->favicon(asset('assets/img/logo_uinsi.png'))
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->spa()
            ->maxContentWidth(MaxWidth::Full)
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')
            ->login(LoginScreenPage::class)
            ->colors([
                'primary' => Color::Blue,
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('Manajemen Akun')
                    ->url(fn(): string => EditAdminProfile::getUrl())
                    ->icon('heroicon-o-cog-6-tooth'),
            ])
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Akademik')
                    ->icon('bi-mortarboard') // Ganti dengan ikon yang sesuai
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Landing Page')
                    ->icon('bi-browser-chrome') // Ganti dengan ikon yang sesuai
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Data Master')
                    ->icon('bi-clipboard-data') // Ganti dengan ikon yang sesuai
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Pengaturan')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->collapsed(),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
