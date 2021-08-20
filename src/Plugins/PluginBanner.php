<?php


namespace rohsyl\OmegaPlugin\Bundle\Plugins;


use rohsyl\OmegaCore\Models\Media;
use rohsyl\OmegaCore\Utils\Common\Plugin\Form\PluginFormFactory;
use rohsyl\OmegaCore\Utils\Common\Plugin\Plugin;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\MediaChooser\MediaChooser;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\TextRich\TextRich;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\TextSimple\TextSimple;
use rohsyl\OmegaPlugin\Bundle\Http\Controllers\Overt\Banner\PluginController;

class PluginBanner extends Plugin
{
    const NAME = 'banner';

    function name(): string
    {
        return self::NAME;
    }
    public function install() : bool {

        $this->createForm();

        return true;
    }

    private function createForm() {

        $this->makeForm(function(PluginFormFactory $builder) {
            $param = [
                'multiple' => false,
                'preview' => true,
                'type' => [Media::MT_PICTURE]
            ];
            $builder->form('Banner', true, false);
            $builder->entry('title', TextSimple::class, null, 'Title', null, 0, false);
            $builder->entry('text', TextRich::class, null, 'Text', null, 1, false);
            $builder->entry('background_image', MediaChooser::class, $param, 'Background image', null, 2, false);
            $builder->entry('action_url', TextSimple::class, null, 'Action', null, 3, false);
            $builder->entry('action_label', TextSimple::class, null, 'Action label', 'This is the label of the button, if empty the button is not displayed.', 4, false);
        });

    }

    function overtController(): string
    {
        return PluginController::class;
    }
}