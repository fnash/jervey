<?php
/**
 * jervey Component view.html.php View
 *
 * @version     $Id$
 * @author      IP-Tech Labs <labs@iptech-offshore.com>
 * @copyright   2010 IP-Tech
 * @package     Expression package is undefined on line 8, column 19 in Templates/Scripting/New Folder/PHPClass_1_1_1.
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


class jerveyViewQuestions extends JView
{
    function display($tpl = null)
    {
        $questions =& $this->get( 'questions' );
   		
        $this->assignRef( 'questions', $questions );
   		
        // TOOLBAR
  		JerveyToolBarHelper::title( JText::_( 'JERVEY_LANG_QUESTIONS' ), 'question.png' );
        
        JToolBarHelper::deleteList(JText::_('JERVEY_LANG_CONFIRM_SUPPRESSION_RECORDS'));
		JToolBarHelper::editListX();
		JToolBarHelper::addNewX();

        // SUBMENU
        JSubMenuHelper::addEntry( JText::_( 'JERVEY_LANG_HOME' ), 'index.php?option=com_jervey');
        JSubMenuHelper::addEntry( JText::_( 'JERVEY_LANG_SURVEYS' ),        'index.php?option=com_jervey&controller=surveys');
        JSubMenuHelper::addEntry( JText::_( 'JERVEY_LANG_SECTIONS'),        'index.php?option=com_jervey&controller=sections');
        JSubMenuHelper::addEntry( JText::_( 'JERVEY_LANG_QUESTIONS' ),      'index.php?option=com_jervey&controller=questions', true);
        JSubMenuHelper::addEntry( JText::_( 'JERVEY_LANG_ANSWERS' ),       'index.php?option=com_jervey&controller=sessions');
        JSubMenuHelper::addEntry( JText::_( 'JERVEY_LANG_ANALYSES' ),       'index.php?option=com_jervey&controller=analysis');
        JSubMenuHelper::addEntry( JText::_( 'JERVEY_LANG_IMPORT_EXPORT' ),  'index.php?option=com_jervey&controller=datamanager');
        
        parent::display($tpl);
    }

}