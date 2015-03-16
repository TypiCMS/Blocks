<?php
namespace TypiCMS\Modules\Blocks\Providers;

use Config;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Lang;
use TypiCMS\Modules\Blocks\Models\Block;
use TypiCMS\Modules\Blocks\Repositories\CacheDecorator;
use TypiCMS\Modules\Blocks\Repositories\EloquentBlock;
use TypiCMS\Services\Cache\LaravelCache;
use View;

class ModuleProvider extends ServiceProvider
{

    public function boot()
    {

        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php', 'typicms.blocks'
        );

        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'blocks');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'blocks');

        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/blocks'),
        ], 'views');
        $this->publishes([
            __DIR__ . '/../database' => base_path('database'),
        ], 'migrations');
        $this->publishes([
            __DIR__ . '/../../tests' => base_path('tests'),
        ], 'tests');

        AliasLoader::getInstance()->alias(
            'Blocks',
            'TypiCMS\Modules\Blocks\Facades\Facade'
        );
    }

    public function register()
    {

        $app = $this->app;

        /**
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Blocks\Providers\RouteServiceProvider');

        /**
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Blocks\Composers\SidebarViewComposer');

        $app->bind('TypiCMS\Modules\Blocks\Repositories\BlockInterface', function (Application $app) {
            $repository = new EloquentBlock(new Block);
            if (! config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'blocks', 10);

            return new CacheDecorator($repository, $laravelCache);
        });

    }
}
