<?php

namespace TypiCMS\Modules\Teams\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Teams\Composers\SidebarViewComposer;
use TypiCMS\Modules\Teams\Facades\Teams;
use TypiCMS\Modules\Teams\Models\Team;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.teams');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['teams' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'teams');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/teams'),
        ], 'views');

        $this->publishes([
            __DIR__.'/../resources/scss' => resource_path('scss'),
        ], 'resources');

        AliasLoader::getInstance()->alias('Teams', Teams::class);

        /*
         * Sidebar view composer
         */
        $this->app->view->composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        $this->app->view->composer('teams::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('teams');
        });
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register(RouteServiceProvider::class);

        $app->bind('Teams', Team::class);
    }
}
