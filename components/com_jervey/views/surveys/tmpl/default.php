<?php 

defined('_JEXEC') or die('restricted access'); 

require_once (JPATH_COMPONENT_ADMINISTRATOR . DS . 'helpers' . DS . 'jerveyHtmlHelper.php');

?>

<style type="text/css" >
    .jervey_powered_by {
        text-align: right;
    }
</style>

<div class="contentheading">
    <h2><?php echo JText::_('PUBLIC_SURVEYS'); ?></h2>
</div>
<ul>
    <?php foreach ($this->public_surveys as $survey): ?>
    <li>
        <a href="<?php echo jerveyHtmlHelper::linkToSurvey($survey->id) ?>"><?php echo $survey->title ?></a>
    </li>
    <?php endforeach; ?>
</ul>

<?php if (count($this->private_surveys)):  ?>
<div class="contentheading"><?php echo JText::_('PRIVATE_SURVEYS'); ?></div>
<?php endif; ?>
<ul>
    <?php foreach ($this->private_surveys as $survey): ?>
    <li class="jervey_survey_li">
        <a href="<?php echo jerveyHtmlHelper::linkToSurvey($survey->id) ?>"><?php echo $survey->title ?></a>
    </li>
    <?php endforeach; ?>
</ul>
<div class="jervey_powered_by">
    <a href="http://www.iptechinside.com/labs/projects/show/jquarks-for-surveys"><strong>powered by jervey</strong></a>
</div>
