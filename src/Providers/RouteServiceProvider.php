<?php

namespace TypiCMS\Modules\Blocks\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Blocks\Http\Controllers\AdminController;
use TypiCMS\Modules\Blocks\Http\Controllers\ApiController;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define the routes for the application.
     */
    public function map()
    {
        Route::namespace($this->namespace)->group(function (Router $router) {
            /*
             * Admin routes
             */
            $router->middleware('admin')->prefix('admin')->group(function (Router $router) {
                $router->get('blocks', [AdminController::class, 'index'])->name('admin::index-blocks')->middleware('can:read blocks');
                $router->get('blocks/create', [AdminController::class, 'create'])->name('admin::create-block')->middleware('can:create blocks');
                $router->get('blocks/{block}/edit', [AdminController::class, 'edit'])->name('admin::edit-block')->middleware('can:update blocks');
                $router->post('blocks', [AdminController::class, 'store'])->name('admin::store-block')->middleware('can:create blocks');
                $router->put('blocks/{block}', [AdminController::class, 'update'])->name('admin::update-block')->middleware('can:update blocks');
            });

            /*
             * API routes
             */
            $router->middleware('api')->prefix('api')->group(function (Router $router) {
                $router->middleware('auth:api')->group(function (Router $router) {
                    $router->get('blocks', [ApiController::class, 'index'])->middleware('can:read blocks');
                    $router->patch('blocks/{block}', [ApiController::class, 'updatePartial'])->middleware('can:update blocks');
                    $router->delete('blocks/{block}', [ApiController::class, 'destroy'])->middleware('can:delete blocks');
                });
            });
        });
    }
}
