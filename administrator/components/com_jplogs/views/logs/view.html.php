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

jimport( 'joomla.application.component.view' );

class jplogsViewLogs extends Jview
{        
	function display($tpl = null) 
	{
		// Get data from the model
		$items  = $this->get('Items');
 
		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Assign data to the view
		$this->items  = $items;
 
		// Set the toolbar
		$this->addToolBar();
 
		// Display the template
		parent::display($tpl);
                
                // Set the document
		$this->setDocument();
	}
 
	/**
	 * Setting the toolbar
	*/
	protected function addToolBar() 
	{
		$canDo = jplogsHelper::getActions();
		JToolBarHelper::title(JText::_('COM_JP_LOGS_MANAGER_ITEMS'), 'logs48');

		if ($canDo->get('core.admin')) 
		{
			//JToolBarHelper::preferences('com_jplogs');
		}		
	}
        
    /**
	 * Method to set up the document properties
	 *
	 * @return void
	*/
	protected function setDocument() 
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_JP_LOGS_ADMINISTRATION'));
	}
}
?>