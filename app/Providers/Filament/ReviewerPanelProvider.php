<?php

namespace App\Providers\Filament;

use App\Filament\Reviewer\Pages\SettingReviewerProfile;
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
use Solutionforest\FilamentLoginScreen\Filament\Pages\Auth\Themes\Theme2\LoginScreenPage as LoginScreenPage;
use Filament\Support\Enums\MaxWidth;
class ReviewerPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->sidebarCollapsibleOnDesktop(true)
            ->brandLogo(asset('assets/img/icon-uinsi.png'))
            ->brandName('SMART P2M')
            ->brandLogoHeight('3rem')
            ->favicon(asset('assets/img/logo_uinsi.png'))
            ->id('reviewer')
            ->path('reviewer')
            ->maxContentWidth(MaxWidth::Full)
            ->login()
            ->authGuard('reviewer')
            ->login(LoginScreenPage::class)
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')
            ->colors([
                'primary' => Color::Red,
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('Manajemen Akun')
                    ->url(fn(): string => SettingReviewerProfile::getUrl())
                    ->icon('heroicon-o-cog-6-tooth'),
            ])
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Reviewer')
                    ->icon('heroicon-o-document-magnifying-glass'),
                NavigationGroup::make()
                    ->label('Profil')
                    ->icon('heroicon-o-user-circle'),
                NavigationGroup::make()
                    ->label('Informasi')
                    ->icon('heroicon-o-information-circle')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Pengaturan')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->collapsed(),
            ])
            ->discoverResources(in: app_path('Filament/Reviewer/Resources'), for: 'App\\Filament\\Reviewer\\Resources')
            ->discoverPages(in: app_path('Filament/Reviewer/Pages'), for: 'App\\Filament\\Reviewer\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Reviewer/Widgets'), for: 'App\\Filament\\Reviewer\\Widgets')
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
