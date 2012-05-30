<?php 
    defined('_JEXEC') or die('Restricted access');

    JHTML::_('behavior.tooltip');
?>

<div style="float:left;">
<br />
<h2><?php echo 'Jervey '.JERVEY_VERSION; ?></h2>
<ul>
    <li>Create your questions and place them into sections</li>
    <li>Lay out your survey and arrange its sections</li>
    <li>Visualize stats, charts and Save Snapshots</li>
    <li>Export answers in data tables to easy processsing in MS Excel</li>
</ul>

<div id="cpanel">
    <div class="icon">
        <a href="/jervey/administrator/index.php?option=com_content&amp;task=article.add">
            <img alt="" src="/jervey/administrator/templates/bluestork/images/header/icon-48-article-add.png">
            <span>Add New Article</span>
        </a>
    </div>
    <div class="icon">
        <a href="/jervey/administrator/index.php?option=com_content&amp;task=article.add">
            <img alt="" src="/jervey/administrator/templates/bluestork/images/header/icon-48-article-add.png">
            <span>Add New Article</span>
        </a>
    </div>    
</div>

</div>
<div style="float:left;">
    <fieldset>
        <div> 
            <div>
<?php
jimport('joomla.html.toolbar');

$doc =& JFactory::getDocument();
$href = $this->baseurl.'/components/com_jervey/assets/css/toolbar.css'; 
$attribs = array('type' => 'text/css'); 
$doc->addHeadLink( $href, 'stylesheet', 'rel', $attribs );


$bar1 = new JToolBar( 'toolbarTop' );
// appendButton method parameters
        // 1- button type from JButton
        // 2- css class - image of the button
        // 3- text to display on the button
        // 4- the task to set
        // 5- whether a selection must be made from an admin list before continuing.
$bar1->appendButton( 'link', 'question', JText::_('JERVEY_LANG_NEW_QUESTION'), 
        'index.php?option=com_jervey&controller=questions&task=edit&cid[]=0', false );
$bar1->appendButton( 'link', 'section',  JText::_('JERVEY_LANG_NEW_SECTION'),  
        'index.php?option=com_jervey&controller=sections&task=edit&cid[]=0', false );
$bar1->appendButton( 'link', 'survey',   JText::_('JERVEY_LANG_NEW_SURVEY'),   
        'index.php?option=com_jervey&controller=surveys&task=edit&cid[]=0', false );
echo $bar1->render();
?>
</div>
            <div style="clear: both;">
<?php

$bar2 = new JToolBar( 'toolbarBottom' );
$bar2->appendButton( 'link', 'session', JText::_('JERVEY_LANG_ANSWERS'),
        'index.php?option=com_jervey&controller=sessions', false );
$bar2->appendButton( 'link', 'chart',  JText::_('JERVEY_LANG_MAKE_ANALYSIS'),
        'index.php?option=com_jervey&controller=analysis&task=makeAnalysis', false );
$bar2->appendButton( 'link', 'export',   JText::_('JERVEY_LANG_EXPORT_ANSWERS'),
        'index.php?option=com_jervey&controller=datamanager&task=export&export_type=1', false );
echo $bar2->render();
?>
</div>
        </div>
    </fieldset>
