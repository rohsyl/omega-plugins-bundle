<?php


namespace rohsyl\OmegaPlugin\Bundle\Plugins;


use rohsyl\OmegaCore\Utils\Common\Plugin\Form\PluginFormFactory;
use rohsyl\OmegaCore\Utils\Common\Plugin\Plugin;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\DropDown\DropDown;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\TextSimple\TextSimple;

class PluginTitle extends Plugin
{
    const NAME = 'title';

    function name(): string
    {
        return self::NAME;
    }

    public function install() : bool {

        $this->createForm();

        return true;
    }

    private function createForm() {
        $levelParam = [
            "default" => 1,
            "options" => [
                "1" => "Title 1",
                "2" => "Title 2",
                "3" => "Title 3",
                "4" => "Title 4",
                "5" => "Title 5",
                "6"=> "Title 6"
            ]
        ];
        $this->makeForm(function(PluginFormFactory $builder) use ($levelParam) {
            $builder->form('Title', true, true);
            $builder->entry('title', TextSimple::class, null, 'Title', null, 0, false);
            $builder->entry('subtitle', TextSimple::class, null, 'Subtitle', null, 1, false);
            $builder->entry('level', DropDown::class, $levelParam, 'Level', 'The level of the title', 2, false);
        });

    }

    function overtController(): string
    {
        // TODO: Implement overtController() method.
    }
}