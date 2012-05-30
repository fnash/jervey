<?php

defined('_JEXEC') or die('');

class JerveyHtmlHelper
{
    /**
     *
     * @param integer $surveyId
     * @return string 
     */
    public static function linkToSurvey($surveyId)
    {
        return 'index.php?option=com_jervey&controller=survey&id='.$surveyId;
    }
    
        /**
     * @param integer The row index
     * @param integer The record id
     * @param boolean
     * @param string The name of the form element
     *
     * @return string
     */
    public static function getJhtmlGridId($rowNum, $recId, $checked = false, $name = 'cid')
    {
        $checkedHtml = ($checked) ? ' checked="checked" ' : '';
        
        return '<input type="checkbox" id="cb' . $rowNum . '" name="' . $name . '[]" value="' . $recId . '" onclick="isChecked(this.checked);" '.$checkedHtml.' />';
    }
}
