<?php
namespace rohsyl\OmegaPlugin\Bundle\Http\Controllers\Overt\Redirect;

use rohsyl\OmegaCore\Utils\Common\Plugin\Controllers\OvertPluginController as Controller;

class PluginController extends Controller
{
    public function display($param, $data) {
        if(isset($data['url'])) {
            return redirect()->to($data['url']);
        }
        return $this->view('omega-plugin-bundle::overt.redirect.display')->with($data);
    }
}