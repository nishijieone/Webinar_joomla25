<?php
/**
 * @version		1.0.0 jp logs $
 * @package		jplogs
 * @copyright   Copyright © 2010 - All rights reserved.
 * @license		GNU/GPL
 * @author		kim
 * @author mail administracion@joomlanetprojects.com
 * @website		http://www.joomlanetprojects.com
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once (JPATH_COMPONENT.DS.'version.php');
$version = new JPVersion();

jimport('joomla.html.pane');
jimport('joomla.application.component.helper');

$pane =& JPane::getInstance('tabs', array('startOffset'=>0));
?>
<div class="adminform">
    <div class="cpanel-left">
        <div id="cpanel">
                        <div class="icon-wrapper">
                            <div class='icon'>
                                <a href="index.php?option=com_jplogs&view=logs">
                                    <img src="components/com_jplogs/assets/images/logs48.png" alt="<?php echo JText::_('COM_JP_LOGS_ITEMS'); ?>" />
                                    <span><?php echo JText::_('COM_JP_AUTHOR_ITEMS'); ?></span>
                                </a>
                            </div>
                        </div>
                        <div class="icon-wrapper">
                            <div class='icon'>
                                <a href="http://www.joomlanetprojects.com" target="_blank">
                                    <img src="components/com_jplogs/assets/images/support48.png" alt="<?php echo JText::_('COM_JP_LOGS_SUPPORT'); ?>" />
                                    <span><?php echo JText::_('COM_JP_LOGS_SUPPORT'); ?></span>
                                </a>
                            </div>
                        </div>
                        <div class="icon-wrapper">
                            <div class='icon'>
                                <?php echo LiveUpdate::getIcon(); ?>
                            </div>
                        </div>
        </div>
    </div>
    <div class="cpanel-right">
        <?php
        echo $pane->startPane( 'pane' );
        echo $pane->startPanel( JText::_('COM_JP_LOGS_CREDITS'), 'panel1' );
        ?>

        <table class="adminlist">
           <thead>
                <th><?php echo JText::_('COM_JP_LOGS_CPANEL_TYPE'); ?></th>
                <th><?php echo JText::_('COM_JP_LOGS_CPANEL_DATA'); ?></th>
            </thead> 
            <tbody>
                <tr>
                    <td><?php echo JText::_('COM_JP_LOGS_VERSION_NUM'); ?>:</td><td><?php echo $version->getVersion(); ?></td>
                </tr>
                <tr>
                    <td><?php echo JText::_('COM_JP_LOGS_CODENAME'); ?>:</td><td><?php echo $version->getVersionId(); ?></td>
                </tr>
                <tr>
                    <td><?php echo JText::_('COM_JP_LOGS_LICENSE'); ?>:</td><td><a href="components/com_jplogs/license.txt" class="modal"  rel="{handler: 'iframe', size: {x: 640, y: 480}}"><?php echo JText::_('COM_JP_LOGS_LICENSE_TXT'); ?></a></td>
                </tr>
                <tr>
                    <td><?php echo JText::_('COM_JP_LOGS_DEVELOPER'); ?>:</td><td>Kim <a href="http://www.joomlanetprojects.com" target="_blank">Joomla! Projects</a></td>
                </tr>
            </tbody>
        </table>

        <?php
        echo $pane->endPanel();
        echo $pane->startPanel( JText::_('COM_JP_LOGS_CHANGELOG'), 'panel2' );

        include(JPATH_COMPONENT.DS."CHANGELOG.php");

        echo $pane->endPanel();
        echo $pane->endPane();

        ?>
    </div>
    </div>
    <div style="clear:both;"></div>
</div>
