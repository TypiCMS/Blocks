<?php

namespace TypiCMS\Modules\Blocks\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

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
     * @param \Illuminate\Routing\Router $router
     *
     * @return null
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function (Router $router) {
            /*
             * Admin routes
             */
            $router->get('admin/blocks', 'AdminController@index')->name('admin::index-blocks');
            $router->get('admin/blocks/create', 'AdminController@create')->name('admin::create-block');
            $router->get('admin/blocks/{block}/edit', 'AdminController@edit')->name('admin::edit-block');
            $router->post('admin/blocks', 'AdminController@store')->name('admin::store-block');
            $router->put('admin/blocks/{block}', 'AdminController@update')->name('admin::update-block');

            /*
             * API routes
             */
            $router->get('api/blocks', 'ApiController@index')->name('api::index-blocks');
            $router->put('api/blocks/{block}', 'ApiController@update')->name('api::update-block');
            $router->delete('api/blocks/{block}', 'ApiController@destroy')->name('api::destroy-block');
        });
    }
}
