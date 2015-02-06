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
use TypiCMS\Modules\Blocks\Services\Form\BlockForm;
use TypiCMS\Modules\Blocks\Services\Form\BlockFormLaravelValidator;
use TypiCMS\Services\Cache\LaravelCache;
use View;

class ModuleProvider extends ServiceProvider
{

    public function boot()
    {
        // Bring in the routes
        require __DIR__ . '/../routes.php';

        // Add dirs
        View::addNamespace('blocks', __DIR__ . '/../views/');
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'blocks');
        $this->publishes([
            __DIR__ . '/../config/' => config_path('typicms/blocks'),
        ], 'config');
        $this->publishes([
            __DIR__ . '/../migrations/' => base_path('/database/migrations'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Blocks',
            'TypiCMS\Modules\Blocks\Facades\Facade'
        );
    }

    public function register()
    {

        $app = $this->app;

        /**
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Blocks\Composers\SideBarViewComposer');

        $app->bind('TypiCMS\Modules\Blocks\Repositories\BlockInterface', function (Application $app) {
            $repository = new EloquentBlock(new Block);
            if (! Config::get('app.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'blocks', 10);

            return new CacheDecorator($repository, $laravelCache);
        });

        $app->bind('TypiCMS\Modules\Blocks\Services\Form\BlockForm', function (Application $app) {
            return new BlockForm(
                new BlockFormLaravelValidator($app['validator']),
                $app->make('TypiCMS\Modules\Blocks\Repositories\BlockInterface')
            );
        });

    }
}
