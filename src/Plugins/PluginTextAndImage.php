<?php
namespace rohsyl\OmegaPlugin\Bundle\Plugins;

use rohsyl\OmegaCore\Models\Media;
use rohsyl\OmegaCore\Utils\Common\Plugin\Form\PluginFormFactory;
use rohsyl\OmegaCore\Utils\Common\Plugin\Plugin;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\TextRich\TextRich;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\MediaChooser\MediaChooser;
use rohsyl\OmegaPlugin\Bundle\Http\Controllers\Overt\TextAndImage\PluginController;


class PluginTextAndImage extends Plugin
{
    const NAME = 'text_and_image';

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

        $param = [
            'multiple' => false,
            'preview' => true,
            'type' => [Media::MT_PICTURE]
        ];
        $this->makeForm(function(PluginFormFactory $builder) use ($param) {
            $builder->form('TextAndImage', true, true);
            $builder->entry('text', TextRich::class, null, 'Text', null, 0, false);
            $builder->entry('url', MediaChooser::class, $param, 'Image', null, 0, false);
        });

    }

    function overtController(): string
    {
        return PluginController::class;
    }
}