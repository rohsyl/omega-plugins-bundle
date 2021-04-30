<?php
namespace rohsyl\OmegaPlugin\Bundle\Plugins;

use rohsyl\OmegaCore\Utils\Common\Plugin\Form\PluginFormFactory;
use rohsyl\OmegaCore\Utils\Common\Plugin\Plugin;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\TextSimple\TextSimple;
use rohsyl\OmegaPlugin\Bundle\Http\Controllers\Overt\Redirect\PluginController;

class PluginRedirect extends Plugin
{
    const NAME = 'redirect';

    /**
     * Here name your plugin
     * @return string
     */
    public function name() : string {
        return self::NAME;
    }

    public function install() : bool {

        $this->createForm();

        return true;
    }

    private function createForm() {

        $this->makeForm(function(PluginFormFactory $builder) {
            $builder->form('Redirect', true, true);
            $builder->entry('url', TextSimple::class, null, 'Url', 'Url to redirect to', 0, false);
        });

    }

    function overtController(): string
    {
        return PluginController::class;
    }
}