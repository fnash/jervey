<?php
/**
 * jervey Component users_surveys Model
 *
 * @version     $Id$
 * @author      IP-Tech Labs <labs@iptech-offshore.com>
 * @copyright   2012 IP-Tech
 * @package     Front-End
 * @subpackage  Models
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

jimport('joomla.application.component.model');

class JerveyModelUsers_surveys extends JModel
{

    public function __construct()
    {
        parent::__construct();
        
    }

    /**
     *
     * @param int $user_id
     * @param int $survey_id
     * @return int
     */
    public function getAffectedId($user_id, $survey_id)
    {
        $query = 'SELECT id'.
        ' FROM #__jervey_users_surveys'.
        ' WHERE user_id   = '.(int)$user_id.
        '   AND survey_id = '.(int)$survey_id;

        $this->_db->setQuery($query);
        return $this->_db->loadResult();
    }
}
