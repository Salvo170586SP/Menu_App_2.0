<?php

namespace App\Providers;

use App\Models\Style;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
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
        Paginator::useBootstrap();
        Event::listen(Registered::class, function ($event) {
            $user = $event->user;
            Style::create([
                'user_id' => $user->id,
            ]);
        });
    }
}
