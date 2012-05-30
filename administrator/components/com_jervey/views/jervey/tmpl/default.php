<?php 

defined('_JEXEC') or die('Restricted access'); 

function cpanelButton($label, $link, $image)
{
    return 
        '<div class="icon">
            <a href="'.$link.'">
                <img alt="" src="'.$image.'">
                <span>'.$label.'</span>
            </a>
        </div>
        ';
}

?>

<div id="cpanel">
    <div class="icon">
        <a href="index.php?option=com_jervey&controller=questions&task=edit&cid[]=0">
            <img alt="" src="/jervey/administrator/templates/bluestork/images/header/icon-48-article-add.png">
            <span><?php echo JText::_('JERVEY_LANG_NEW_QUESTION') ?></span>
        </a>
    </div>
</div>