<?php
namespace rohsyl\OmegaPlugin\Bundle\Plugins\DividedContent;

use rohsyl\OmegaCore\Utils\Common\Plugin\Form\PluginFormFactory;
use rohsyl\OmegaCore\Utils\Common\Plugin\Plugin;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\DropDown\DropDown;
use rohsyl\OmegaPlugin\Bundle\Http\Controllers\Overt\DividedContent\PluginController;
use rohsyl\OmegaPlugin\Bundle\Plugins\DividedContent\DataModel\DropDownPageDataModel;
use rohsyl\OmegaPlugin\Bundle\Plugins\DividedContent\DataModel\TypeDataModel;

class PluginDividedContent extends Plugin
{
    const NAME = 'divided_content';

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
            $pageIdParam = ['model' => DropDownPageDataModel::class];
            $typeParam = ['model' => TypeDataModel::class];
            $builder->form('Teaser', true, false);
            $builder->entry('page_id', DropDown::class, $pageIdParam, 'Page', 'Select the page that contains components you want to insert as divided content. Be carefull, it must be a child of this page.', 0, false);
            $builder->entry('type', DropDown::class, $typeParam, 'Type', 'How to divide the content', 1, false);
        });

    }

    function overtController(): string
    {
        return PluginController::class;
    }
}