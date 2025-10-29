<?php

namespace App\Providers\Filament;

use App\Filament\User\Pages\EditMyProfile;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Navigation\MenuItem;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Navigation\NavigationGroup;
use Filament\Support\Enums\MaxWidth;

class UserPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->sidebarCollapsibleOnDesktop(true)
            ->brandName('SMART P2M')
            ->brandLogo(asset('assets/img/icon-uinsi.png'))
            ->brandLogoHeight('3rem')
            ->favicon(asset('assets/img/logo_uinsi.png'))
            ->id('user')
            ->path('user')
            ->spa()
            ->maxContentWidth(MaxWidth::Full)
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('Manajemen Akun')
                    ->url(fn(): string => EditMyProfile::getUrl())
                    ->icon('heroicon-o-cog-6-tooth'),
            ])
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Peneliti')
                    ->icon('bi-person-square'),
                NavigationGroup::make()
                    ->label('Profil')
                    ->icon('bi-person-badge'),
                NavigationGroup::make()
                    ->label('Informasi')
                    ->icon('heroicon-o-information-circle')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Pengaturan')
                    ->icon('bi-gear-wide-connected')
                    ->collapsed(),
            ])
            ->discoverResources(in: app_path('Filament/User/Resources'), for: 'App\\Filament\\User\\Resources')
            ->discoverPages(in: app_path('Filament/User/Pages'), for: 'App\\Filament\\User\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/User/Widgets'), for: 'App\\Filament\\User\\Widgets')
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
            ])
            ->login()
            ->registration();
    }
}
