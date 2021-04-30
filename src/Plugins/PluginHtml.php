<?php


namespace rohsyl\OmegaPlugin\Bundle\Plugins;


use rohsyl\OmegaCore\Utils\Common\Plugin\Form\PluginFormFactory;
use rohsyl\OmegaCore\Utils\Common\Plugin\Plugin;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\HtmlEditor\HtmlEditor;

class PluginHtml extends Plugin
{
    const NAME = 'html';

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
            $builder->form('Html', true, true);
            $builder->entry('html', HtmlEditor::class, null, 'Html', null, 0, false);
        });

    }

    function overtController(): string
    {
        // TODO: Implement overtController() method.
    }
}