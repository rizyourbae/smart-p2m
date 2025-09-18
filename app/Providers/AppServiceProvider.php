<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User; // Import model User
use App\Models\Reviewer; // Import model Review
use App\Observers\UserObserver; // Import UserObserver
use App\Observers\ReviewerObserver; // Import ReviewerObserver
use App\Models\Review;             // Import model Review
use App\Observers\ReviewObserver;  // Import ReviewObserver

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Daftarkan UserObserver di sini
        User::observe(UserObserver::class);
        Reviewer::observe(ReviewerObserver::class);
        Review::observe(ReviewObserver::class);
    }
}
