<?php

namespace TypiCMS\Modules\Blocks\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'TypiCMS\Modules\Blocks\Http\Controllers';

    /**
     * Define the routes for the application.
     *
     * @return null
     */
    public function map()
    {
        Route::namespace($this->namespace)->group(function (Router $router) {
            /*
             * Admin routes
             */
            $router->middleware('admin')->prefix('admin')->group(function (Router $router) {
                $router->get('blocks', 'AdminController@index')->name('admin::index-blocks')->middleware('can:see-all-blocks');
                $router->get('blocks/create', 'AdminController@create')->name('admin::create-block')->middleware('can:create-block');
                $router->get('blocks/{block}/edit', 'AdminController@edit')->name('admin::edit-block')->middleware('can:update-block');
                $router->post('blocks', 'AdminController@store')->name('admin::store-block')->middleware('can:create-block');
                $router->put('blocks/{block}', 'AdminController@update')->name('admin::update-block')->middleware('can:update-block');
            });

            /*
             * API routes
             */
            $router->middleware('api')->prefix('api')->group(function (Router $router) {
                $router->middleware('auth:api')->group(function (Router $router) {
                    $router->get('blocks', 'ApiController@index')->name('api::index-blocks')->middleware('can:see-all-blocks');
                    $router->patch('blocks/{block}', 'ApiController@updatePartial')->name('api::update-block-ajax')->middleware('can:update-block');
                    $router->delete('blocks/{block}', 'ApiController@destroy')->name('api::destroy-block')->middleware('can:delete-block');
                });
            });
        });
    }
}
