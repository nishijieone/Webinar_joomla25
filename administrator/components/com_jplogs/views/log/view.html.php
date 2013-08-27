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

class jplogsViewLog extends Jview
{    
	/**
	 * display method of Item view
	 * @return void
	*/
	public function display($tpl = null) 
	{
		// get the Data
		$log = $this->get('Log');
 
		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Assign the Data
		$this->log = $log;
 
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
		JRequest::setVar('hidemainmenu', true);
		$user = JFactory::getUser();
		$userId = $user->id;
		$isNew = $this->item->id == 0;
		$canDo = jplogsHelper::getActions($this->item->id);
		JToolBarHelper::title(JText::_('COM_JP_LOGS_MANAGER_ITEM_LOG'), 'logs48');
		// Built the actions for new and existing records.

		if ($canDo->get('core.create')) 
		{
			JToolBarHelper::custom('log.download', 'download32.png', 'download32.png', 'COM_JP_LOGS_MANAGER_ITEM_DOWNLOAD', false);
			JToolBarHelper::custom('log.remove', 'remove32.png', 'remove32.png', 'COM_JP_LOGS_MANAGER_ITEM_REMOVE', false);
		}
        JToolBarHelper::divider();
		JToolBarHelper::back();
	}
	
	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument() 
	{
		$document = JFactory::getDocument();
		$document->addScript(JURI::root() . "/administrator/components/com_jplogs/views/log/submitbutton.js");
		$document->addScript(JURI::root() . "/administrator/components/com_jplogs/assets/js/jquery.min.js");
		$js = '
		$(function(){
			$(".code").each(function(){
			$(this).html(function(index, html) {
			output = html.replace(/^(.*)$/mg, "<li><pre>$1</pre></li>");
       		});
		$(this).replaceWith(\'<ol class="lncode">\'+output+\'</ol>\');
		});});';
		$document->addScriptDeclaration($js);
	}
}
?>