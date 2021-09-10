<?php


namespace rohsyl\OmegaPlugin\Bundle\Plugins;


use rohsyl\OmegaCore\Models\Media;
use rohsyl\OmegaCore\Utils\Common\Plugin\Form\PluginFormFactory;
use rohsyl\OmegaCore\Utils\Common\Plugin\Plugin;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\MediaChooser\MediaChooser;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\TextRich\TextRich;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\TextSimple\TextSimple;
use rohsyl\OmegaPlugin\Bundle\Http\Controllers\Overt\Teaser\PluginController;

class PluginTeaser extends Plugin
{
    const NAME = 'teaser';

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
            $builder->form('Teaser', true, false);
            $builder->entry('title', TextSimple::class, null, 'Title', null, 0, false);
            $builder->entry('subtitle', TextSimple::class, null, 'Subtitle', null, 1, false);
            $builder->entry('text', TextRich::class, null, 'Text', null, 2, false);
            $builder->entry('image', MediaChooser::class, $param, 'Image', null, 3, false);
            $builder->entry('action_url', TextSimple::class, null, 'Action url', 'Show abutton that will redirect the user to the given url.', 4, false);
            $builder->entry('action_label', TextSimple::class, null, 'Action label', 'Label of the button. Leave empty to hide the button', 5, false);
        });

    }

    function overtController(): string
    {
        return PluginController::class;
    }
}