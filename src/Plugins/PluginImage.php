<?php
namespace rohsyl\OmegaPlugin\Bundle\Plugins;

use rohsyl\OmegaCore\Models\Media;
use rohsyl\OmegaCore\Utils\Common\Plugin\Form\PluginFormFactory;
use rohsyl\OmegaCore\Utils\Common\Plugin\Plugin;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\MediaChooser\MediaChooser;
use rohsyl\OmegaPlugin\Bundle\Http\Controllers\Overt\Image\PluginController;

class PluginImage extends Plugin
{
    const NAME = 'image';

    /**
     * Here name your plugin
     * @return string
     */
    public function name() : string {
        return self::NAME;
    }

    function overtController(): string
    {
        return PluginController::class;
    }

    public function install() : bool {

        $this->createForm();

        return true;
    }

    private function createForm() {

        $param = [
            'multiple' => false,
            'preview' => true,
            'type' => [Media::MT_PICTURE]
        ];
        $this->makeForm(function(PluginFormFactory $builder) use ($param) {
            $builder->form('Image', true, true);
            $builder->entry('url', MediaChooser::class, $param, 'Image', null, 0, false);
        });

    }
}