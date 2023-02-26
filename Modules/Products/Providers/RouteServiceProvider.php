<?php

namespace TypiCMS\Modules\Products\Providers;

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
    protected $namespace = 'TypiCMS\Modules\Products\Http\Controllers';

    /**
     * Define the routes for the application.
     */
    public function map()
    {
        Route::namespace($this->namespace)->group(function (Router $router) {
            /*
             * Front office routes
             */
            if ($page = TypiCMS::getPageLinkedToModule('products')) {
                $router->middleware('public')->group(function (Router $router) use ($page) {
                    $options = $page->private ? ['middleware' => 'auth'] : [];
                    foreach (locales() as $lang) {
                        if ($page->translate('status', $lang) && $uri = $page->uri($lang)) {
                            // $router->get($uri, $options + ['uses' => 'PublicController@index'])->name($lang.'::index-products');
                           $router->get($uri.'/{categoryType}', $options + ['uses' => 'PublicController@productCategoryTypeDetail'])->name($lang.'::products-category-type');
                           $router->get($uri.'/{categoryType}/{category}', $options + ['uses' => 'PublicController@indexOfCategory'])->name($lang.'::products-category');
                           // $router->get($uri.'/{categoryType}/{category}/{slug}', $options + ['uses' => 'PublicController@show'])->name($lang.'::product');
                        }
                    }
                });
            }



            $router->middleware('public')->group(function (Router $router) {
                $router->get('brochures/{type}/{size}', 'PublicController@showBrochureList')->name('public::brochures');
                $router->get('brochure/{brochureId}/download', 'PublicController@download')->name('public::brochure-download');
            });

            /*
             * Admin routes
            */
            $router->middleware('admin')->prefix('admin')->group(function (Router $router) {
                $router->get('products', 'AdminController@index')->name('admin::index-products')->middleware('can:see-all-products');
                $router->get('products/create', 'AdminController@create')->name('admin::create-product')->middleware('can:create-product');
                $router->get('products/{product}/edit', 'AdminController@edit')->name('admin::edit-product')->middleware('can:update-product');
                $router->get('products/{product}/files', 'AdminController@files')->name('admin::edit-product-files')->middleware('can:update-product');
                $router->post('products', 'AdminController@store')->name('admin::store-product')->middleware('can:create-product');
                $router->put('products/{product}', 'AdminController@update')->name('admin::update-product')->middleware('can:update-product');

                $router->get('products/categories', 'CategoriesAdminController@index')->name('admin::index-product_categories')->middleware('can:see-all-product_categories');
                $router->get('products/categories/create', 'CategoriesAdminController@create')->name('admin::create-product_category')->middleware('can:create-product_category');
                $router->get('products/categories/{category}/edit', 'CategoriesAdminController@edit')->name('admin::edit-product_category')->middleware('can:update-product_category');
                $router->post('products/categories', 'CategoriesAdminController@store')->name('admin::store-product_category')->middleware('can:create-product_category');
                $router->put('products/categories/{category}', 'CategoriesAdminController@update')->name('admin::update-product_category')->middleware('can:update-product_category');

                $router->get('products/category-types', 'CategoryTypesAdminController@index')->name('admin::index-product_category_types')->middleware('can:see-all-product_category_types');
                $router->get('products/category-types/create', 'CategoryTypesAdminController@create')->name('admin::create-product_category_type')->middleware('can:create-product_category_types');
                $router->get('products/category-types/{category}/edit', 'CategoryTypesAdminController@edit')->name('admin::edit-product_category_type')->middleware('can:update-product_category_types');
                $router->post('products/category-types', 'CategoryTypesAdminController@store')->name('admin::store-product_category_type')->middleware('can:create-product_category_types');
                $router->put('products/category-types/{category}', 'CategoryTypesAdminController@update')->name('admin::update-product_category_type')->middleware('can:update-product_category_types');

                $router->get('brochures','BrochuresAdminController@index')->name('admin::index-brochures')->middleware('can:see-all-brochures');
                $router->get('brochures/create', 'BrochuresAdminController@create')->name('admin::create-brochures')->middleware('can:create-brochures');
                $router->get('brochures/{brochure}/edit', 'BrochuresAdminController@edit')->name('admin::edit-brochures')->middleware('can:update-brochures');
                $router->post('brochures', 'BrochuresAdminController@store')->name('admin::store-brochures')->middleware('can:create-brochures');
                $router->post('brochure/{brochureId}', 'BrochuresAdminController@update')
                    ->name('admin::update-brochures')->middleware('can:update-brochures');

                $router->get('brochure-details/{brochureId}','BrochureDetailsAdminController@index')->name('admin::index-brochure-details')->middleware('can:see-all-brochure-details');
                $router->get('brochure-details/{brochureId}/create', 'BrochureDetailsAdminController@create')->name('admin::create-brochure-details')->middleware('can:create-brochure-details');
                $router->get('brochure-details/{brochure_detail}/edit', 'BrochureDetailsAdminController@edit')->name('admin::edit-brochure-details')->middleware('can:update-brochure-details');
                $router->post('brochure-details/{brochureId}/save', 'BrochureDetailsAdminController@store')->name('admin::store-brochure-details')->middleware('can:create-brochure-details');
                $router->put('brochure-details/{brochure_detail}/update', 'BrochureDetailsAdminController@update')->name('admin::update-brochure-details')->middleware('can:update-brochure-details');
                $router->delete('brochure-details/{brochure_details}', 'BrochureDetailsAdminController@destroy')->name('admin::delete-brochure-detail')->middleware('can:delete-brochure-details');

            });

            /*
             * API routes
             */
            $router->middleware('api')->prefix('api')->group(function (Router $router) {
                $router->middleware('auth:api')->group(function (Router $router) {
                    $router->get('products', 'ApiController@index')->middleware('can:see-all-products');
                    $router->patch('products/{product}', 'ApiController@updatePartial')->middleware('can:update-product');
                    $router->delete('products/{product}', 'ApiController@destroy')->middleware('can:delete-product');

                    $router->get('products/{product}/files', 'ApiController@files')->middleware('can:update-product');
                    $router->post('products/{product}/files', 'ApiController@attachFiles')->middleware('can:update-product');
                    $router->delete('products/{product}/files/{file}', 'ApiController@detachFile')->middleware('can:update-product');

                    $router->get('products/categories', 'CategoriesApiController@index')->middleware('can:see-all-product_categories');
                    $router->patch('products/categories/{category}', 'CategoriesApiController@updatePartial')->middleware('can:update-product_category');
                    $router->post('products/categories/sort', 'CategoriesApiController@sort')->middleware('can:update-product_category');
                    $router->delete('products/categories/{category}', 'CategoriesApiController@destroy')->middleware('can:delete-product_category');

                    $router->get('products/category-types', 'CategoryTypesApiController@index')->middleware('can:see-all-product_category_types');
                    $router->patch('products/category-types/{category}', 'CategoryTypesApiController@updatePartial')->middleware('can:update-product_category_types');
                    $router->post('products/category-types/sort', 'CategoryTypesApiController@sort')->middleware('can:update-product_category_types');
                    $router->delete('products/category-types/{category}', 'CategoryTypesApiController@destroy')->middleware('can:delete-product_category_types');

                    $router->get('brochures', 'BrochuresApiController@index')->middleware('can:see-all-brochures');
                    $router->patch('brochures/{brochure}', 'BrochuresApiController@updatePartial')->middleware('can:update-brochures');
                    $router->delete('brochures/{brochure}', 'BrochuresApiController@destroy')->middleware('can:delete-brochures');

                    $router->get('brochures-details/{brochureId}', 'BrochureDetailsApiController@index')->middleware('can:see-all-brochure-details');
                    $router->patch('brochure-details/{brochure_details}', 'BrochureDetailsApiController@updatePartial')->middleware('can:update-brochure-details');
                    $router->delete('brochure-details/{brochure_details}', 'BrochureDetailsApiController@destroy')->middleware('can:delete-brochure-details');

                });
            });
        });
    }
}
