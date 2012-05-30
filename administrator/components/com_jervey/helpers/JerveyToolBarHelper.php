<?php

defined('_JEXEC') or die('');

class JerveyToolBarHelper
{
    function title($title, $icon = 'generic.png')
    {

        $doc = & JFactory::getDocument();
        $href = $this->baseurl . '/components/com_jervey/assets/css/toolbar.css';
        $attribs = array('type' => 'text/css');
        $doc->addHeadLink($href, 'stylesheet', 'rel', $attribs);


        //strip the extension
        $icon = preg_replace('#\.[^.]*$#', '', $icon);

        if (version_compare(JVERSION, '1.6.0', 'ge'))
        {
            $html = "<div class=\"pagetitle icon-norepeat icon-48-$icon\">\n";
        }
        else
        {
            $html = "<div class=\"header icon-48-$icon\">\n";
        }
        $html .= "<h2>$title</h2>\n";
        $html .= "</div>\n";

        $mainframe = & JFactory::getApplication();
        $mainframe->set('JComponentTitle', $html);
    }

}
