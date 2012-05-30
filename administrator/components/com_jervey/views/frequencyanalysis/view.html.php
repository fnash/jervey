<?php
/**
 * jervey Component Frequency analysis View
 *
 * @version     $Id$
 * @author      IP-Tech Labs <labs@iptech-offshore.com>
 * @copyright   2010 IP-Tech
 * @package     jervey-Back-End
 * @subpackage  Views
 * @link        http://www.iptechinside.com/labs/projects/show/jquarks-for-surveys
 * @since       1.0.0
 * @license     GNU/GPL2
 *
 *    This program is free software; you can redistribute it and/or
 *  modify it under the terms of the GNU General Public License
 *  as published by the Free Software Foundation; version 2
 *  of the License.
 *
 *    This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *  along with this program; if not, write to the Free Software
 *  Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *  or see <http://www.gnu.org/licenses/>
 */

defined('_JEXEC') or die();

jimport('joomla.application.component.view');


class jerveyViewFrequencyanalysis extends JView
{
    function display($tpl = null)
    {
        $survey_id = JRequest::getVar('sid');
        $question_id = JRequest::getVar('qid');
        $row_id = JRequest::getVar('rid');

        $model = $this->getModel('analysis');

        $survey = $model->getSurveyStats($survey_id);
        $this->assignRef( 'survey', $survey );

        $question = $model->getQuestion($question_id);
        $this->assignRef( 'question', $question );
        $row_title = $model->getRowTitle($row_id);
        $this->assignRef( 'row_title', $row_title );

        $propositions =& $model->getPropositions($question_id);
        $this->assignRef( 'propositions', $propositions );

        $sessions =& $model->getSessionsForFrequency();
        $this->assignRef( 'sessions', $sessions );

        if ($question->type == '3')
        {
            $this->_layout = 'multiplechoice';
            
            $questionModel = JModel::getInstance('question', 'jerveyModel');
            $propositionsStats = $questionModel->getPropositionsStats($question->id);
            $this->assignRef( 'propositionsStats', $propositionsStats );
        }

        JToolBarHelper::title(   JText::_( 'JERVEY_LANG_FREQUENCY_ANALYSIS' ) );

        $bar=& JToolBar::getInstance( 'toolbar' );
        // appendButton method parameters
        // 1- button type from JButton
        // 2- css class - image of the button
        // 3- text to display on the button
        // 4- the task to set
        // 5- whether a selection must be made from an admin list before continuing.
        $href = $this->baseurl.'/components/com_jervey/assets/css/toolbar.css'; 
        
        if ( version_compare( JVERSION, '1.6.0', 'ge' ) ) {
            $doc =& JFactory::getDocument();
            $attribs = array('type' => 'text/css'); 
            $doc->addHeadLink( $href, 'stylesheet', 'rel', $attribs );
        } else {
            global $mainframe;
            $mainframe->addCustomHeadTag ('<link rel="stylesheet" href="'.$href.' type="text/css" media="screen" />');
        }
        
        // TODO: code temporaire
        // afficher la camera que si le snapshot est disponible
        // actuellement le snapshot n'est pas dispo pour les multiple choice questions
        if ($question->type != '3') {
            $bar->appendButton( 'popup', 'camera', JText::_('JERVEY_LANG_TAKE_SNAPSHOT'), 'index.php?option=com_jervey&controller=analysis&task=snapshotDetails' );
        }
        $bar->appendButton( 'link', 'cancel', JText::_('JERVEY_LANG_BACK'), 'index.php?option=com_jervey&controller=analysis&task=selectQuestions&cid[]='.$survey_id );
        

        // SUBMENU
        JSubMenuHelper::addEntry( JText::_( 'JERVEY_LANG_HOME' ), 'index.php?option=com_jervey');
        JSubMenuHelper::addEntry( JText::_( 'JERVEY_LANG_SURVEYS' ),        'index.php?option=com_jervey&controller=surveys');
        JSubMenuHelper::addEntry( JText::_( 'JERVEY_LANG_SECTIONS'),        'index.php?option=com_jervey&controller=sections');
        JSubMenuHelper::addEntry( JText::_( 'JERVEY_LANG_QUESTIONS' ),      'index.php?option=com_jervey&controller=questions');
        JSubMenuHelper::addEntry( JText::_( 'JERVEY_LANG_ANSWERS' ),       'index.php?option=com_jervey&controller=sessions');
        JSubMenuHelper::addEntry( JText::_( 'JERVEY_LANG_ANALYSES' ),       'index.php?option=com_jervey&controller=analysis');
        JSubMenuHelper::addEntry( JText::_( 'JERVEY_LANG_IMPORT_EXPORT' ),  'index.php?option=com_jervey&controller=datamanager');

        parent::display($tpl);
    }
}
