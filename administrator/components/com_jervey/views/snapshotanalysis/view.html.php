<?php
/**
 * jervey Component Snapshot Analysis View
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


class jerveyViewSnapshotAnalysis extends JView
{
    function display($tpl = null)
    {
        $model = $this->getModel('analysis');

        $cids = JRequest::getVar( 'cid', array(0) ) ;
        $snapshot_id = (int)$cids[0];

        $analysis = $model->getSnapshotAnalysis($snapshot_id);
        $this->assignRef( 'analysis', $analysis );

        $analysisType = $analysis->analysis_type_id;
        switch ($analysisType)
        {
            case 1: // frequency
                $this->setLayout('frequency');
            
                $snapshot_survey       = $model->getSnapshotSurvey($snapshot_id);
                $snapshot_question     = $model->getSnapshotQuestions($snapshot_id);
                $snapshot_propositions = $model->getSnapshotPropositions($snapshot_question[0]->id);

                $this->assignRef( 'survey',       $snapshot_survey );
                $this->assignRef( 'question',     $snapshot_question );
                $this->assignRef( 'propositions', $snapshot_propositions );
                break;

            case 2: // cross tab
                $this->setLayout('crosstab');
                break;

            case 3: // custom
                $this->setLayout('custom');
                break;
        }


        JToolBarHelper::title(   JText::_( 'JERVEY_LANG_FREQUENCY_ANALYSIS_SNAPSHOT' ) );

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
        $bar->appendButton( 'link', 'cancel', JText::_('JERVEY_LANG_BACK'), 'index.php?option=com_jervey&controller=analysis' );

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
