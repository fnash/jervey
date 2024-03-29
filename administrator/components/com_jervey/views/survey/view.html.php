<?php
/**
 * jervey Component Survey View
 *
 * @version     $Id$
 * @author      IP-Tech Labs <labs@iptech-offshore.com>
 * @copyright   2010 IP-Tech
 * @package     jervey-Back-End
 * @subpackage  Views
 * @link        http://www.iptechinside.com/labs/projects/show/jquarks-for-surveys
 * @since       1.0.0
 * @license     GNU/GPL2
 *
 *    This program is free software; you can redistribute it and/or
 *  modify it under the terms of the GNU General Public License
 *  as published by the Free Software Foundation; version 2
 *  of the License.
 *
 *    This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *  along with this program; if not, write to the Free Software
 *  Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *  or see <http://www.gnu.org/licenses/>
 */

defined('_JEXEC') or die();

jimport('joomla.application.component.view');


class jerveyViewSurvey extends JView
{
    function display($tpl = null)
    {
        $survey =& $this->get( 'survey' );

        $this->assignRef( 'survey', $survey );

        $isNew = ($survey->id < 1);
	$text = $isNew ? JText::_( 'JERVEY_LANG_NEW' ) : JText::_( 'JERVEY_LANG_EDIT' );
  	JToolBarHelper::title(   JText::_( 'JERVEY_LANG_SURVEY' ).': <small><small>[ ' . $text .' ]</small></small>' );

        $bar=& JToolBar::getInstance( 'toolbar' );
        // appendButton method parameters
        // 1- button type from JButton
        // 2- css class - image of the button
        // 3- text to display on the button
        // 4- the task to set
        // 5- whether a selection must be made from an admin list before continuing.
        $href = $this->baseurl.'/components/com_jervey/assets/css/toolbar.css'; 
        
        if ( version_compare( JVERSION, '1.6.0', 'ge' ) ) {
            $doc =& JFactory::getDocument();
            $attribs = array('type' => 'text/css'); 
            $doc->addHeadLink( $href, 'stylesheet', 'rel', $attribs );
        } else {
            global $mainframe;
            $mainframe->addCustomHeadTag ('<link rel="stylesheet" href="'.$href.' type="text/css" media="screen" />');
        }
        $bar->appendButton( 'link', 'print', JText::_('JERVEY_LANG_EXPORT_TO_PDF').' (not available)', 'index.php?option=com_jervey&amp;controller=surveys&amp;task=export&amp;cid[]='.$survey->id );

        if ( ! $isNew && $survey->access_id == 1) { // to set users, the survey has to be saved and registered
            $bar->appendButton( 'link', 'config', JText::_('JERVEY_LANG_SET_REGISTERED_USERS'), 'index.php?option=com_jervey&amp;controller=surveys&amp;task=showUsers&amp;cid[]='.$survey->id, 550, 400 );
        }
        if ($survey->id == 0) {
            $bar->appendButton( 'link', 'publish', JText::_('JERVEY_LANG_SET_SECTIONS'), 'index.php?option=com_jervey&amp;controller=ss&amp;task=showSet&amp;id='.$survey->id, false );
        } else {
            $bar->appendButton( 'Popup', 'publish', JText::_('JERVEY_LANG_SET_SECTIONS'), 'index.php?option=com_jervey&amp;controller=ss&amp;task=showSet&amp;id='.$survey->id, 550, 400 );
        }
        
        $bar->appendButton( 'Popup', 'unpublish', JText::_('JERVEY_LANG_UNSET_SECTIONS'), 'index.php?option=com_jervey&amp;controller=ss&amp;task=showUnset&amp;id='.$survey->id, 550, 400 );


        JToolBarHelper::save() ;
	JToolBarHelper::custom( 'saveContinue', 'save.png', 'save.png', JText::_('JERVEY_LANG_SAVECONTINUE'), false, false);
        JToolBarHelper::apply() ;

        if ($isNew) {
                JToolBarHelper::cancel();
        } else {
                JToolBarHelper::cancel( 'cancel', 'Close' ) ;
        }

        // get the user preferred editor, otherwise from global configuration
        $user = JFactory::getUser();
        $editorName = $user->getParam('editor');
        if (is_null($editorName)) {
            $editor =& JFactory::getEditor();
        } else {
            $editor =& JFactory::getEditor($editorName);
        }

        switch ($editor->get('name'))
        {
            case 'tinymce':
                $params = array( 'smilies'=> '0' ,
                'style'  => '1' ,
                'layer'  => '0' ,
                'table'  => '0' ,
                'clear_entities'=>'0',
                'relative_urls'=>'0',
                'extended_elements' => "pre[name|class]",
                );
                break;

            default:
                $params = array();
        }
        $this->assignRef('editor', $editor) ;
        $this->assignRef('editor_params', $params) ;

        parent::display($tpl);
    }
}
