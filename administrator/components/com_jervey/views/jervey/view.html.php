<?php
/**
 * jervey Component Home View
 *
 * @version     $Id$
 * @author      IP-Tech Labs <labs@iptech-offshore.com>
 * @copyright   2010 IP-Tech
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
defined('_JEXEC') or die('=;)');

jimport('joomla.application.component.view');

class jerveyViewJervey extends JView
{
    function display($tpl = null)
    {
        $lastSurveys = $this->get('lastsurveys');
        $this->assignRef( 'lastSurveys', $lastSurveys );

        $lastAnalysis = $this->get('lastanalysis');
        $this->assignRef( 'lastAnalysis', $lastAnalysis );

        $lastSessions = $this->get('lastsessions');
        $this->assignRef( 'lastSessions', $lastSessions );

        // TOOLBAR
        $link = JRoute::_("administrator/components/com_jervey/assets/images/home.png");
        JerveyToolBarHelper::title( JText::_( 'COM_jervey' ), 'generic.png');

        // SUBMENU
        JSubMenuHelper::addEntry( JText::_( 'JERVEY_LANG_HOME' ), 'index.php?option=com_jervey', true);
        JSubMenuHelper::addEntry( JText::_( 'JERVEY_LANG_SURVEYS' ),        'index.php?option=com_jervey&controller=surveys');
        JSubMenuHelper::addEntry( JText::_( 'JERVEY_LANG_SECTIONS'),        'index.php?option=com_jervey&controller=sections');
        JSubMenuHelper::addEntry( JText::_( 'JERVEY_LANG_QUESTIONS' ),      'index.php?option=com_jervey&controller=questions');
        JSubMenuHelper::addEntry( JText::_( 'JERVEY_LANG_ANSWERS' ),       'index.php?option=com_jervey&controller=sessions');
        JSubMenuHelper::addEntry( JText::_( 'JERVEY_LANG_ANALYSES' ),       'index.php?option=com_jervey&controller=analysis');
        JSubMenuHelper::addEntry( JText::_( 'JERVEY_LANG_IMPORT_EXPORT' ),  'index.php?option=com_jervey&controller=datamanager');

        parent::display($tpl);
    }

}
