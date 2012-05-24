<?php

defined('_JEXEC') || die('=;)');

jimport('joomla.plugin.plugin');

class plgUserJervey extends JPlugin
{
    /**
     * Assign new user to all public surveys
     *
     * Method is called after user data is stored in the database
     *
     * @param 	array		holds the new user data
     * @param 	boolean		true if a new user is stored
     * @param	boolean		true if user was succesfully stored in the database
     * @param	string		message
     */
    function onUserAfterSave($user, $isnew, $success, $msg)
    {
        if ($isnew && $success)
        {
            $query = 'SELECT id' .
            ' FROM #__jervey_surveys';
            $db = &JFactory::getDBO();
            $db->setQuery($query);
            $publicSurveys = $db->loadResultArray();

            JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_jervey'.DS.'tables');
            $row =& JTable::getInstance('users_surveys', 'Table');
            foreach ($publicSurveys as $survey)
            {
                $row->id        = 0;
                $row->survey_id = $survey['id'];
                $row->user_id   = $user['id'];
                $row->is_active = false;
                if ( ! $row->store()) {
                    JError::raiseError(500, $row->getError() );
                }
            }
        }
        return true;
    }
}
