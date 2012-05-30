<?php
defined('_JEXEC') or die('Restricted access');

require_once (JPATH_COMPONENT . DS . 'helpers' . DS . 'CsvCreator.php');

class CsvAnswersHelper
{
    /**
     *
     * @param array selected questions
     */
    function addHeader($questions)
    {
        $nbrQuestions = count($questions);

        // session header
        CsvCreator::addValue('survey_id');
        CsvCreator::addValue('session_id');
        CsvCreator::addValue('submit_date');
        CsvCreator::addValue('ip_address');
        CsvCreator::addValue('user_name');
        CsvCreator::addValue('user_id');

        // questions
        for ($i = 0; $i < $nbrQuestions; $i++)
        {
            CsvCreator::addValue('question_alias');
            CsvCreator::addValue('question_id');
            CsvCreator::addValue('question_type_id');
            CsvCreator::addValue('answer');
            CsvCreator::addValue('altanswer');
            CsvCreator::addValue('answer_id');
            CsvCreator::addValue('row_title');
            CsvCreator::addValue('row_id');
        }
    }


    function addSession($answer)
    {
        CsvCreator::addValue($answer->survey_id);
        CsvCreator::addValue($answer->session_id);
        CsvCreator::addValue($answer->submit_date);
        CsvCreator::addValue($answer->ip_address);
        CsvCreator::addValue($answer->user_name);
        CsvCreator::addValue($answer->user_id);
    }

    
    function addAnswer($answer)
    {
        CsvCreator::addValue($answer->question_alias);
        CsvCreator::addValue($answer->question_id);
        CsvCreator::addValue($answer->question_type_id);
        CsvCreator::addValue($answer->answer);
        CsvCreator::addValue($answer->altanswer);
        CsvCreator::addValue($answer->answer_id);
        CsvCreator::addValue($answer->row_title);
        CsvCreator::addValue($answer->row_id);
    }


   /**
     *
     * @param array $answers
     * @param array $questions
     * @param array $sessions
     */
    function write($answers, $questions, $sessions)
    {
        // unset $_content
        CsvCreator::initContent();

        // write CSV header
        self::addHeader($questions);

        // write lines
        $current_s_id = null;
        foreach ($answers AS $answer)
        {
            if ( in_array($answer->session_id, $sessions) )
            {
                if ($answer->session_id != $current_s_id)
                {
                    CsvCreator::endLine();
                    self::addSession($answer);
                    $current_s_id = $answer->session_id;
                }
                if ( in_array($answer->question_id, $questions) ){
                    self::addAnswer($answer);
                }
            }

        }

    }


    function getContent()
    {
        return CsvCreator::getContent();
    }

}
