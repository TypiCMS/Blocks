<?php

namespace TypiCMS\Modules\Blocks\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Blocks\Models\Block;
use TypiCMS\Modules\Blocks\Repositories\EloquentBlock;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.blocks'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['blocks' => []], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'blocks');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'blocks');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/blocks'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Blocks',
            'TypiCMS\Modules\Blocks\Facades\Blocks'
        );
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Blocks\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Blocks\Composers\SidebarViewComposer');

        $app->bind('Blocks', EloquentBlock::class);
    }
}
