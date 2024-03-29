<?php

/**
 * jervey Component snapshot_question Table
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

class TableSnapshot_question extends JTable
{
    /**
     *
     * @var int
     */
    var $id = null;

    /**
     *
     * @var int
     */
    var $question_id = null;

    /**
     *
     * @var text
     */
    var $statement = null;

    /**
     *
     * @var int
     */
    var $type_id = null;

    /**
     *
     * @var boolean
     */
    var $nature = null;

    /**
     *
     * @var int
     */
    var $row_id = null;

    /**
     *
     * @var string
     */
    var $row_title = null;

    /**
     *
     * @var int
     */
    var $snapshot_analysis_id = null;

    function TableSnapshot_question(& $db)
    {
        parent::__construct('#__jervey_snapshot_question', 'id', $db);
    }

}
