<?php
namespace rohsyl\OmegaPlugin\Bundle\Plugins;

use rohsyl\OmegaCore\Models\Media;
use rohsyl\OmegaCore\Utils\Common\Plugin\Form\PluginFormFactory;
use rohsyl\OmegaCore\Utils\Common\Plugin\Plugin;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\MediaChooser\MediaChooser;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\TextSimple\TextSimple;
use rohsyl\OmegaPlugin\Bundle\Http\Controllers\Overt\Image\PluginController;
use rohsyl\OmegaPlugin\Bundle\Plugins\Image\ImageFormRenderer;

class PluginImage extends Plugin
{
    const NAME = 'image';

    public function __construct()
    {
        $this->setFormRendererComponent(new ImageFormRenderer());
    }

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
            $builder->entry('width', TextSimple::class, null, 'Width', null, 1, false);
            $builder->entry('height', TextSimple::class, null, 'Height', null, 2, false);
        });

    }
}