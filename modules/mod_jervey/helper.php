<?php

defined('_JEXEC') or die('Restricted access');

class ModjerveyHelper
{

    function getPublicSurveys($params)
    {
        $publicSurveys = null;

        $db = & JFactory::getDBO();

        $config = & JFactory::getConfig();
        $jnow = & JFactory::getDate();
        $jnow->setOffset($config->getValue('config.offset'));
        $now = $jnow->toMySQL(true);

        $query = 'SELECT s.id, s.title' .
                ' FROM #__jervey_surveys s' .
                ' WHERE s.published = 1' .
                '   AND s.access_id = 0' .
                '   AND s.published_up < "' . $now . '"' .
                '   AND ( s.published_down = "0000-00-00 00:00:00" OR s.published_down > "' . $now . '" )';

        $db->setQuery($query);

        $publicSurveys = $db->loadObjectList();

        if ($db->getErrorNum()) {
            return false;
        }

        return $publicSurveys;
    }

    function getPrivateSurveys($params)
    {
        $privateSurveys = null;

        $db = & JFactory::getDBO();
        $user = & JFactory::getUser();

        $config = & JFactory::getConfig();
        $jnow = & JFactory::getDate();
        $jnow->setOffset($config->getValue('config.offset'));
        $now = $jnow->toMySQL(true);

        $query = 'SELECT s.id, s.title' .
                ' FROM #__jervey_surveys s' .
                '   LEFT JOIN #__jervey_users_surveys us ' .
                '       ON s.id = us.survey_id' .
                ' WHERE s.published = 1' .
                '   AND s.access_id = 1' .
                '   AND us.is_active = 1'.
                '   AND us.user_id = ' . $user->id .
                '   AND s.published_up < "' . $now . '"' .
                '   AND ( s.published_down > "' . $now . '" OR s.published_down = "0000-00-00 00:00:00" )';


        $db->setQuery($query);

        $privateSurveys = $db->loadObjectList();

        if ($db->getErrorNum()) {
            return false;
        }

        return $privateSurveys;
    }
}
