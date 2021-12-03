<?php
namespace rohsyl\OmegaPlugin\Bundle\Plugins;

use rohsyl\OmegaCore\Utils\Common\Plugin\Form\PluginFormFactory;
use rohsyl\OmegaCore\Utils\Common\Plugin\Plugin;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\Checkbox\Checkbox;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\TextRich\TextRich;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\TextSimple\TextSimple;
use rohsyl\OmegaPlugin\Bundle\Http\Controllers\Overt\Contact\PluginController;

class PluginContact extends Plugin
{
    const NAME = 'contact';

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

    function adminIndex(): string {
        return route('omega-plugins-bundle.contacts.index');
    }

    public function install() : bool {

        $this->createForm();

        return true;
    }

    private function createForm() {

        $this->makeForm(function(PluginFormFactory $builder) {
            $builder->form('Contact', true, true);
            $builder->entry('recipient_email', TextSimple::class, null, 'Recipient E-Mail', 'Message sent with the contact form will be send to this mail address', 1, true);
            $builder->entry('confirmation_text', TextRich::class, null, 'Confirmation text', 'Text displayed to the user after he have sent his message', 2, true);
            $builder->entry('enable_recaptcha', Checkbox::class, ['checked' => false], 'Enable reCAPTCHA', 'Check this to enable reCAPTCHA on this form', 3, false);
        });

    }
}