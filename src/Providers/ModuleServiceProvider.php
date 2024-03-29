<?php

namespace TypiCMS\Modules\Blocks\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Blocks\Composers\SidebarViewComposer;
use TypiCMS\Modules\Blocks\Facades\Blocks;
use TypiCMS\Modules\Blocks\Models\Block;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.blocks');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'blocks');

        $this->publishes([
            __DIR__.'/../../database/migrations/create_blocks_table.php.stub' => getMigrationFileName('create_blocks_table'),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/blocks'),
        ], 'views');

        AliasLoader::getInstance()->alias('Blocks', Blocks::class);

        Blade::directive('block', function ($name) {
            return "<?php echo Blocks::render({$name}) ?>";
        });

        View::composer('core::admin._sidebar', SidebarViewComposer::class);
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind('Blocks', Block::class);
    }
}
