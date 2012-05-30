<?php
/**
 * jervey Component Analysis View
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


class jerveyViewAnalysis extends JView
{
    function display($tpl = null)
    {   
        $analysis =& $this->get( 'analysis' );
        $this->assignRef( 'analysis', $analysis );

        // TOOLBAR
        JerveyToolBarHelper::title( JText::_( 'JERVEY_LANG_ANALYSIS' ), 'analysis.png' );

        $bar=& JToolBar::getInstance( 'toolbar' );
        
        $href = $this->baseurl.'/components/com_jervey/assets/css/toolbar.css'; 
        
        if ( version_compare( JVERSION, '1.6.0', 'ge' ) ) {
            $doc =& JFactory::getDocument();
            $attribs = array('type' => 'text/css'); 
            $doc->addHeadLink( $href, 'stylesheet', 'rel', $attribs );
        } else {
            global $mainframe;
            $mainframe->addCustomHeadTag ('<link rel="stylesheet" href="'.$href.' type="text/css" media="screen" />');
        }
        
        $bar->appendButton( 'link', 'chart', JText::_('JERVEY_LANG_MAKE_ANALYSIS'), 'index.php?option=com_jervey&amp;controller=analysis&amp;task=makeAnalysis' );

        JToolBarHelper::deleteList(JText::_('JERVEY_LANG_CONFIRM_SUPPRESSION_RECORDS'));
		

        // SUBMENU
        JSubMenuHelper::addEntry( JText::_( 'JERVEY_LANG_HOME' ), 'index.php?option=com_jervey');
        JSubMenuHelper::addEntry( JText::_( 'JERVEY_LANG_SURVEYS' ),        'index.php?option=com_jervey&controller=surveys');
        JSubMenuHelper::addEntry( JText::_( 'JERVEY_LANG_SECTIONS'),        'index.php?option=com_jervey&controller=sections');
        JSubMenuHelper::addEntry( JText::_( 'JERVEY_LANG_QUESTIONS' ),      'index.php?option=com_jervey&controller=questions');
        JSubMenuHelper::addEntry( JText::_( 'JERVEY_LANG_ANSWERS' ),       'index.php?option=com_jervey&controller=sessions');
        JSubMenuHelper::addEntry( JText::_( 'JERVEY_LANG_ANALYSES' ),       'index.php?option=com_jervey&controller=analysis', true);
        JSubMenuHelper::addEntry( JText::_( 'JERVEY_LANG_IMPORT_EXPORT' ),  'index.php?option=com_jervey&controller=datamanager');
        
        parent::display($tpl);
    }

}
