<?php
namespace rohsyl\OmegaPlugin\Bundle\Http\Controllers\Overt\DividedContent;

use rohsyl\OmegaCore\Models\Page;
use rohsyl\OmegaCore\Utils\Common\Plugin\Controllers\OvertPluginController as Controller;

define('TYPE_COL_2', 1);
define('TYPE_COL_3', 2);
define('TYPE_COL_4', 3);
define('TYPE_TABS', 4);
define('TYPE_COLLAPSE', 5);
define('TYPE_SLIDER', 6);

class PluginController extends Controller
{
    public function display($param, $data) {
        $data['id'] = $param['settings']['compId'];
        $data['componentsView'] = [];
        if(isset($data['page_id']['value'])) {
            $data['componentsView'] = Page::find($data['page_id']['value'])->getComponentsViewArray();
        }
        switch($data['type']['value']){
            case TYPE_COL_2:
                $data['countCol'] = 2;
                return $this->view('omega-plugin-bundle::overt.divided_content.display_column')->with($data);
            case TYPE_COL_3:
                $data['countCol'] = 3;
                return $this->view('omega-plugin-bundle::overt.divided_content.display_column')->with($data);
            case TYPE_COL_4:
                $data['countCol'] = 4;
                return $this->view('omega-plugin-bundle::overt.divided_content.display_column')->with($data);
            case TYPE_TABS:
                return $this->view('omega-plugin-bundle::overt.divided_content.display_tabs')->with($data);
            case TYPE_COLLAPSE:
                return $this->view('omega-plugin-bundle::overt.divided_content.display_collapse')->with($data);
            case TYPE_SLIDER:
                return $this->view('omega-plugin-bundle::overt.divided_content.display_slider')->with($data);
        }
        return null;
    }
}