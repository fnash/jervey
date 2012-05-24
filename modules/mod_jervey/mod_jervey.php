<?php

defined('_JEXEC') or die();

// include the helper file
require_once(dirname(__FILE__).DS.'helper.php');

$publicSurveys  	= ModjerveyHelper::getPublicSurveys($params); // get the publicQuizzes
$privateSurveys 	= ModjerveyHelper::getPrivateSurveys($params); 	// get the privateQuizzes

// include the template for display
require(JModuleHelper::getLayoutPath('mod_jervey'));
