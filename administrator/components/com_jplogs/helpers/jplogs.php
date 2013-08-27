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

// No direct access to this file
defined('_JEXEC') or die;

/**
 * JP Logs component helper.
 */
abstract class jplogsHelper
{
    /**
	 * Configure the Linkbar.
	*/
	public static function addSubmenu($submenu) 
	{
        JSubMenuHelper::addEntry(JText::_('COM_JP_LOGS_SUBMENU_CPANEL'), 'index.php?option=com_jplogs', $submenu == 'dashboard');
		JSubMenuHelper::addEntry(JText::_('COM_JP_LOGS_SUBMENU_ITEMS'), 'index.php?option=com_jplogs&view=logs', $submenu == 'logs');              
	}
    
    /**
    * Get the actions
    */
    public static function getActions($messageId = 0)
    {
                $user  = JFactory::getUser();
                $result        = new JObject;

                if (empty($messageId)) {
                        $assetName = 'com_logs';
                }
                else {
                        $assetName = 'com_logs.message.'.(int) $messageId;
                }

                $actions = array(
                        'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.delete'
                );

                foreach ($actions as $action) {
                        $result->set($action,        $user->authorise($action, $assetName));
                }

                return $result;
    }
}

