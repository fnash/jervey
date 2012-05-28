<?php

defined('_JEXEC') or die('');

jimport('joomla.application.component.controller');


class jerveyControllerSurveys extends JController
{
    function display()
    {
        $view = & $this->getView( 'surveys', 'html' );
        $view->setModel( $this->getModel( 'jervey' ), true );

        JRequest::setVar('view', 'surveys');
        JRequest::setVar('layout', 'default');

        parent::display();
    }
}
