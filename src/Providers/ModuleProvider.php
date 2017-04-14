<?php

namespace TypiCMS\Modules\Blocks\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Blocks\Composers\SidebarViewComposer;
use TypiCMS\Modules\Blocks\Facades\Blocks;
use TypiCMS\Modules\Blocks\Repositories\EloquentBlock;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.blocks'
        );
        $this->mergeConfigFrom(
            __DIR__.'/../config/permissions.php', 'typicms.permissions'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['blocks' => []], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'blocks');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'blocks');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/blocks'),
        ], 'views');

        AliasLoader::getInstance()->alias('Blocks', Blocks::class);

        Blade::directive('block', function ($name) {
            return "<?php echo Blocks::render($name) ?>";
        });
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register(RouteServiceProvider::class);

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', SidebarViewComposer::class);

        $app->bind('Blocks', EloquentBlock::class);
    }
}
