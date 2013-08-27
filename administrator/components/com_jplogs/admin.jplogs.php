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

//handling a liveupdate request
require_once JPATH_COMPONENT_ADMINISTRATOR.DS.'liveupdate'.DS.'liveupdate.php';
if(JRequest::getCmd('view','') == 'liveupdate') {
    LiveUpdate::handleRequest();
    return;
}

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_jplogs'))
{
        return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

require_once (JPATH_COMPONENT.DS.'version.php');

$version = new JPVersion();

//css stylesheet
$document = &JFactory::getDocument();

$css = JURI::base(true).'/components/com_jplogs/assets/css/jplogs.css';

$document->addStyleSheet( $css, 'text/css', null, array() );

// require helper file
JLoader::register('jplogsHelper', dirname(__FILE__) . DS . 'helpers' . DS . 'jplogs.php');

// import joomla controller library
jimport('joomla.application.component.controller');
 
// Get an instance of the controller prefixed by jplogs
$controller = JController::getInstance('jplogs');
 
// Perform the Request task
$controller->execute(JRequest::getCmd('task'));
 
// Redirect if set by the controller
$controller->redirect();

?>
