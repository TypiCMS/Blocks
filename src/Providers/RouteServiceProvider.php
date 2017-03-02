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
        Route::group(['namespace' => $this->namespace], function (Router $router) {
            /*
             * Admin routes
             */
            $router->group(['middleware' => 'admin', 'prefix' => 'admin'], function (Router $router) {
                $router->get('blocks', 'AdminController@index')->name('admin::index-blocks');
                $router->get('blocks/create', 'AdminController@create')->name('admin::create-block');
                $router->get('blocks/{block}/edit', 'AdminController@edit')->name('admin::edit-block');
                $router->post('blocks', 'AdminController@store')->name('admin::store-block');
                $router->put('blocks/{block}', 'AdminController@update')->name('admin::update-block');
                $router->patch('blocks/{ids}', 'AdminController@ajaxUpdate')->name('admin::update-block');
                $router->delete('blocks/{ids}', 'AdminController@destroyMultiple')->name('admin::destroy-block');
            });
        });
    }
}
