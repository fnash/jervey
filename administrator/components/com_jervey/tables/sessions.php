<?php
/**
 * jervey Component sessions Table
 *
 * @version     $Id$
 * @author      IP-Tech Labs <labs@iptech-offshore.com>
 * @copyright   2010 IP-Tech
 * @package     jervey-Back-End
 * @subpackage  Tables
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


class TableSessions extends JTable
{
    /**
	 *
	 * @var int
	 */
    var $id = null;

    /**
     *
     * @var string
     */
    var $ip_address = null;


    /**
     *
     * @var int
     */
    var $affected_id = null;

    /**
     *
     * @var timestamp
     */
    var $submit_date;

    
    function TableSessions(& $db)
	{
		parent::__construct('#__jervey_sessions', 'id', $db) ;
	}
}