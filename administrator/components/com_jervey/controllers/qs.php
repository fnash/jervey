<?php
/**
 * jervey Component Questiontosections Controller
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

class JerveyControllerQs extends JerveyController
{
    /**
     *
     * @var JModel
     */
    private $_model;

  
    function __construct()
    {
        parent::__construct();

        $this->_model =& $this->getModel('qs') ;

        $this->registerTask('showUnplace', 'showPlace');
        $this->registerTask('unplace', 'place');
    }


    function showPlace()
    {
        $task = $this->getTask();
        switch ($task)
        {
            case 'showPlace':
                $id = JRequest::getInt('id');
                if ($id == 0)
                {
                    $url  = 'index.php?option=com_jervey&controller=questions&task=edit&cid[]=0';
                    $msg  = JText::_('JERVEY_LANG_WARNING_YOU_MUST_SAVE_THE_QUESTION_BEFORE');
                    $type = 'notice';
                    
                    $this->setRedirect($url, $msg, $type);
                }
                $action = 'place';
                break;

            case 'showUnplace':
                $action = 'unplace';
        }

        JRequest::setVar('action', $action);
        JRequest::setVar('view', 'qs');
        JRequest::setVar('tmpl', 'component');
        JRequest::setVar('layout', 'default');

        parent::display() ;
    }

    
    function place()
    {
        $task = $this->getTask();
        switch ($task)
        {
            case 'place':
                $this->_model->placeInSections();
                break;

            case 'unplace':
                $this->_model->unplaceFromSections();
        }
        
        $this->setRedirect('index.php?option=com_jervey&view=nothing&tmpl=component');
    }

}
