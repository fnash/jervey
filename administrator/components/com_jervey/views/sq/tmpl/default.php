<?php
    defined('_JEXEC') or die('Restricted access');
?>

<form action="index.php" method="post" name="adminForm" id="adminForm">
<div align="center">
<?php
    if ($this->action == 'setTask') {
?>
    <a href="javascript:document.adminForm.submit();SqueezeBox.close();">
    <img  width="32" height="32" src="components/com_jervey/assets/images/place.png" alt="<?php echo JText::_('JERVEY_LANG_SET_QUESTIONS'); ?>" title="<?php echo JText::_('JERVEY_LANG_SET_QUESTIONS'); ?>" />
    <br /><?php echo JText::_('JERVEY_LANG_SET_QUESTIONS'); ?>
    </a>
    <?php } else { ?>
    <a href="javascript:document.adminForm.submit();SqueezeBox.close();">
    <img  width="32" height="32" src="components/com_jervey/assets/images/unplace.png" alt="<?php echo JText::_('JERVEY_LANG_UNSET_QUESTIONS'); ?>" title="<?php echo JText::_('JERVEY_LANG_UNSET_QUESTIONS'); ?>" />
    <br /><?php echo JText::_('JERVEY_LANG_UNSET_QUESTIONS'); ?>
    </a>
    <?php } ?>
</div>

<div class="editcell">
    <table class="adminlist">
        <thead>
        <th width="20">
			<?php echo JText::_( 'JERVEY_LANG_NUM' ); ?>
		</th>
        <th width="20">
         <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->questions ); ?>);" />
        </th>
        <th><?php echo JText::_('JERVEY_LANG_QUESTION'); ?></th>
        <th width="20"><?php echo JText::_('JERVEY_LANG_ID'); ?></th>
        </thead>
        <tbody>
        <?php
                if (count($this->questions)) :
                $k = 0;
                $i = 0;
                foreach ($this->questions as $question) :
                        $checked = JHTML::_( 'grid.id', $i, $question->id );
        ?>
        <tr class="<?php echo "row$k"; ?>">
            <td><?php echo $i+1; ?></td>
            <td><?php echo $checked; ?></td>
            <td><?php echo $question->statement; ?></td>
            <td><?php echo $question->id; ?></td>
        </tr>
        <?php
                $k = 1 - $k;
                $i++;
                endforeach;
        ?>
        <?php else :
				echo '<tr><td colspan="6">' . JText::_('JERVEY_LANG_THERE_ARE_NO_RECORDS') . '</td></tr>' ;
			endif ;
        ?>
        </tbody>

    </table>
</div>


    <input type="hidden" name="option"     value="com_jervey" />
	<input type="hidden" name="controller" value="sq" />
    <input type="hidden" name="task"       value="<?php echo $this->action ; ?>" />
    <input type="hidden" name="id"         value="<?php echo $this->section_id ; ?>" />
    <input type="hidden" name="boxchecked" value="0" />
    <?php  echo JHTML::_( 'form.token' ); ?>
</form>
