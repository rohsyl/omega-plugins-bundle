<?php
namespace rohsyl\OmegaPlugin\Bundle\Http\Controllers\Overt\Title;

use rohsyl\OmegaCore\Utils\Common\Plugin\Controllers\OvertPluginController as Controller;

class PluginController extends Controller
{
    public function display($param, $data) {

        return $this->view('omega-plugin-bundle::overt.title.display')->with($data);
    }
}