<?php

namespace rohsyl\OmegaPlugin\Bundle\Plugins\Image;

use rohsyl\OmegaCore\Utils\Common\Plugin\Form\Renderer\PluginFormRenderer;

class ImageFormRenderer extends PluginFormRenderer
{
    public function render()
    {
        $entry = $this->getEntries();
        return view('omega-plugin-bundle::admin.image.form', compact('entry'));
    }
}