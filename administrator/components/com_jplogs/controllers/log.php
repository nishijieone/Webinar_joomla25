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
 
// import Joomla controllerform library
jimport('joomla.application.component.controllerform');
 

class jplogsControllerLog extends JControllerForm
{
    /**
	 * Proxy for getModel.
	 * @since	1.6
	*/
	public function getModel($name = 'Log', $prefix = 'jplogsModel') 
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
	
	/**
	 * Download task force to download zipped log
	*/
	public function download()
	{
		$file = JRequest::getVar('log', '', 'get');
		$file == 'error_log' ? $path = JPATH_ROOT.DS : $path = JPATH_ROOT.DS.'logs'.DS;
		$filename = str_replace('.php', '', $file).'.zip';

		require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'libraries'.DS.'zip_min.inc');
  		$zip = new zipfile(); 
  		$zip->addfile(file_get_contents($path.$file), $file);

		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.$filename.'"');
		echo $zip->file();  	           
	}
	
	/**
	 * Remove task delete a log file
	*/
	public function remove()
	{
		$file = JRequest::getVar('log', '', 'get');
		$file == 'error_log' ? $path = JPATH_ROOT.DS : $path = JPATH_ROOT.DS.'logs'.DS;
		$remove = unlink($path.$file);
						
		if($remove) {
			$this->setRedirect('index.php?option=com_jplogs&view=logs', JText::_('COM_JP_LOGS_SUCCESS_REMOVE'));
		} else {
			JError::raiseWarning( 100, JText::_('COM_JP_LOGS_ERROR_REMOVE') );
		}
	}
}
