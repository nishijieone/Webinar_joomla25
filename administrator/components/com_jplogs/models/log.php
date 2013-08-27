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
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelform library
jimport('joomla.application.component.model');
 
class jplogsModelLog extends JModel
{
	/**
	 * Method to get the log path
	 * @since	1.6
	*/
    public function getLog()
    {
    	$log = JRequest::getVar('log', '', 'get');
    	$log == 'error_log' ? $path = JPATH_ROOT.DS : $path = JPATH_ROOT.DS.'logs'.DS;    	
    	$file = file_get_contents($path.$log);
    	return $file;
    }
}
