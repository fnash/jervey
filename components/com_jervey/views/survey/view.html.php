<?php

defined('_JEXEC') or die('');

jimport('joomla.application.component.view');

class JerveyViewSurvey extends JView
{

    function display($tpl = null)
    {
        $model = & $this->getModel('jervey');

        $survey_id = JRequest::getInt('id');
        $user = & JFactory::getUser();
        $user_id = $user->id;

        $isAllowedUser = $model->isAllowedUser($survey_id, $user_id);
        if (!$isAllowedUser)
        {
            $rows = null;
        }
        else
        {
            $rows = & $model->getSurvey($survey_id);
        }

        $this->assignRef('rows', $rows);
        $this->assignRef('survey_id', $survey_id);
        $this->assignRef('user_id', $user_id);

        $doc = JFactory::getDocument();
        $doc->addScript(JRoute::_("media/com_jervey/shared/js/jquery-1.6.1.js"));
        $doc->addScript(JRoute::_("media/com_jervey/site/js/jquery.validate.min.js"));
        $doc->addStyleSheet(JRoute::_("media/com_jervey/site/css/survey.css"));

        parent::display($tpl);
    }
}
