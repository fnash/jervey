<?php
    defined('_JEXEC') or die('Restricted access');
?>

<?php
        // including JS charts with flot plugin for jquery        
        $jq   = JRoute::_("components/com_jervey/assets/js/flot/jquery.js");
        $flot = JRoute::_("components/com_jervey/assets/js/flot/jquery.flot.js");
        $pie  = JRoute::_("components/com_jervey/assets/js/flot/jquery.flot.pie.js");
        $exc  = JRoute::_("components/com_jervey/assets/js/flot/excanvas.js");
        
        $excTag = '<!--[if IE]><script language="javascript" type="text/javascript" src="'.$exc.'"></script><![endif]-->';
                        
        if ( version_compare( JVERSION, '1.6.0', 'ge' ) )
        {
            $doc =& JFactory::getDocument();
            $doc->addScript($jq);
            $doc->addScript($flot);
            $doc->addScript($pie);
            $doc->addCustomTag($excTag);
        }
        else
        {
            global $mainframe;
            
            $tag = '<script src="'.$jq.'" type="text/javascript"></script>'.
               '<script src="'.$flot.'" type="text/javascript"></script>'.
               '<script src="'.$pie.'" type="text/javascript"></script>';
            $tag .= $excTag;
        
            $mainframe->addCustomHeadTag($tag);
        }
?>
<!-- DISPLAYING SNAPSHOT DETAILS -->
<fieldset>
    <legend><?php echo JText::_('JERVEY_LANG_ANALYSIS_SNAPSHOT'); ?></legend>
    <table class="adminlist">
        <thead>
            <th width="20"><?php echo JText::_('JERVEY_LANG_ID'); ?></th>
            <th><?php echo JText::_('JERVEY_LANG_NAME'); ?></th>
            <th><?php echo JText::_('JERVEY_LANG_DESCRIPTION'); ?></th>
            <th width="150"><?php echo JText::_('JERVEY_LANG_SAVE_DATE'); ?></th>
            <th width="100"><?php echo JText::_('JERVEY_LANG_TYPE'); ?></th>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $this->analysis->id; ?></td>
            <td><?php echo $this->analysis->name; ?></td>
            <td><?php echo $this->analysis->description; ?></td>
            <td><?php echo $this->analysis->save_date; ?></td>
            <td><?php echo JText::_('JERVEY_LANG_FREQUENCY'); ?></td>
        </tr>
        </tbody>
    </table>
</fieldset>


<!-- DISPLAYING SURVEY STATS -->
<fieldset>
    <legend><?php echo JText::_('JERVEY_LANG_SURVEY'); ?></legend>
    <table class="adminlist">
        <thead>
            <th width="20"><?php echo JText::_('JERVEY_LANG_ID'); ?></th>
            <th><?php echo JText::_('JERVEY_LANG_TITLE'); ?></th>
            <th width="100"><?php echo '# '.JText::_('JERVEY_LANG_QUESTIONS'); ?></th>
            <th width="100"><?php echo '# '.JText::_('JERVEY_LANG_SESSIONS'); ?></th>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $this->survey->survey_id; ?></td>
            <td><?php echo $this->survey->title; ?></td>
            <td><?php echo $this->survey->nbrQuestions; ?></td>
            <td><?php echo $this->survey->nbrSessions; ?></td>
        </tr>
        </tbody>
    </table>
</fieldset>

<!-- DISPLAYING QUESTION STATS -->
<fieldset>
    <legend><?php echo JText::_('JERVEY_LANG_QUESTION'); ?></legend>
    <table class="adminlist">
        <thead>
            <th width="20"><?php echo JText::_('JERVEY_LANG_ID'); ?></th>
            <th><?php echo JText::_('JERVEY_LANG_STATEMENT'); ?></th>
            <th width="100"><?php echo JText::_('JERVEY_LANG_TYPE'); ?></th>
            <th width="100"><?php echo JText::_('JERVEY_LANG_NATURE'); ?></th>
        </thead>
        <tbody>
        <tr>
            <td><?php echo ($this->question[0]->type_id != 4) ? $this->question[0]->question_id : $this->question[0]->row_id; ?></td>
            <td><?php echo ($this->question[0]->type_id != 4) ?  $this->question[0]->statement : $this->question[0]->row_title; ?></td>
            <td><?php echo JText::_($this->question[0]->type_id); ?></td>
            <td><?php echo ( ! $this->question[0]->nature) ? JText::_('JERVEY_LANG_QUALITATIVE') : JText::_('JERVEY_LANG_QUANTITATIVE'); ?></td>

        </tr>
        </tbody>
    </table>
