<?php

namespace TypiCMS\Modules\Teams\Providers;

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
    protected $namespace = 'TypiCMS\Modules\Teams\Http\Controllers';

    /**
     * Define the routes for the application.
     */
    public function map()
    {
        Route::namespace($this->namespace)->group(function (Router $router) {
            /*
             * Front office routes
             */
            if ($page = TypiCMS::getPageLinkedToModule('teams')) {
                $router->middleware('public')->group(function (Router $router) use ($page) {
                    $options = $page->private ? ['middleware' => 'auth'] : [];
                    foreach (locales() as $lang) {
                        if ($page->translate('status', $lang) && $uri = $page->uri($lang)) {
                            $router->get($uri, $options + ['uses' => 'PublicController@index'])->name($lang.'::index-teams');
                            $router->get($uri.'/{slug}', $options + ['uses' => 'PublicController@show'])->name($lang.'::team');
                        }
                    }
                });
            }

            /*
             * Admin routes
             */
            $router->middleware('admin')->prefix('admin')->group(function (Router $router) {
                $router->get('teams', 'AdminController@index')->name('admin::index-teams')->middleware('can:see-all-teams');
                $router->get('teams/create', 'AdminController@create')->name('admin::create-team')->middleware('can:create-team');
                $router->get('teams/{team}/edit', 'AdminController@edit')->name('admin::edit-team')->middleware('can:update-team');
                $router->get('teams/{team}/files', 'AdminController@files')->name('admin::edit-team-files')->middleware('can:update-team');
                $router->post('teams', 'AdminController@store')->name('admin::store-team')->middleware('can:create-team');
                $router->put('teams/{team}', 'AdminController@update')->name('admin::update-team')->middleware('can:update-team');
            });

            /*
             * API routes
             */
            $router->middleware('api')->prefix('api')->group(function (Router $router) {
                $router->middleware('auth:api')->group(function (Router $router) {
                    $router->get('teams', 'ApiController@index')->middleware('can:see-all-teams');
                    $router->patch('teams/{team}', 'ApiController@updatePartial')->middleware('can:update-team');
                    $router->delete('teams/{team}', 'ApiController@destroy')->middleware('can:delete-team');

                    $router->get('teams/{team}/files', 'ApiController@files')->middleware('can:update-team');
                    $router->post('teams/{team}/files', 'ApiController@attachFiles')->middleware('can:update-team');
                    $router->delete('teams/{team}/files/{file}', 'ApiController@detachFile')->middleware('can:update-team');
                  });
            });
        });
    }
}
