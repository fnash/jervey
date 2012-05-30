<?php
    defined('_JEXEC') or die('Restricted access');

    require_once (JPATH_COMPONENT . DS . 'helpers' . DS . 'JerveyHtmlHelper.php');

    $currentSession = &JFactory::getSession();
    $checkedSessions = $currentSession->get('sessions_to_export', array());
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
<div align="center">
<a href="javascript:document.adminForm.submit();SqueezeBox.close();">
    <img  width="32" height="32" src="components/com_jervey/assets/images/place.png" alt="<?php echo JText::_('JERVEY_LANG_SELECT_SESSIONS'); ?>" title="<?php echo JText::_('JERVEY_LANG_SELECT_SESSIONS'); ?>" />
    <br /><?php echo JText::_('JERVEY_LANG_SELECT_SESSIONS'); ?>
</a>
</div>
	<div id="editcell">
		<table class="adminlist">
		<thead>
			<tr>
				<th width="20">
						<?php echo JText::_( '#' ); ?>
				</th>
				<th width="20">
					<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->sessions ); ?>);" />
				</th>
				<th>
					<?php echo JText::_('JERVEY_LANG_USER'); ?>
				</th>
                <th>
					<?php echo JText::_('JERVEY_LANG_IP_ADDRESS'); ?>
				</th>
                <th>
					<?php echo JText::_('JERVEY_LANG_SUBMIT_DATE'); ?>
				</th>
                <th width="20">
					<?php echo JText::_('JERVEY_LANG_ID'); ?>
				</th>
  			</tr>
		</thead>
		<tbody>
		<?php
			if ( count($this->sessions)) :
				$k = 0;
				for ($i = 0, $n = count( $this->sessions ) ; $i < $n ; $i++) :
					$row =& $this->sessions[$i];
					if ( in_array($row->id, $checkedSessions) ) {
                        $checked = JerveyHtmlHelper::getJhtmlGridId($i, $row->id, true );
                    }
                    else {
                        $checked = JerveyHtmlHelper::getJhtmlGridId($i, $row->id);
                    }
		?>
					<tr class="<?php echo "row$k"; ?>">
						<td align="center">
							<?php echo $i+1; ?>
						</td>
						<td>
							<?php echo $checked; ?>
						</td>
                        <td>
                            <?php echo ( ! is_null($row->user_name)) ? $row->user_name : JText::_('JERVEY_LANG_ANONYMOUS'); ?>
						</td>
                        <td>
							<?php echo $row->ip_address ; ?>
						</td>
                        <td>
							<?php echo $row->submit_date ; ?>
						</td>
						<td>
							<?php echo $row->id; ?>
						</td>
					</tr>
					<?php
					$k = 1 - $k;
				endfor ;
			else :
				echo '<tr><td colspan="6">' . JText::_('JERVEY_LANG_THERE_ARE_NO_RECORDS') . '</td></tr>' ;
			endif ;
		?>
        </tbody>
    </table>
</div>
	<input type="hidden" name="option"     value="com_jervey" />
	<input type="hidden" name="controller" value="datamanager" />
	<input type="hidden" name="task"       value="registersessions" />
	<input type="hidden" name="boxchecked" value="0" />
	<?php  echo JHTML::_( 'form.token' ); ?>
</form>