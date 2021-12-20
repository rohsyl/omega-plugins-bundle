<?php
namespace rohsyl\OmegaPlugin\Bundle\Http\Controllers\Overt\Contact;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;
use rohsyl\OmegaPlugin\Bundle\Plugins\Contact\Mails\ContactMail;
use rohsyl\OmegaCore\Utils\Common\Facades\OmegaUtils;
use rohsyl\OmegaCore\Utils\Common\Plugin\Controllers\OvertPluginController as Controller;

class PluginController extends Controller
{
    const RE_CAPCHAT_URL = 'https://www.google.com/recaptcha/api/siteverify';
    const RE_CAPCHAT_JS = 'https://www.google.com/recaptcha/api.js?render=';
    const RE_CAPCHAT_THRESHOLD = 0.5;

    public function display($param, $data) {

        $contact_config = $this->getConfig();

        $request = request();
        $isAntispam = isset($data['enable_recaptcha'])
            && isset($contact_config['key_site'])
            && isset($contact_config['key_secret']) ? $data['enable_recaptcha'] : false;

        if ($request->isMethod('post')){
            return $this->sendMail($request, $isAntispam, $contact_config, $data);
        }

        if ($isAntispam) {
            OmegaUtils::addDependencies([
                'js' => [self::RE_CAPCHAT_JS . $contact_config['key_site']]
            ]);
        }

        $data['isAntispam'] = $isAntispam;
        $data['key_site'] = $contact_config ? $contact_config['key_site'] ?? null : null;
        return $this->view('omega-plugin-bundle::overt.contact.display')->with($data);
    }

    public function sendMail(Request $request, $isAntispam, $contact_config, $data) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'mail' => 'required|email',
            'phone' => 'nullable|string',
            'text' => 'required|string',
            'g-recaptcha-response' => [
                Rule::requiredIf($isAntispam),
                'string',
            ]
        ]);

        if($isAntispam){
            $validator->after(function ($validator) use ($request, $contact_config) {
                if (!$this->reCapchatValidated($request, $contact_config)) {
                    $validator->errors()->add('recaptcha', __('Error while validating captcha'));
                }
            });
        }

        if($validator->fails()){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $mail = $data['recipient_email'];

        Mail::to($mail)
            ->send(
                new ContactMail(
                    Arr::except($validator->validated(), ['g-recaptcha-response'])
                )
            );

        return redirect()->back()->with('success', $data['confirmation_text'] ?? __('Thanks for your message !'));
    }

    /**
     * Request to Google reCAPCHAT to validate capchat
     * @param $request
     * @param $contact_config
     * @return bool
     */
    private function reCapchatValidated($request, $contact_config) : bool {
        if ($request->has('g-recaptcha-response')){
            $response = Http::asForm()->post(self::RE_CAPCHAT_URL, [
                'secret' => $contact_config['key_secret'],
                'response' => $request->input('g-recaptcha-response'),
            ]);
            if ($response->ok()){
                $content = $response->json();
                if ($content['success']) {
                    if ($content['score'] > self::RE_CAPCHAT_THRESHOLD){
                        // all good, it's not a bot !
                        return true;
                    }
                }
            }
        }
        return false;
    }

    /**
     * Get contact config
     * @return array
     */
    private function getConfig() : array {
        return json_decode(om_config('omega_plugins_bundle::contact.config'), true) ?? [];
    }
}