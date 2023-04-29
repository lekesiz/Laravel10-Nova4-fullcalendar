<?php

namespace App\Providers;

use Laravel\Nova\Nova;
use Netz\Calendar\Calendar;
use Netz\OnlineUsers\OnlineUsers;
use Illuminate\Support\Facades\Gate;
use App\Nova\Metrics\OnlineUserCount;
use Illuminate\Support\Facades\Blade;
use CodencoDev\NovaGridSystem\NovaGridSystem;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::withBreadcrumbs();

        Nova::footer(function ($request) {
            return Blade::render('NetLogiciel');
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                'mikail@lekesiz.org',
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new Calendar,
            new NovaGridSystem,
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // sisteme giris yapan kullaniciyi bir resource icerisine gonderme
        // Nova::initialPath('/resources/users');
    }
}
