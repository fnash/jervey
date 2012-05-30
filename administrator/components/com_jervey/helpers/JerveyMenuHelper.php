<?php

class jerveyMenuHelper
{

    function addTopMenu($highlight)
    {
        
    }

    function addEntry($name, $link = '', $active = false)
    {
        $menu = &JToolBar::getInstance('jervey_submenu1');
        $menu->appendButton($name, $link, $active);
    }

}
