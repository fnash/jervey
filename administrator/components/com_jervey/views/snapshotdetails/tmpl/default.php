<?php
    defined('_JEXEC') or die('Restricted access');
?>
<?php
        jimport('joomla.html.toolbar');

        $href = $this->baseurl.'/components/com_jervey/assets/css/toolbar.css'; 
        
        if ( version_compare( JVERSION, '1.6.0', 'ge' ) ) {
            $doc =& JFactory::getDocument();
            $attribs = array('type' => 'text/css'); 
            $doc->addHeadLink( $href, 'stylesheet', 'rel', $attribs );
        } else {
            global $mainframe;
            $mainframe->addCustomHeadTag ('<link rel="stylesheet" href="'.$href.' type="text/css" media="screen" />');
        }
        $bar = new JToolBar( 'toolbarsnapshot' );
        // appendButton method parameters
        // 1- button type from JButton
        // 2- css class - image of the button
        // 3- text to display on the button
        // 4- the task to set
        // 5- whether a selection must be made from an admin list before continuing.
        $bar->appendButton( 'standard', 'camera', JText::_('JERVEY_LANG_SAVE_SNAPSHOT'), 'snapshot', false );
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">

    <table width="100%">
        <tr>
            <td width="35%"></td>
            <td width="20%"><?php echo $bar->render(); ?></td>
            <td></td>
        </tr>
    </table>

    <br />

    <div>
        <?php echo JText::_('JERVEY_LANG_PICK_A_NAME_AND_A_DESCRIPTION_FOR_THE_SNAPSHOT'); ?>
    </div>
    <br />
    
<fieldset>
    <legend><?php echo JText::_('JERVEY_LANG_NAME'); ?></legend>
    <textarea cols="40" rows="3" name="name" ></textarea>
</fieldset>

<fieldset>
    <legend><?php echo JText::_('JERVEY_LANG_DESCRIPTION'); ?></legend>
    <textarea cols="40" rows="3" name="description" ></textarea>
</fieldset>
    
	<input type="hidden" name="option"     value="com_jervey" />
	<input type="hidden" name="controller" value="analysis" />
    <input type="hidden" name="task"       value="snapshot" />
    <?php  echo JHTML::_( 'form.token' ); ?>

</form>
