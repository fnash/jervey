<?php

defined('_JEXEC') or die('');

jimport('joomla.application.component.model');


class jerveyModeljervey extends JModel
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * check whether user has access to survey
     * @param  int $survey_id
     * @param  int $user_id
     * @return int
     */
    public function isAllowedUser($survey_id, $user_id)
    {
        $query = 'SELECT is_active'.
        ' FROM #__jervey_users_surveys'.
        ' WHERE user_id = '.(int)$user_id.
        ' AND survey_id = '.(int)$survey_id;

        $this->_db->setQuery($query);
        return (boolean)$this->_db->loadResult();
    }

    
    public function getSurvey($survey_id)
    {
        $config =& JFactory::getConfig();
        $jnow   =& JFactory::getDate();
        $jnow->setOffset( $config->getValue('config.offset' ));
        $now = $jnow->toMySQL(true);

        $query = ' ( SELECT s.id as survey_id, s.title, s.description, s.footer,'.
        '   sec.id as section_id, sec.name as section_name, ss.section_rank, '.
        '   sq.question_rank, q.id  as question_id, q.type_id, q.statement, q.is_compulsory,'.
        '   r.id as row_id, r.title as row_title, '.
        '   null as column_id, null as column_title, '.
        '   null as proposition_id, null as proposition, null as is_text_field'.
        ' FROM #__jervey_surveys s '.
        '   LEFT JOIN #__jervey_surveys_sections ss ON s.id = ss.survey_id'.
        '   LEFT JOIN #__jervey_sections sec ON ss.section_id = sec.id'.
        '   LEFT JOIN #__jervey_sections_questions sq ON sec.id = sq.section_id'.
        '   LEFT JOIN #__jervey_questions q ON sq.question_id = q.id'.
        '   LEFT JOIN #__jervey_mat_rows r ON q.id = r.question_id'.
        ' WHERE s.id = '.(int)$survey_id.
        '   AND s.published = 1'.
		'   AND s.published_up < "'.$now.'"'.
		'   AND ( s.published_down = "0000-00-00 00:00:00" OR s.published_down > "'.$now.'" )'.
        '   AND q.type_id = 4'.
        ' )'.
        ' UNION'.
        ' ( SELECT s.id as survey_id, s.title, s.description, s.footer,'.
        '   sec.id as section_id, sec.name as section_name, ss.section_rank, '.
        '   sq.question_rank, q.id  as question_id, q.type_id, q.statement, q.is_compulsory, '.
        '   null as row_id, null as row_title, '.
        '   c.id as title_id, c.title as column_title, '.
        '   null as proposition_id, null as proposition, null as is_text_field'.
        ' FROM #__jervey_surveys s '.
        '   LEFT JOIN #__jervey_surveys_sections ss ON s.id = ss.survey_id'.
        '   LEFT JOIN #__jervey_sections sec ON ss.section_id = sec.id'.
        '   LEFT JOIN #__jervey_sections_questions sq ON sec.id = sq.section_id'.
        '   LEFT JOIN #__jervey_questions q ON sq.question_id = q.id'.
        '   LEFT JOIN #__jervey_mat_columns c ON q.id = c.question_id'.
        ' WHERE s.id = '.(int)$survey_id.
        '   AND q.type_id = 4'.
        '   AND s.published = 1'.
		'   AND s.published_up < "'.$now.'"'.
		'   AND ( s.published_down = "0000-00-00 00:00:00" OR s.published_down > "'.$now.'" )'.
        ' )'.
        ' UNION'.
        ' ( SELECT s.id as survey_id, s.title, s.description, s.footer,'.
        '   sec.id as section_id, sec.name as section_name, ss.section_rank, '.
        '   sq.question_rank, q.id  as question_id, q.type_id, q.statement, q.is_compulsory,  '.
        '   null as row_id, null as row_title, '.
        '   null as column_id, null as title_column, '.
        '   p.id as proposition_id,  p.proposition, p.is_text_field'.
        ' FROM #__jervey_surveys s '.
        '   LEFT JOIN #__jervey_surveys_sections ss ON s.id = ss.survey_id'.
        '   LEFT JOIN #__jervey_sections sec ON ss.section_id = sec.id'.
        '   LEFT JOIN #__jervey_sections_questions sq ON sec.id = sq.section_id'.
        '   LEFT JOIN #__jervey_questions q ON sq.question_id = q.id'.
        '   LEFT JOIN #__jervey_propositions p ON q.id = p.question_id'.
        ' WHERE s.id = '.(int)$survey_id.
        '   AND s.published = 1'.
		'   AND s.published_up < "'.$now.'"'.
		'   AND ( s.published_down = "0000-00-00 00:00:00" OR s.published_down > "'.$now.'" )'.
        '   AND ( q.type_id <> 4 OR ISNULL(q.type_id) )'.
        ' )'.
        ' ORDER BY section_rank, question_rank, question_id, proposition_id, row_id, column_id';

        $this->_db->setQuery($query);
        $rows = $this->_db->loadObjectList();
        if ( ! $rows) {
            return $this->_db->getErrorMsg();
        }
        return $rows;
    }

    public function getPublicSurveys()
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

    
    public function getPrivateSurveys($user_id)
    {
        $privateSurveys = null;

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
                '   AND us.user_id = ' . (int)$user_id .
                '   AND s.published_up < "' . $now . '"' .
                '   AND ( s.published_down > "' . $now . '" OR s.published_down = "0000-00-00 00:00:00" )';

        $db = & JFactory::getDBO();
        $db->setQuery($query);

        $privateSurveys = $db->loadObjectList();

        if ($db->getErrorNum()) {
            return false;
        }
        return $privateSurveys;
    }
}
