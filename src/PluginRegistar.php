<?php


namespace rohsyl\OmegaPlugin\Bundle;


use rohsyl\OmegaCore\Utils\Common\Facades\Plugin as PluginManager;
use rohsyl\OmegaCore\Utils\Common\Plugin\Plugin;
use rohsyl\OmegaPlugin\Bundle\Plugins\PluginBanner;
use rohsyl\OmegaPlugin\Bundle\Plugins\PluginHtml;
use rohsyl\OmegaPlugin\Bundle\Plugins\PluginImage;
use rohsyl\OmegaPlugin\Bundle\Plugins\PluginRedirect;
use rohsyl\OmegaPlugin\Bundle\Plugins\PluginText;
use rohsyl\OmegaPlugin\Bundle\Plugins\PluginTitle;

class PluginRegistar
{
    private static $plugins = [
        PluginText::class,
        PluginRedirect::class,
        PluginTitle::class,
        PluginHtml::class,
        PluginBanner::class,
        PluginImage::class,
    ];

    public static function getRegisteredPlugins() {
        return self::$plugins;
    }

    public static function register() {
        foreach(self::$plugins as $plugin) {
            if(is_subclass_of($plugin, Plugin::class)) {
                PluginManager::register(new $plugin());
            }
        }
    }
}