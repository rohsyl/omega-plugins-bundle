<?php
namespace rohsyl\OmegaPlugin\Bundle\Http\Controllers\Admin\Contact;

use rohsyl\OmegaCore\Utils\Common\Plugin\Controllers\AdminPluginController as Controller;
use rohsyl\OmegaPlugin\Bundle\Http\Requests\Admin\Contact\UpdateContactConfigRequest;

class ContactController extends Controller
{
    public function index() {

        $contact_config = json_decode(om_config('omega_plugins_bundle::contact.config'), true) ?? [];

        return view('omega-plugin-bundle::admin.contact.index')->with($contact_config);
    }

    public function update(UpdateContactConfigRequest $request) {

        $input = $request->validated();

        om_config(['omega_plugins_bundle::contact.config' => json_encode($input)]);

        return redirect()->route('omega-plugins-bundle.contacts.index');
    }
}