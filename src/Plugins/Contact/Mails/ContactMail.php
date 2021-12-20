<?php

namespace rohsyl\OmegaPlugin\Bundle\Plugins\Contact\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    private $inputs;

    public function __construct(array $inputs)
    {
        $this->inputs = $inputs;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject(__('Contact '.request()->getHost().' - Message from ' . $this->inputs['name']));
        $this->from('noreply@' . request()->getHost(), 'Omega contact');
        $this->replyTo($this->inputs['mail']);
        return $this->view('omega-plugin-bundle::overt.contact.mail', $this->inputs);
    }
}