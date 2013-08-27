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
// import the Joomla modellist library
jimport('joomla.application.component.modellist');

class jplogsModelLogs extends JModelList
{
    /**
	 * Constructor.
	 *
	 * @param	array	An optional associative array of configuration settings.
	 * @see		JController
	 * @since	1.6
	*/
	public function __construct($config = array())
	{
        if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
			'title', 'title',
			);
		}
		parent::__construct($config);
	} 

	/**
	 * Method to get all the log files.
	 * @return array
	 * @since	1.6
	*/
	public function getItems()
	{
		jimport('joomla.filesystem.file');
		
		$main    = 'error_log';
		$folder  = JPATH_ROOT.DS.'logs';
		
        $items = JFolder::files($folder, $filter = '.', true, false , array('index.html'));
        
        if(file_exists(JPATH_ROOT.DS.$main)) { array_push($items, $main); }
        return $items;
	}
	
	/**
	 * Method to get the file lenght.
	 * @return file
	 * @since	1.6
	*/
	public function getLenght($file)
	{
		$file == 'error_log' ? $path = JPATH_ROOT.DS : $path = JPATH_ROOT.DS.'logs'.DS;
		return filesize($path.$file).' Kb';
	}
	
}