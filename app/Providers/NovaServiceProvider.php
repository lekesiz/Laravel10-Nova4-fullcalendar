<?php

namespace App\Providers;

use App\Nova\Log;
use App\Nova\Role;
use App\Nova\Task;
use App\Nova\User;
use App\Nova\Quote;
use App\Nova\Client;
use App\Nova\Article;
use App\Nova\Company;
use App\Nova\Invoice;
use App\Nova\Supplier;
use Laravel\Nova\Nova;
use App\Nova\Numerator;
use App\Nova\CreditNote;
use App\Nova\Permission;
use App\Nova\Intervention;
use Laravel\Nova\Menu\Menu;
use Netz\Calendar\Calendar;
use Illuminate\Http\Request;
use App\Nova\Dashboards\Main;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuGroup;
use Netz\OnlineUsers\OnlineUsers;
use Laravel\Nova\Menu\MenuSection;
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

        Nova::mainMenu(function (Request $request, Menu $menu) {
            $items = [
                MenuSection::dashboard(Main::class)->icon('home'),
                MenuSection::resource(Client::class)->icon('users'),
                MenuSection::resource(Task::class)->icon('document-text'),
                MenuSection::resource(Intervention::class)->icon('archive'),
                MenuSection::resource(Quote::class)->icon('clipboard-check'),
                MenuSection::resource(Invoice::class)->icon('document-duplicate'),
                MenuSection::resource(CreditNote::class)->icon('document-remove'),
                MenuSection::make('Calendrier')->path('/calendar')->icon('calendar'),
            ];
        
            if ($request->user()->is_admin) {
                $items[] = MenuSection::make('Gestion', [
                    MenuItem::resource(Company::class),
                    MenuItem::resource(Article::class),
                    MenuItem::resource(User::class),
                    MenuItem::resource(Role::class),
                    MenuItem::resource(Permission::class),
                    MenuItem::resource(Numerator::class),
                    MenuItem::resource(Supplier::class),
                    MenuItem::resource(Log::class),
                ])->icon('briefcase')->collapsable();
            }
        
            return $items;
        });
        
        Nova::userMenu(function (Request $request, Menu $menu) {
            $menu->prepend(
                MenuItem::make(
                    'My Profile',
                    "/resources/users/{$request->user()->getKey()}"
                )
            );            
            return $menu;
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
        // Gate::define('viewNova', function ($user) {
        //     return in_array($user->email, [
        //         //
        //     ]);
        // });

        Gate::define('viewNova', function ($user) {
            return $user->is_active;
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
