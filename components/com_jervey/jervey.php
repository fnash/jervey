<?php

defined('_JEXEC') or die('');

// init default controller
$defaultController = 'surveys';

// get controller name
$controller = JRequest::getCmd('controller', null);
$view       = JRequest::getCmd('view', null);

if ( ! is_null($controller))
{
    $controllerName = $controller;
}
elseif ( ! is_null($view))
{
    $controllerName = $view;
}
else
{
    $controllerName = $defaultController;
}

// include controller path
includeControllerPath($controllerName, $defaultController);

// Instantiate the controller
$classname = 'JerveyController'.ucfirst($controllerName);
$controllerObject = new $classname();

$controllerObject->execute(JRequest::getCmd('task'));

$controllerObject->redirect();

function includeControllerPath($controllerName, $defaultControllerName)
{
    $path = JPATH_COMPONENT.DS.'controllers'.DS.$controllerName.'.php';

    if ( file_exists($path))
    {
        require_once $path;
    }
    else
    {
        $path = JPATH_COMPONENT.DS.'controllers'.DS.$defaultControllerName.'.php';
        require_once $path;
    }
}
