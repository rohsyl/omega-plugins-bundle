<?php
namespace rohsyl\OmegaPlugin\Bundle;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as SP;
use rohsyl\OmegaCore\Utils\Common\Facades\Plugin as PluginManager;
use rohsyl\OmegaPlugin\Bundle\Plugins\PluginBanner;
use rohsyl\OmegaPlugin\Bundle\Plugins\PluginHtml;
use rohsyl\OmegaPlugin\Bundle\Plugins\PluginRedirect;
use rohsyl\OmegaPlugin\Bundle\Plugins\PluginText;
use rohsyl\OmegaPlugin\Bundle\Plugins\PluginTitle;

class ServiceProvider extends SP
{

    public function register() {

    }

    public function boot() {

        $this->publishes([
            __DIR__.'/../resources/views/overt' => resource_path('views/vendor/omega-plugin-bundle/overt'),
        ]);

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/omega/plugin/bundle'),
        ], 'public');

        // load routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        // load migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // load views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'omega-plugin-bundle');

        PluginManager::register(new PluginText());
        PluginManager::register(new PluginRedirect());
        PluginManager::register(new PluginTitle());
        PluginManager::register(new PluginHtml());
        PluginManager::register(new PluginBanner());
    }
}