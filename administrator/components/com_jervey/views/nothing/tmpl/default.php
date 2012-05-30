<!-- empty view displayed after popup process - with possibility of redirection -->
<?php defined('_JEXEC') or die('Restricted access'); ?>

<?php
        $type = JRequest::getInt('redir_type', 0);
        if ($type == 0) {
            define('ANALYSIS_URL', '');
        }
        elseif ($type == 1) {
            define('ANALYSIS_URL', 'index.php?option=com_jervey&controller=analysis');
        }
?>

<script type="text/javascript">
    
    function redirect(url)
    {
        if (url != '') {
                window.parent.location.replace(url);
            }
    }

    function closeIframe()
    {
            new Ajax('index.php',
            {
                update:'',
                method:'post',
                data: '',
                onRequest : function()
                {
                    
                    <?php if (version_compare( JVERSION, '1.6.0', 'ge' )): ?>
                    // Joomla 1.6+ code
                    window.parent.SqueezeBox.close();                    
                    <?php else: ?>
                    // Joomla 1.5 code
                    doc = window.parent.document.getElementById('sbox-window').close();
                    <?php endif; ?>
                    redirect('<?php echo ANALYSIS_URL; ?>');
                }
            }).request();
    }

    window.addEvent('domready', function(){ closeIframe(); });
</script>
