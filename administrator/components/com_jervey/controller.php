<?php
/**
 * jervey default Controller
 *
 * @version     $Id$
 * @author      IP-Tech Labs <labs@iptech-offshore.com>
 * @copyright   2010 IP-Tech
 * @package     Base
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

//-- No direct access
defined('_JEXEC') or die('no direct access');

jimport('joomla.application.component.controller');

class JerveyController extends JController
{

    public function __construct()
    {
        parent::__construct();
        // This conditional lets the ACL check run only on Joomla! 1.6+
        if( version_compare( JVERSION, '1.6.0', 'ge' ) ) {
                $user = JFactory::getUser();
                if (!$user->authorise('example.something', 'com_example')) {
                        return JError::raiseWarning(403, JText::_('JERVEY_LANG_JERROR_ALERTNOAUTHOR'));
                }
        }
        
        // Register Extra task
        $this->registerTask( 'apply',   'save' );
        $this->registerTask( 'add',     'edit' );
    }

    /**
     * Method to display the view
     *
     * @access	public
     */
    function display()
    {
        parent::display();
    }

}
