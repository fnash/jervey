<?php
    defined('_JEXEC') or die('Restricted access');
    $prevSessionImgPath = JURI::root().'administrator/components/com_jervey/assets/images/left_arrow.png';
    if ($this->previousSession)
    {
        $prevSessionUrl = 'index.php?option=com_jervey&controller=sessions&task=viewSession&id='.$this->previousSession->id.'&cid[]='.$this->previousSession->survey_id;
    }

    $nextSessionImgPath = JURI::root().'administrator/components/com_jervey/assets/images/right_arrow.png';
    if ($this->nextSession)
    {
        $nextSessionUrl = 'index.php?option=com_jervey&controller=sessions&task=viewSession&id='.$this->nextSession->id.'&cid[]='.$this->nextSession->survey_id;
    }


?>
<table width="100%">
    <tr>
        <?php if ($this->previousSession): ?>
        <td valign="top" width="32">
            <a href="<?php echo $prevSessionUrl ?>">
                <img title="<?php echo JText::_('JERVEY_LANG_PREVIOUS_SESSION') ?>" alt="<?php echo JText::_('JERVEY_LANG_PREVIOUS_SESSION') ?>" src="<?php echo $prevSessionImgPath ?>"  />
            </a>
        </td>
        <?php endif; ?>
        <td>
    <table class="adminlist">
        <thead>
            <tr>
                <th><?php echo JText::_('JERVEY_LANG_USER'); ?></th>
                <th width="110"><?php echo JText::_('JERVEY_LANG_SUBMIT_DATE'); ?></th>
                <th width="110"><?php echo JText::_('JERVEY_LANG_IP_ADDRESS'); ?></th>
                <th><?php echo JText::_('JERVEY_LANG_SURVEY'); ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td align="center"><?php echo ($this->session->user_name)? $this->session->user_name : JText::_('JERVEY_LANG_ANONYMOUS') ?></td>
                <td align="center"><?php echo $this->session->submit_date ?></td>
                <td align="center"><?php echo $this->session->ip_address ?></td>
                <td align="center"><?php echo $this->survey->title ?></td>
            </tr>
        </tbody>
    </table>
            </td>
            <?php if ($this->nextSession): ?>
            <td valign="top" width="32">
                <a href="<?php echo $nextSessionUrl ?>">
                    <img title="<?php echo JText::_('JERVEY_LANG_NEXT_SESSION') ?>" alt="<?php echo JText::_('JERVEY_LANG_NEXT_SESSION') ?>" src="<?php echo $nextSessionImgPath ?>"  />
                </a>
            </td>
            <?php endif; ?>
    </tr>
    </table>
<fieldset>
    <legend><?php echo JText::_('JERVEY_LANG_ANSWERS'); ?></legend>
    <table class="adminlist">
        <thead>
  <tr>
      <th width="50%"><?php echo JText::_('JERVEY_LANG_QUESTION'); ?></th>
    <th><?php echo JText::_('JERVEY_LANG_ANSWER'); ?></th>
  </tr>
        </thead>
<?php
$questionsEcho = array();
$answersEcho   = array();

$question_id = null;

foreach ($this->questions as $question)
{
    if ($question_id != $question->question_id) // new question
    {
        if ( ! is_null($question_id)) { // not the first question
            $questionsEcho[$question_id] .= '</ul>';
        }
        $question_id = $question->question_id;
        $questionsEcho[$question_id] = $question->statement.'<br /><ul>';
        $answersEcho[$question_id] = '';
    }
    // add prop
    if ($question->type_id == 2 || $question->type_id == 3) {
            $questionsEcho[$question_id] .= '<li>'.$question->proposition.'</li>';
        }
    elseif ($question->type_id != 1) {
            $questionsEcho[$question_id] .= '<li>'.$question->row_title.'</li>';
    }
}

$answer_question_id = null;
foreach ($this->answers as $answer)
{
    if ($answer_question_id != $answer->id) // new question
    {
        if ( ! is_null($answer_question_id)) { // not the first question
            $answersEcho[$answer_question_id] .= '</ul>';
        }
        $answer_question_id = $answer->id;
        $answersEcho[$answer_question_id] = '<ul>';
    }
    // add answer
    $answersEcho[$answer_question_id] .= '<li>';
    if ( ! is_null($answer->row_title)) {
        $answersEcho[$answer_question_id] .= $answer->row_title.':  ';
    }
    $answersEcho[$answer_question_id] .= $answer->answer.'<br />';
    if ($answer->altanswer == '') {
        $answersEcho[$answer_question_id] .= '</li>';
    }
    else {
        $answersEcho[$answer_question_id] .= JText::_('JERVEY_LANG_ALTANSWER').': '.$answer->altanswer.'</li>';
    }
}

?>
        <tbody>
<?php
foreach ($questionsEcho as $key => $question)
{
    echo '<tr><td>'.$question.'</td>';
    echo '<td>'.$answersEcho[$key].'</td></tr>';
}
?>
        </tbody>
</table>

</fieldset>
