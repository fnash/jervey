<?php
    defined('_JEXEC') or die('Restricted access');
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">

	<div id="editcell">

<table class="adminlist">
    <thead>
  <tr>
    <th width="20">#</th>
    <th width="20">
        <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->sessions ); ?>);" />
    </th>
    <th width="100"><?php  echo JText::_('JERVEY_LANG_VIEW_ANSWERS'); ?></th>
    <th width="220"><?php echo JText::_('JERVEY_LANG_USER'); ?></th>
    <th width="120"><?php echo JText::_('JERVEY_LANG_SUBMIT_DATE'); ?></th>
    <th width="120"><?php echo JText::_('JERVEY_LANG_IP_ADDRESS'); ?></th>
    <th width="50"><?php  echo JText::_('JERVEY_LANG_SURVEY_ID'); ?></th>
    <th width="120"><?php echo JText::_('JERVEY_LANG_EDIT_SURVEY'); ?></th>
    <th width="120"><?php echo JText::_('JERVEY_LANG_VIEW_SURVEY'); ?></th>
    <th width="50"><?php echo JText::_('JERVEY_LANG_SESSION_ID'); ?></th>
  </tr>
    </thead>
    <tbody>
  <?php
			if ( count($this->sessions)) :
				$k = 0;
				for ($i = 0, $n = count( $this->sessions ) ; $i < $n ; $i++) :
					$row =& $this->sessions[$i];
					$checked = JHTML::_( 'grid.id', $i, $row->id );
					$linkSurvey  = JRoute::_( 'index.php?option=com_jervey&controller=surveys&task=edit&cid[]='. $row->id );
                                        $linkSession = JRoute::_( 'index.php?option=com_jervey&controller=sessions&task=viewSession&id='. $row->id . '&cid[]=' . $row->survey_id );
                                        $linkGoToSurvey = JURI::root().'index.php?option=com_jervey&controller=survey&id='.$row->survey_id;
                    
					?>
					<tr class="<?php echo "row$k"; ?>">
						<td align="center">
							<?php echo $i+1; ?>
						</td>
						<td>
							<?php echo $checked; ?>
						</td>
						<td>
							<a href="<?php echo $linkSession; ?>" ><?php echo JText::_('JERVEY_LANG_VIEW_ANSWERS'); ?></a>
						</td>
                        <td>
							<?php echo ( ! is_null($row->user_name)) ? $row->user_name : JText::_('JERVEY_LANG_ANONYMOUS'); ?>
						</td>
						<td>
							<?php echo $row->submit_date; ?>
						</td>
                        <td>
							<?php echo $row->ip_address; ?>
						</td>
                        <td>
							<?php echo $row->survey_id; ?>
						</td>
						<td>
                            <a href="<?php echo $linkSurvey; ?>" ><?php echo JText::_('JERVEY_LANG_EDIT_SURVEY'); ?></a>
						</td>
                        <td>
                            <a target="_blank" href="<?php echo $linkGoToSurvey; ?>" ><?php echo JText::_('JERVEY_LANG_GO_TO_SURVEY'); ?></a>
						</td>
                        <td>
							<?php echo $row->id; ?>
						</td>
					</tr>
					<?php
					$k = 1 - $k;
				endfor ;
			else :
				echo '<tr><td colspan="10">' . JText::_('JERVEY_LANG_THERE_ARE_NO_RECORDS') . '</td></tr>' ;
			endif ;
		?>
    </tbody>
</table>

</div>

	<input type="hidden" name="option"     value="com_jervey" />
	<input type="hidden" name="controller" value="sessions" />
	<input type="hidden" name="task"       value="" />
	<input type="hidden" name="boxchecked" value="0" />
    <?php  echo JHTML::_( 'form.token' ); ?>
</form>