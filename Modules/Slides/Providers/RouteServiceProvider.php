<?php

namespace TypiCMS\Modules\Slides\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Core\Facades\TypiCMS;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'TypiCMS\Modules\Slides\Http\Controllers';

    /**
     * Define the routes for the application.
     */
    public function map()
    {
        Route::namespace($this->namespace)->group(function (Router $router) {
            /*
             * Front office routes
             */
            if ($page = TypiCMS::getPageLinkedToModule('slides')) {
                $router->middleware('public')->group(function (Router $router) use ($page) {
                    $options = $page->private ? ['middleware' => 'auth'] : [];
                    foreach (locales() as $lang) {
                        if ($page->translate('status', $lang) && $uri = $page->uri($lang)) {
                            $router->get($uri, $options + ['uses' => 'PublicController@index'])->name($lang.'::index-slides');
                            $router->get($uri.'/{slug}', $options + ['uses' => 'PublicController@show'])->name($lang.'::slide');
                        }
                    }
                });
            }

            /*
             * Admin routes
             */
            $router->middleware('admin')->prefix('admin')->group(function (Router $router) {
                $router->get('slides', 'AdminController@index')->name('admin::index-slides')->middleware('can:see-all-slides');
                $router->get('slides/create', 'AdminController@create')->name('admin::create-slide')->middleware('can:create-slide');
                $router->get('slides/{slide}/edit', 'AdminController@edit')->name('admin::edit-slide')->middleware('can:update-slide');
                $router->get('slides/{slide}/files', 'AdminController@files')->name('admin::edit-slide-files')->middleware('can:update-slide');
                $router->post('slides', 'AdminController@store')->name('admin::store-slide')->middleware('can:create-slide');
                $router->put('slides/{slide}', 'AdminController@update')->name('admin::update-slide')->middleware('can:update-slide');
            });

            /*
             * API routes
             */
            $router->middleware('api')->prefix('api')->group(function (Router $router) {
                $router->middleware('auth:api')->group(function (Router $router) {
                    $router->get('slides', 'ApiController@index')->middleware('can:see-all-slides');
                    $router->patch('slides/{slide}', 'ApiController@updatePartial')->middleware('can:update-slide');
                    $router->delete('slides/{slide}', 'ApiController@destroy')->middleware('can:delete-slide');

                    $router->get('slides/{slide}/files', 'ApiController@files')->middleware('can:update-slide');
                    $router->post('slides/{slide}/files', 'ApiController@attachFiles')->middleware('can:update-slide');
                    $router->delete('slides/{slide}/files/{file}', 'ApiController@detachFile')->middleware('can:update-slide');
                  });
            });
        });
    }
}
