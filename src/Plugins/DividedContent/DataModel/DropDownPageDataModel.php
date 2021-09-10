<?php

namespace rohsyl\OmegaPlugin\Bundle\Plugins\DividedContent\DataModel;

use rohsyl\OmegaCore\Models\Page;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\DropDown\ADropDownModel;

class DropDownPageDataModel extends ADropDownModel
{
    public function getKeyValueArray()
    {
        $page_id = $this->getEntry()->getIdPage();
        $pages = Page::query()
            ->where('parent_id', $page_id)
            ->get();
        $keyvalue = [];
        $keyvalue['null'] = __('Choose a page');
        if(sizeof($pages) > 0){
            foreach($pages as $page){
                $keyvalue[$page->id] = $page->title;
            }
        }
        return $keyvalue;
    }
}