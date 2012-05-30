<?php
/**
 * jervey Component sessions Controller
 *
 * @version     $Id$
 * @author      IP-Tech Labs <labs@iptech-offshore.com>
 * @copyright   2012 IP-Tech
 * @package     jervey-Back-End
 * @subpackage  Controllers
 * @link        http://www.iptechinside.com/labs/projects/show/jquarks-for-surveys
 * @since       1.1.3
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

jimport('joomla.application.component.controller');

class JerveyControllerSessions extends JerveyController
{
      
    function __construct()
    {
        parent::__construct();
    }

    function display()
    {
        JRequest::setVar('view', 'sessions');
        JRequest::setVar('layout', 'default');

        parent::display() ;
    }

    
    function viewSession()
    {
        $view = & $this->getView( 'session', 'html' );
        $view->setModel( $this->getModel( 'survey' ), true );

        JRequest::setVar('view', 'session');
        JRequest::setVar('layout', 'default');
        JRequest::setVar('hidemainmenu', 1);

        parent::display() ;
    }

    
    function remove()
    {
        $model = $this->getModel('sessions');
        if( ! $model->delete() )
        {
            $msg = JText::_( 'JERVEY_LANG_ERROR_ONE_OR_MORE_RECORDS_COULD_NOT_BE_DELETED' );
            $type = 'error';
        }
        else
        {
            $msg = JText::_( 'JERVEY_LANG_RECORDS(S)_DELETED' );
            $type = 'message';
        }

        $this->setRedirect( 'index.php?option=com_jervey&controller=sessions', $msg, $type );
    }

}
