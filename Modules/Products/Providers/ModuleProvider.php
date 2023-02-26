<?php

namespace TypiCMS\Modules\Products\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Observers\SlugObserver;
use TypiCMS\Modules\Products\Composers\SidebarViewComposer;
use TypiCMS\Modules\Products\Facades\BrochureDetails;
use TypiCMS\Modules\Products\Facades\Brochures;
use TypiCMS\Modules\Products\Facades\ProductCategories;
use TypiCMS\Modules\Products\Facades\ProductCategoryTypes;
use TypiCMS\Modules\Products\Facades\Products;
use TypiCMS\Modules\Products\Models\Brochure;
use TypiCMS\Modules\Products\Models\BrochureDetail;
use TypiCMS\Modules\Products\Models\Product;
use TypiCMS\Modules\Products\Models\ProductCategory;
use TypiCMS\Modules\Products\Models\ProductCategoryType;
use TypiCMS\Modules\Tags\Observers\TagObserver;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.products');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');
        $this->mergeConfigFrom(__DIR__.'/../config/config-product_categories.php', 'typicms.product_categories');
        $this->mergeConfigFrom(__DIR__.'/../config/config-product_category_types.php', 'typicms.product_category_types');

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['products' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'products');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/products'),
        ], 'views');

        $this->publishes([
            __DIR__.'/../resources/scss' => resource_path('scss'),
        ], 'resources');

        AliasLoader::getInstance()->alias('Products', Products::class);
        AliasLoader::getInstance()->alias('ProductCategories', ProductCategories::class);
        AliasLoader::getInstance()->alias('ProductCategoryTypes', ProductCategoryTypes::class);
        AliasLoader::getInstance()->alias('Brochures', Brochures::class);
        AliasLoader::getInstance()->alias('BrochureDetails', BrochureDetails::class);

        // Observers
        Product::observe(new SlugObserver());
        Product::observe(new TagObserver());
        ProductCategory::observe(new SlugObserver());
        ProductCategoryType::observe(new SlugObserver());

        /*
         * Sidebar view composer
         */
        $this->app->view->composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        $this->app->view->composer('products::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('products');
        });
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register(RouteServiceProvider::class);

        $app->bind('Products', Product::class);
        $app->bind('ProductCategories', ProductCategory::class);
        $app->bind('ProductCategoryTypes', ProductCategoryType::class);
        $app->bind('Brochures', Brochure::class);
        $app->bind('BrochureDetails', BrochureDetail::class);
    }
}