</fieldset>

<!-- DISPLAYING STATS FOR ONLY QUANTITATIVE QUESTION -->
<?php if ($this->question[0]->nature): ?>
<fieldset>
    <legend><?php echo JText::_('JERVEY_LANG_VALUES'); ?></legend>
</fieldset>
<?php endif; ?>


<!-- DISPLAYING PROPOSITIONS STATS AND CHART -->
<table border="0" width="100%">
    <tr>
        <td valign="top" width="50%">
<fieldset>
    <legend><?php echo JText::_('JERVEY_LANG_PROPOSITIONS'); ?></legend>
    <table class="adminlist">
        <thead>
        <th><?php echo JText::_('JERVEY_LANG_PROPOSITION'); ?></th>
        <th><?php echo JText::_('JERVEY_LANG_FREQUENCY'); ?></th>
        <th><?php echo JText::_('JERVEY_LANG_SAMPLE_SIZE'); ?></th>
    </thead>
    <tbody>
        <?php
            foreach ($this->propositions AS $proposition):
        ?>
        <tr>
            <td><?php echo ($proposition->proposition == 'no_answer') ? JText::_($proposition->proposition) : $proposition->proposition ; ?></td>
            <td><?php echo $proposition->frequency; ?></td>
            <td><?php echo $proposition->sample_size; ?></td>
        </tr>
        <?php
                endforeach;
        ?>
        <tr>
            <th><?php echo JText::_('JERVEY_LANG_TOTAL'); ?></th>
            <td><?php echo '100 %'; ?></td>
            <td><?php echo $this->survey->nbrSessions; ?></td>
        </tr>
    </tbody>
    </table>
</fieldset>
    </td>
    <td valign="top">

<!-- DISPLAYING JAVASCRIPT CHART -->
<fieldset>
    <legend><?php echo JText::_('JERVEY_LANG_CHART'); ?></legend>

    <!-- CHART CONTAINER -->
    <div id="chartplaceholder" style="width: 500px; height: 400px"></div>

<script language="javascript" type="text/javascript">
jQuery.noConflict();

// Put all your code in your document ready area
jQuery(document).ready(function($){
// Do jQuery stuff using $


$(function () {

var nature = <?php echo (int)$this->question[0]->nature; ?>;

if (nature == 1) {

var data = {
    "data":{
        "metrics":[
            {
                "label":"",
                "data":[

            <?php
                    $i = 1;
                    $count = count($this->propositions);
                    foreach ($this->propositions as $proposition)
                    {
                        if ($i == ($count-1)) {
                            echo '['.$i.', '.$proposition->frequency.']';
                        }
                        else {
                            echo '['.$i.', '.$proposition->frequency.'],';
                        }
                        $i++;
                    }
            ?>

                ]
            }
        ],
        "ticks":[
            <?php
                $i = 1;
                foreach ($this->propositions as $prop)
                {
                    if ($i == ($count-1)) {
                        echo '['.$i.', "'.$prop->proposition.'"]';
                    }
                    else {
                        echo '['.$i.', "'.$prop->proposition.'"],';
                    }
                    $i++;
                }
            ?>
        ]
    }
};

            $.plot($("#chartplaceholder"), data.data.metrics, {
			bars: {show: true, autoScale: true, fillOpacity: 1, barWidth: 0.7 },
            //legend : {margin: 20},
			xaxis: {
				ticks: data.data.ticks

			}
		});

} // end if
else { // PIE

    var data = [];
    var series = 100;

<?php // RAW DATA for chart
        $i = 0;
        foreach($this->propositions as $prop) {
            if ($i == ($count-1)) {
                echo 'data['.$i.'] = { label: "'.$prop->proposition.'",  data: '.$prop->sample_size.'}';
            }
            else {
                echo 'data['.$i.'] = { label: "'.$prop->proposition.'",  data: '.$prop->sample_size.'},';
            }
            $i++;
        }
?>

    $.plot($("#chartplaceholder"), data,
	{
        series: {
            pie: {
                show: true,
                radius: 3/4,
                label: {
                    show: true,
                    radius: 3/4,
                    formatter: function(label, series){
                        return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
                    },
                    background: {
                        opacity: 0.5,
                        color: '#000'
                    }
                }
            },
            legend: {
                show: false
            }
        }
    });

} // end else

});


}); // end jquery
</script>

</fieldset>
    </td></tr>
</table>
