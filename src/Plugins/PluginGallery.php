<?php
namespace rohsyl\OmegaPlugin\Bundle\Plugins;

use rohsyl\OmegaCore\Models\Media;
use rohsyl\OmegaCore\Utils\Common\Plugin\Form\PluginFormFactory;
use rohsyl\OmegaCore\Utils\Common\Plugin\Plugin;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\Checkbox\Checkbox;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\MediaChooser\MediaChooser;
use rohsyl\OmegaPlugin\Bundle\Http\Controllers\Overt\Gallery\PluginController;

class PluginGallery extends Plugin
{
    const NAME = 'gallery';

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
            'multiple' => true,
            'preview' => true,
            'type' => [Media::MT_PICTURE, Media::MT_VIDEO, Media::MT_VIDEO_EXT, Media::MT_DOCUMENT, Media::MT_FOLDER]
        ];
        $this->makeForm(function(PluginFormFactory $builder) use ($param) {
            $builder->form('Gallery', true, true);
            $builder->entry('items', MediaChooser::class, $param, 'Pictures', null, 0, false);
            $builder->entry('hide_titles', Checkbox::class, ['checked' => false], 'Hide title and description', 'Check this to hide title and description of each pictures on the gallery', 1, false);
        });

    }
}