</div>
<div style="float:left;width:425px;">
        <?php

        jimport('joomla.html.pane');

        $pane =& JPane::getInstance('sliders', array('startOffset' => 0, 'startTransition' => 0));
        echo $pane->startPane( 'surveyParamPane' );

        echo $pane->startPanel( JText::_('JERVEY_LANG_LAST_SURVEYS'), 'lastSurveys' );
        echo '<table class="adminlist">';
        echo '<thead><tr>';
        echo '<th>'.JText::_('JERVEY_LANG_SURVEY').'</th><th width="20%"># '.JText::_('JERVEY_LANG_QUESTIONS').'</th><th width="20%">'.JText::_('JERVEY_LANG_SAMPLE_SIZE').'</th>';
        echo '</thead>';
        echo '<tbody>';
        if (count($this->lastSurveys) == 0) {
                echo '<tr><td colspan="3">' . JText::_('JERVEY_LANG_THERE_ARE_NO_RECORDS') . '</td></tr>' ;
        }
        else
        {
            foreach ($this->lastSurveys AS $survey)
            {
                $linkSurvey = JRoute::_( 'index.php?option=com_jervey&controller=surveys&task=edit&cid[]=' . $survey->id );
                echo '<tr>';
                echo '<td><a href="'.$linkSurvey.'">'.$survey->title.'</a></td>';
                echo '<td>'.$survey->nbr_questions.'</td>';
                echo '<td>'.$survey->population.'</td>';
                echo '</tr>';
            }
        }
        echo '</tbody>';
        echo '</table>';
        echo $pane->endPanel();

        echo $pane->startPanel( JText::_('JERVEY_LANG_LAST_ANALYSIS'), 'lastAnalysis' );
        echo '<table class="adminlist">';
        echo '<thead><tr>';
        echo '<th>'.JText::_('JERVEY_LANG_ANALYSIS').'</th>';
        echo '<th width="20%">'.JText::_('JERVEY_LANG_TYPE').'</th>';
        echo '<th width="30%">'.JText::_('JERVEY_LANG_SAVE_DATE').'</th>';
        echo '</tr></thead>';

        echo '<tbody>';
        if (count($this->lastAnalysis) == 0) {
                echo '<tr><td colspan="3">' . JText::_('JERVEY_LANG_THERE_ARE_NO_RECORDS') . '</td></tr>' ;
        }
        else
        {
            foreach ($this->lastAnalysis AS $analysis)
            {
                $linkAnalysis = JRoute::_( 'index.php?option=com_jervey&controller=analysis&task=viewAnalysis&cid[]=' . $analysis->id );

                echo '<tr>';
                echo '<td><a href="'.$linkAnalysis.'" >'. JHTML::tooltip($analysis->description, $analysis->name, '', $analysis->name) .'</a></td>';
                echo '<td>'.JText::_($analysis->type).'</td>';
                echo '<td>'.$analysis->save_date.'</td>';
                echo '</tr>';
            }
        }
        echo '</tbody>';
        echo '</table>';
        echo $pane->endPanel();

        
        echo $pane->startPanel( JText::_('JERVEY_LANG_LAST_SESSIONS'), 'lastSessions' );
        echo '<table class="adminlist">';
        echo '<thead><tr>';
        echo '<th width="20%">'.JText::_('JERVEY_LANG_VIEW_ANSWERS').'</th>';
        echo '<th width="30%">'.JText::_('JERVEY_LANG_USER').'</th>';
        echo '<th width="30%">'.JText::_('JERVEY_LANG_SUBMIT_DATE').'</th>';
        echo '<th width="20%">'.JText::_('JERVEY_LANG_IP_ADDRESS').'</th>';
        echo '</tr></thead>';

        echo '<tbody>';
        if (count($this->lastSessions) == 0) {
                echo '<tr><td colspan="4">' . JText::_('JERVEY_LANG_THERE_ARE_NO_RECORDS') . '</td></tr>' ;
        }
        else
        {
            foreach ($this->lastSessions AS $session)
            {
                $linkSession = JRoute::_( 'index.php?option=com_jervey&controller=sessions&task=viewSession&id='. $session->id . '&cid[]=' . $session->survey_id );

                echo '<tr>';
                echo '<td><a href="'.$linkSession.'" >'.JText::_('JERVEY_LANG_VIEW_ANSWERS').'</a></td>';
                echo '<td>';
                echo ( ! is_null($session->user_name)) ? $session->user_name : JText::_('JERVEY_LANG_ANONYMOUS');
                echo '</td>';
                echo '<td>'.$session->submit_date.'</td>';
                echo '<td>'.$session->ip_address.'</td>';
                echo '</tr>';
            }
        }
        echo '</tbody>';

        echo '</table>';
        echo $pane->endPanel();

        echo $pane->endPane();

        ?>
</div>