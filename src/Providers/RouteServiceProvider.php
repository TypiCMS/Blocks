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
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function (Router $router) {
            /*
             * Admin routes
             */
            $router->get('admin/blocks', ['as' => 'admin.blocks.index', 'uses' => 'AdminController@index']);
            $router->get('admin/blocks/create', ['as' => 'admin.blocks.create', 'uses' => 'AdminController@create']);
            $router->get('admin/blocks/{block}/edit', ['as' => 'admin.blocks.edit', 'uses' => 'AdminController@edit']);
            $router->post('admin/blocks', ['as' => 'admin.blocks.store', 'uses' => 'AdminController@store']);
            $router->put('admin/blocks/{block}', ['as' => 'admin.blocks.update', 'uses' => 'AdminController@update']);

            /*
             * API routes
             */
            $router->get('api/blocks', ['as' => 'api.blocks.index', 'uses' => 'ApiController@index']);
            $router->put('api/blocks/{block}', ['as' => 'api.blocks.update', 'uses' => 'ApiController@update']);
            $router->delete('api/blocks/{block}', ['as' => 'api.blocks.destroy', 'uses' => 'ApiController@destroy']);
        });
    }
}
