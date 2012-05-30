<?php
    defined('_JEXEC') or die('Restricted access');

    $cssUrl = JRoute::_("components/com_jervey/assets/css/default.css");
    $document =& JFactory::getDocument();
    $document->addStyleSheet($cssUrl);
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="editcell">
    <table class="adminlist">
        <thead>
        <th width="20">
            <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->users ); ?>);" />
	</th>
        <th width="30"><?php echo JText::_('JERVEY_LANG_ID'); ?></th>
        <th><?php echo JText::_( 'JERVEY_LANG_NAME' ); ?></th>
        <th width="500"><?php echo JText::_('JERVEY_LANG_AUTHORIZATION'); ?></th>
        </thead>
        <tbody>
        <?php
                $k = 0;
                $num = 0;
                foreach ($this->users as $user) :
                        $num++;
                        $checked = JHTML::_( 'grid.id', $num-1, $user->id );
                        if ($user->is_affected == 0)
                        {
                            $linkAffected = JRoute::_( 'index.php?option=com_jervey&controller=surveys&task=assignUser&cid[]=' . $this->survey_id.'&uid='.$user->id );
                            $echoAffected = JText::_('JERVEY_LANG_UNAUTHORIZED');
                            $classAffected = 'red';
                        }
                        elseif ($user->is_affected == 1)
                        {
                            $linkAffected = JRoute::_( 'index.php?option=com_jervey&controller=surveys&task=unassignUser&cid[]=' . $this->survey_id.'&uid='.$user->id );
                            $echoAffected = JText::_('JERVEY_LANG_AUTHORIZED');
                            $classAffected = 'green';
                        }
        ?>
        <tr class="<?php echo "row$k"; ?>">
            <td><?php echo $checked; ?></td>
            <td><?php echo $user->id; ?></td>
            <td><?php echo $user->name; ?></td>
            <td align="center">
                <a class="<?php echo $classAffected; ?>" href="<?php echo $linkAffected; ?>">
                    <?php echo $echoAffected; ?>
                </a>
            </td>
        </tr>
        <?php
                $k = 1 - $k;
                endforeach;
        ?>
        </tbody>

    </table>
</div>
	<input type="hidden" name="option"     value="com_jervey" />
	<input type="hidden" name="controller" value="surveys" />
	<input type="hidden" name="task"       value="authorizeUsers" />
        <input type="hidden" name="survey_id"  value="<?php echo $this->survey_id ?>" />
	<input type="hidden" name="boxchecked" value="0" />
	<?php  echo JHTML::_( 'form.token' ); ?>
</form>
