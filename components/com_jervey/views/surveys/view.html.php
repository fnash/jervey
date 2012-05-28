<?php
/**
 * jervey Component survey view
 *
 * @version     $Id$
 * @author      IP-Tech Labs <labs@iptech-offshore.com>
 * @copyright   2012 IP-Tech
 * @package     jervey-Front-End
 * @link        http://www.iptechinside.com/labs/projects/show/jquarks-for-surveys
 * @since       1.1.3
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('_JEXEC') or die('');

jimport('joomla.application.component.view');

class jerveyViewsurveys extends JView
{
    function display($tpl = null)
    {
        $jerveyModel = $this->getModel('jervey');

        $user = JFactory::getUser();
        $privateSurveys = $jerveyModel->getPrivateSurveys($user->id);
        $this->assignRef('private_surveys', $privateSurveys);

        $publicSurveys = $jerveyModel->getPublicSurveys();
        $this->assignRef('public_surveys', $publicSurveys);

        parent::display($tpl);
    }
}
