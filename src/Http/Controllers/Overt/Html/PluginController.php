<?php
namespace rohsyl\OmegaPlugin\Bundle\Http\Controllers\Overt\Html;

use rohsyl\OmegaCore\Utils\Common\Plugin\Controllers\OvertPluginController as Controller;

class PluginController extends Controller
{
    public function display($param, $data) {

        return $this->view('omega-plugin-bundle::overt.html.display')->with($data);
    }
}