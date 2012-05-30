<?php
    defined('_JEXEC') or die('Restricted access');
?>
<table border="0" width="100%">
    <tr>
        <td width="50%">
<fieldset>
    <legend><?php echo JText::_('JERVEY_LANG_EXPORT'); ?></legend>
    <?php echo JText::_('JERVEY_LANG_SELECT_DATA_TYPE_YOU_WANT_TO_EXPORT'); ?>
    <form action="index.php" method="post" name="adminForm" id="adminForm">
    <table class="adminform">
        <tr>
            <td>
            <div><input type="radio" name="export_type" value="1"><?php echo JText::_('JERVEY_LANG_ANSWERS'); ?></div>
            <div><input type="radio" name="export_type" value="2"><?php echo JText::_('JERVEY_LANG_QUESTIONS').' (not available)'; ?></div>
            <div><input type="radio" name="export_type" value="3"><?php echo JText::_('JERVEY_LANG_SURVEYS').' (not available)'; ?></div>
            <div><input type="radio" name="export_type" value="4"><?php echo JText::_('JERVEY_LANG_SURVEY_AND_ITS_SECTIONS_AND_QUESTIONS').' (not available)'; ?></div>
            </td>
            <td>
                <?php
                    jimport('joomla.html.toolbar');
                    $barExport = new JToolBar( 'toolbarExport' );
                    $barExport->appendButton( 'standard', 'apply', JText::_('JERVEY_LANG_GO'), 'export', false );
                    echo $barExport->render();
                ?>
                
            </td>
        </tr>
    </table>
                <input type="hidden" name="option"     value="com_jervey" />
                <input type="hidden" name="controller" value="datamanager" />
                <input type="hidden" name="task"       value="" />
                </form>
</fieldset>

        </td>
        <td>
<fieldset>
    <legend><?php echo JText::_('JERVEY_LANG_IMPORT').' (not available)'; ?></legend>
    <div style="height: 120px"></div>
</fieldset>
        </td>

</tr>
</table>
